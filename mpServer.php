<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./mpstyle.css">

    <title>Search</title>
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

    <div class="container">
        <h1>Messages</h1>
        <hr>
        <form autocomplete="off" method="get" id="searchForm" action="mpServerChatroom.php">
            <div class="searchForm">
                <div class="searchInput">
                    <input type="text" name="receiver" id="searchBar" placeholder="Recherche">
                    <div class="autocomplete-items"></div>
                </div>
            </div>
            <input class ="searchSubmit" type="submit" value="Search" id="Add to DM">
        </form>
    </div>
    <div class="chatrooms">
        <?php
        function chatroomSpace($user, $receiver, $dbh)
        {
            $resultat = $dbh->query("SELECT content, message_date FROM messages WHERE user_id=" . $user . " AND receiver_id=" . $receiver . " OR user_id=" . $receiver . " AND receiver_id=" . $user . " ORDER BY message_date DESC LIMIT 1");
            $lastMsg = $resultat->fetch();
            $resultat = $dbh->query("SELECT picture, username FROM users WHERE user_id=" . $receiver);
            $userInfo = $resultat->fetch();
            echo '
                <div class="chatBox">
                    <div class="userImg">
                        <img src="' . $userInfo["picture"] . '" alt="userImg">
                    </div>
                    <div class="lastMsg">
                        <p class="username">' . $userInfo["username"] . '</p>
                        <p>' . $lastMsg["content"] . '</p>
                    </div>
                </div>
                ';
        }
        if (isset($_SESSION["userId"])) {
            //SHOW CONVO IF USER MADE CONTACT BY SENDING OR RECEIVING
            $resultat = $dbh->query("SELECT DISTINCT user_id, receiver_id FROM messages WHERE user_id = " . $_SESSION["userId"]);
            $flagedUsers = [];
            while ($row = $resultat->fetch()) {
                array_push($flagedUsers, $row["receiver_id"]);
                chatroomSpace($row["user_id"], $row["receiver_id"], $dbh);
            }
            $resultat = $dbh->query("SELECT DISTINCT user_id, receiver_id FROM messages WHERE receiver_id=" . $_SESSION["userId"] . " AND user_id NOT IN(" . implode(",", $flagedUsers) . ")");
            while ($row = $resultat->fetch()) {
                chatroomSpace($row["receiver_id"], $row["user_id"], $dbh);
            }
        }
        ?>
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="jquery-3.5.1.min.js"></script>
<script src="mpScript.js"></script>

</html>