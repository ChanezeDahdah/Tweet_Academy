<?php

include './tweetStart.php';

//METHOD TO DISPLAY ALL TWEETS LIMITED BY HOW LOW YOU SCROLL

function tweet($results)
{
    while ($row = $results->fetch()) {
        $content = filter_var($row["content"], FILTER_SANITIZE_STRING);
        $contentTab = explode(" ", $content);
        $imgTab = [];
        foreach ($contentTab as $key => $value) {
            if (strpos($value, "#") === 0 && strlen($value) !== 1) {
                $contentTab[$key] = "<a href='./searchServer.php?search=%23" . substr($value, 1, strlen($value)) . "' class=lienHashtag>" . $value . "</a>";
            }
            if (strpos($value, "@") === 0 && strlen($value) !== 1) {
                $contentTab[$key] = "<a href='./profileServer.php?search=%40" . substr($value, 1, strlen($value)) . "' class=lienUsername>" . $value . "</a>";
            }
            if (file_exists($value)) {
                array_push($imgTab, $value);
            }
        }
        $content = implode(" ", $contentTab);
        $username = "<a href='./profileServer.php?search=%40" . substr(filter_var($row["username"], FILTER_SANITIZE_STRING), 1, strlen(filter_var($row["username"], FILTER_SANITIZE_STRING))) . "' class=lienUsernameHeader>" . filter_var($row["username"], FILTER_SANITIZE_STRING) . "</a>";
        echo '
                <div class="tweetSection">
                <div class="profileImg"><img src="' . $row["picture"] . '" alt=""profile picture></div>
                <div class="tweetId">' . $row["tweet_id"] . '</div>
                <div class="retweetId"><span>' . $username . '</span></div>
                <div class="tweetDate"><span>' . $row["tweet_date"] . '</span></div>
                <div class="tweetArticle"><span>' . $content . '</span></div>
                <div class="tweetImgContent">';
        foreach ($imgTab as $key => $value) {
            echo '<img src="' . $value . '">';
        }
        echo '</div>
                <div class="tweetButtons">
                <button class="tweetRespond">Answer</button>
                <button class="tweetRetweet">Retweet</button>
                </div>
                </div>';
    }
}
// SET FIRST LIMIT
if (!isset($_POST["limit"])) {
    $_POST["limit"] = 30;
}
// ADD NEW TWEET ON AJAX POST
if (isset($_POST["tweet"])) {
    if ($_POST["tweet"] != "") {
        if (isset($_FILES)) {
            $target_dir = "img/";
            foreach ($_FILES as $key => $value) {
                $target_file = $target_dir . basename($_FILES[$key]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES[$key]["tmp_name"], $target_file);
            }
        }
        $dbh->query("INSERT INTO tweets(user_id, content) VALUES('" . $_SESSION["userId"] . "', '" . trim($_POST["tweet"]) . "')");
        $tweetId = $dbh->lastInsertId();
        $tweet = explode(" ", $_POST["tweet"]);
        foreach ($tweet as $key => $value) {
            if (substr($value, 0, 1) == "#" && strlen($value) !== 1) {
                $dbh->query("INSERT INTO hashtags(hashtag) VALUES ('" . trim($value) . "')");
                $dbh->query("INSERT INTO tweets_hashtags(tweet_id, hashtag_id) VALUES(" . $tweetId . ", " . $dbh->lastInsertId() . ")");
            }
        }
        $results = $dbh->query('SELECT tweets.tweet_id, users.username, users.picture, tweets.tweet_date, tweets.content FROM tweets JOIN users ON tweets.user_id = users.user_id ORDER BY tweet_id DESC LIMIT ' . $_POST["limit"]);
        tweet($results);
    }
}
//ADD MORE TWEETS ON BOTTOM SCROLL
if (isset($_POST["scroll"]) && $_POST["scroll"] == true) {
    if (isset($_POST["profile"])) {
        $results = $dbh->query('SELECT tweets.tweet_id, users.username, users.picture, tweets.tweet_date, tweets.content FROM tweets JOIN users ON tweets.user_id = users.user_id WHERE users.username="' . $_POST["profile"] . '" ORDER BY tweet_id DESC LIMIT ' . $_POST["limit"]);
    } else {
        $results = $dbh->query('SELECT tweets.tweet_id, users.username, users.picture, tweets.tweet_date, tweets.content FROM tweets JOIN users ON tweets.user_id = users.user_id ORDER BY tweet_id DESC LIMIT ' . $_POST["limit"]);
    }
    tweet($results);
}


//ASTUCE : echo le receive de JSON sur le script js en html apres l'avoir emis en encode sur PHP

// ADD SUGGESTIONS
if (isset($_POST["search"]) && trim($_POST["search"]) != "") {
    $results = $dbh->query("SELECT username FROM users WHERE username LIKE '@" . $_POST["search"] . "%'");
    while ($row = $results->fetch()) {
        echo "<div class='searchResults'>" . $row["username"] . "</div>";
    }
    $results = $dbh->query("SELECT COUNT(*), hashtag FROM hashtags WHERE hashtag LIKE '#" . $_POST["search"] . "%' GROUP BY hashtag");
    while ($row = $results->fetch()) {
        echo "<div class='searchResults'>" . $row["hashtag"] . "</div>";
    }
}
//ADD COMMENTS TO SELECTED TWEET
if (isset($_POST["tweet_id0"])) {
    $results = $dbh->query("SELECT * FROM comments JOIN users ON comments.user_id=users.user_id WHERE comments.tweet_id=" . intval($_POST["tweet_id0"]) . " ORDER BY comments.comment_date DESC");
    while ($row = $results->fetch()) {
        $content = filter_var($row["content"], FILTER_SANITIZE_STRING);
        $contentTab = explode(" ", $content);
        foreach ($contentTab as $key => $value) {
            if (strpos($value, "#") === 0 && strlen($value) !== 1) {
                $contentTab[$key] = "<a href='./searchServer.php?search=%23" . substr($value, 1, strlen($value)) . "' class=lienHashtag>" . $value . "</a>";
            }
            if (strpos($value, "@") === 0 && strlen($value) !== 1) {
                $contentTab[$key] = "<a href='./profileServer.php?search=%40" . substr($value, 1, strlen($value)) . "' class=lienUsername>" . $value . "</a>";
            }
        }
        $content = implode(" ", $contentTab);
        $username = "<a href='./profileServer.php?search=%40" . substr(filter_var($row["username"], FILTER_SANITIZE_STRING), 1, strlen(filter_var($row["username"], FILTER_SANITIZE_STRING))) . "' class=lienUsernameHeader>" . filter_var($row["username"], FILTER_SANITIZE_STRING) . "</a>";
        echo '
        <div class="comment">
            <div class="profileImg"><img src="' . $row["picture"] . '" alt="profile picture"></div>
            <div class="commentText">
            <p class="commentUsername">' . $username . '<p>
            <p class="commentText">' . $content . '<p>
            <p class="commentDate">' . $row["comment_date"] . '<p>
            </div>
        </div>
        ';
    }
}
//INPUT NEW COMMENT THEN ADD ALL COMMENTS TO TWEET
if (isset($_POST["tweet_id1"]) && isset($_POST["comment"])) {
    $results = $dbh->query("INSERT INTO comments(tweet_id, user_id, content) VALUES(" . intval($_POST["tweet_id1"]) . "," . $_SESSION["userId"] . ",'" . $_POST["comment"] . "')");
    $results = $dbh->query("SELECT * FROM comments JOIN users ON comments.user_id=users.user_id WHERE comments.tweet_id=" . intval($_POST["tweet_id1"]) . " ORDER BY comments.comment_date DESC");
    while ($row = $results->fetch()) {
        $content = filter_var($row["content"], FILTER_SANITIZE_STRING);
        $contentTab = explode(" ", $content);
        foreach ($contentTab as $key => $value) {
            if (strpos($value, "#") === 0 && strlen($value) !== 1) {
                $contentTab[$key] = "<a href='./searchServer.php?search=%23" . substr($value, 1, strlen($value)) . "' class=lienHashtag>" . $value . "</a>";
            }
            if (strpos($value, "@") === 0 && strlen($value) !== 1) {
                $contentTab[$key] = "<a href='./profileServer.php?search=%40" . substr($value, 1, strlen($value)) . "' class=lienUsername>" . $value . "</a>";
            }
        }
        $content = implode(" ", $contentTab);
        $username = "<a href='./profileServer.php?search=%40" . substr(filter_var($row["username"], FILTER_SANITIZE_STRING), 1, strlen(filter_var($row["username"], FILTER_SANITIZE_STRING))) . "' class=lienUsernameHeader>" . filter_var($row["username"], FILTER_SANITIZE_STRING) . "</a>";
        echo '
        <div class="comment">
            <div class="profileImg"><img src="' . $row["picture"] . '" alt="profile picture"></div>
            <div class="commentText">
            <p class="commentUsername">' . $username . '<p>
            <p class="commentText">' . $content . '<p>
            <p class="commentDate">' . $row["comment_date"] . '<p>
            </div>
        </div>
        ';
    }
}
//RETWEET TO PERSONALE PROFILE FROM ID SENT

if (isset($_POST["retweetId"])) {
    $results = $dbh->query("SELECT * FROM tweets WHERE tweet_id=" . $_POST["retweetId"])->fetch();
    $dbh->query("INSERT INTO tweets(user_id, content) VALUES('" . $_SESSION["userId"] . "', '" . $results["content"] . "')");
}

//AJAX REQUEST TO ADD FOLLOW OR DELETE IT 

if (isset($_POST["followUser"])) {
    $row = $dbh->query("SELECT * FROM users WHERE username='" . $_POST["followUser"] . "'")->fetch();
    $dbh->query("INSERT INTO follows(follower_id, user_id) VALUES(" . $_SESSION["userId"] .  ", " . $row["user_id"] . ")");
}

if (isset($_POST["unfollowUser"])) {
    $row = $dbh->query("SELECT * FROM users WHERE username='" . $_POST["unfollowUser"] . "'")->fetch();
    $dbh->query("DELETE FROM follows WHERE follower_id=" . $_SESSION["userId"] . " AND user_id=" . $row["user_id"]);
}
