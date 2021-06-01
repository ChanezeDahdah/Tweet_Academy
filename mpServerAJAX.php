<?php

include './tweetStart.php';


if (isset($_POST["search"]) && trim($_POST["search"]) != "") {
    //USERNAME SUGGESTIONS
    $results = $dbh->query("SELECT username FROM users WHERE username LIKE '@" . $_POST["search"] . "%'");
    while ($row = $results->fetch()) {
        echo "<div class='searchResults'>" . $row["username"] . "</div>";
    }
}

if (isset($_POST["msg"]) && isset($_POST["receiver_name"])) {
    $results = $dbh->query("SELECT * FROM users WHERE username='".$_POST["receiver_name"]."'")->fetch();
    $receiver_id = intval($results["user_id"]);
    $dbh->query("INSERT INTO messages(user_id, receiver_id, content) VALUES(".$_SESSION["userId"].",".$receiver_id.",'".$_POST["msg"]."')");

    echo "<p class='username'>".$_POST["receiver_name"]."</p>";
    $results = $dbh->query("SELECT user_id FROM users WHERE username='" . $_POST["receiver_name"] . "'")->fetch();
    $_GET["receiver"] = $results["user_id"];
    $results = $dbh->query("SELECT * FROM messages WHERE user_id=" . $_SESSION["userId"] . " AND receiver_id=" . $_GET["receiver"] . " OR user_id=" . $_GET["receiver"] . " AND receiver_id=" . $_SESSION["userId"] . " ORDER BY message_date ASC");
    if ($results->fetch()) {
        while ($row = $results->fetch()) {
            switch (intval($row["user_id"])) {
                case $_SESSION["userId"]:
                    echo "<div class='userMsg'><div class='dateMsg'>" . $row["message_date"] . "</div><div class='msg'>" . $row["content"] . "</div></div>";
                    break;

                case $_GET["receiver"]:
                    echo "<div class='receiverMsg'><div class='dateMsg'>" . $row["message_date"] . "</div><div class='msg'>" . $row["content"] . "</div></div>";
                    break;

                default:
                    echo "Oh no";
                    break;
            }
        }
    } else {
        echo "<div class='receiverMsg'><div class='msg'>Start a new conversation!</div></div>";
    }
}