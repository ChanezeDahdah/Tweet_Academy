<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./settings.css">

    <title>Settings</title>
</head>
<?php
include './tweetStart.php';

if (isset($_FILES["profilePicture"])) {
    $target_dir = "img/profileImg/";
    $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file);
    $dbh->query("UPDATE users SET picture='".$target_file."' WHERE user_id=" . $_SESSION["userId"]);
}
if (isset($_FILES["profileBanner"])) {
    $target_dir = "img/bannerImg/";
    $target_file = $target_dir . basename($_FILES["profileBanner"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["profileBanner"]["tmp_name"], $target_file);
    $dbh->query("UPDATE users SET banner='".$target_file."' WHERE user_id=" . $_SESSION["userId"]);
}
if (isset($_POST["profileFullname"])) {
    $dbh->query("UPDATE users SET fullname='".$_POST["profileFullname"]."' WHERE user_id=" . $_SESSION["userId"]);
}
if (isset($_POST["profileBirthdate"])) {
    $dbh->query("UPDATE users SET birthdate='".$_POST["profileBirthdate"]."' WHERE user_id=" . $_SESSION["userId"]);
}
if (isset($_POST["profileTel"])) {
    $dbh->query("UPDATE users SET phone='".$_POST["profileTel"]."' WHERE user_id=" . $_SESSION["userId"]);
}
if (isset($_POST["profileEmail"])) {
    $dbh->query("UPDATE users SET email='".$_POST["profileEmail"]."' WHERE user_id=" . $_SESSION["userId"]);
}
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


    <div class="main">
        <form method="post" id="setProfilePicture" enctype="multipart/form-data">
            <label for="profilePicture">Change profile picture:</label>
<<<<<<< HEAD
            <input type="file" name="profilePicture" id="profilePictureFile" autocomplete="off">
            <input type="submit" value="Save">
        </form>
        <form method="post" id="setProfileBanner" enctype="multipart/form-data">
            <label for="profileBanner">Change profile banner:</label>
            <input type="file" name="profileBanner" id="profileBannerFile" autocomplete="off">
            <input type="submit" value="Save">
        </form>
        <form method="post" id="setProfileBio">
            <label for="profileBio">Change profile bio:</label>
            <textarea name="profileBio" id="profileBio" cols="30" rows="10" autocomplete="off" placeholder="Tell us a little bit about yourself..."></textarea>
            <input type="submit" value="Save">
        </form>
        <form method="post" id="setProfileFullname">
            <label for="profileFullname">Change fullname:</label>
            <input type="text" name="profileFullname" id="profileFullname" autocomplete="off" placeholder="Nom Prenom">
            <input type="submit" value="Save">
        </form>
        <form method="post" id="setProfileBirthdate">
            <label for="profileBirthdate">Change birthday:</label>
            <input type="date" name="profileBirthdate" id="profileBirthdate" autocomplete="off">
            <input type="submit" value="Save">
        </form>
        <form method="post" id="setProfileTel">
            <label for="profileTel">Change telephone number:</label>
            <input type="tel" name="profileTel" id="profileTel" autocomplete="off" placeholder="0123456789">
            <input type="submit" value="Save">
        </form>
        <form method="post" id="setProfileEmail">
            <label for="profileEmail">Change email adress:</label>
            <input type="email" name="profileEmail" id="profileEmail" autocomplete="off" placeholder="ex : email@mail.com">
            <input type="submit" value="Save">
=======
            <input type="file" name="profilePicture" id="profilePictureFile">
            <input class="btn" type="submit" value="Save">
        </form>
        <form method="post" id="setProfileBanner" enctype="multipart/form-data">
            <label for="profileBanner">Change profile banner:</label>
            <input type="file" name="profileBanner" id="profileBannerFile">
            <input class="btn" type="submit" value="Save">
        </form>
        <form method="post" id="setProfileBio">
            <label for="profileBio">Change profile bio:</label>
            <textarea name="profileBio" id="profileBio" cols="30" rows="10" autocomplete="off"></textarea>
            <input class="btn" type="submit" value="Save">
>>>>>>> a879e10aaaef77f2f805d4d90a68d78c37cc604f
        </form>
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