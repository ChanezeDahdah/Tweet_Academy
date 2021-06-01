<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./tweetStyle.css">

    <title>Accueil</title>
</head>
<?php
include './tweetStart.php';
?>

<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #000000;">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img src="./img/logo.png" alt="" width="100" height="100" class="d-inline-block">
            <h5>Tweet Academie</h5>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link active" aria-current="page" href="./index.php" style="color: #ffffff;">Accueil</a>
                    <a class="nav-link" href="tweetServer.php" style="color: #ffffff;">Main</a>
                    <a class="nav-link" href="searchServer.php" style="color: #ffffff;">Search</a>
                    <a class="nav-link" href="mpServer.php" style="color: #ffffff;">Message</a>
                    <a class="nav-link" href="profileServer.php" style="color: #ffffff;">Profile</a>
                    <a class="nav-link" href="settingsServer.php" style="color: #ffffff;">Settings</a>
                    <a class="nav-link" href="./index.php" style="color: #ffffff;">Deconnexion</a>
                </div>
            </div>
    </div>
</nav>


    <?php
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
                <div class="profileImg"><img src="'.$row["picture"].'" alt=""></div>
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
    ?>
    <div class="main">
        <div class="tweetForm">
            <form method="POST" id="tweetForm" enctype="multipart/form-data">
                <div class="searchForm">
                    <div class="searchInput">
                        <textarea name="tweet" id="tweetFormText" cols="30" rows="10" maxlength="140" autocomplete="off"></textarea>
                        <div class="autocomplete-items"></div>
                    </div>
                    <input type="file" name="img" id="tweetFormImgUpload" multiple autocomplete="off">
                    <input type="submit" value="Tweet" id="tweetFormButton">
                </div>
            </form>
        </div>
        <div class="mainFeed">
            <?php
            $tweetLimit = 30;
            $results = $dbh->query('SELECT tweets.tweet_id, users.username, users.picture, tweets.tweet_date, tweets.content FROM tweets JOIN users ON tweets.user_id = users.user_id ORDER BY tweet_id DESC LIMIT ' . $tweetLimit);
            tweet($results);
            ?>
        </div>
    </div>
    <div class="overlay">
        <div class="strip">
            <div id="overlayTweetSection"></div>
            <div id="overlayAnswerSection">
                <form method="post" id="commentSection">
                    <textarea name="commentSection" id="commentSectionText" cols="30" rows="10" maxlength="140"></textarea>
                    <input type="submit" value="Comment" id="commentSectionButton">
                </form>
            </div>
            <div id="overlayCommentSection"></div>
        </div>
    </div>



<article>
    <a href="#" class="link">À propos</a> •
    <a href="#" class="link">Centre d'assistance</a> •
    <a href="#" class="link">Conditions d’utilisation</a> •
    <a href="#" class="link">Politique de Confidentialité</a> •
    <a href="#" class="link">Politique relative aux cookies</a> •
    <a href="#" class="link">Informations sur les publicités</a> •
    <a href="#" class="link">Blog</a> •
    <a href="#" class="link">Statut</a> •
    <a href="#" class="link">Carrières</a> •
    <a href="#" class="link">Ressources de la marque</a> •
    <a href="#" class="link">Publicité</a> •
    <a href="#" class="link">Marketing</a> •
    <a href="#" class="link">Twitter pour les professionnels</a> •
    <a href="#" class="link">Développeurs</a> •
    <a href="#" class="link">Répertoire</a> •
    <a href="#" class="link">Paramètres</a>

    <footer>
        © 2021 Tweet Academie, Inc.
    </footer>
</article>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="jquery-3.5.1.min.js"></script>
    <script type="module" src="tweetScript.js"></script>

</body>


</html>