<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./accueil.css">

    <title>Accueil</title>
</head>
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
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="./index.php" style="color: #ffffff;">Accueil</a>
                    <a class="nav-link" href="./inscription.php" style="color: #ffffff;">S'inscrire</a>
                    <a class="nav-link" href="./connexion.php" style="color: #ffffff;">Se connecter</a>
                </div>
            </div>
    </div>
</nav>


<div class="jumbotron">
    <h1 class="display-4">TWEET ACADEMIE</h1>
    <p class="lead">La communication de l'avenir !</p>
    <hr class="my-4">
    <p class="describe">Rejoignez-nous pour vous <b>exprimer</b> sur l'actualité, <b>échanger</b> avec le monde, des amis ou collègues, <b>débattre</b> sur des sujets divers avec les <b>millions d'utilisateurs</b> déjà présent. Personnalisez votre fil en suivant des personnes avec un contenu qui vous correspond. Et encore énormément de choses à <b>découvrir</b>... 
    <br/>
    <b>Rejoignez la folle aventure de Tweet Academie.</b></p>
</div>

<form class="d-grid gap-2 col-6 mx-auto">
<button type="submit" formaction="./inscription.php"class="inscription btn btn-lg">S'inscrire</button>
<button type="submit" formaction="./connexion.php" class=" connexion btn btn-lg">Se connecter</button>
</form>

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
</body>
</html>

