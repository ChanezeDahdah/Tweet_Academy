<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./inscription.css">
    <title>Inscription</title>
</head>
<body>

<!-- Création de la navbar -->

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

<?php
include './CRUD.php';
include './fonctionsTableau.php';

$id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

if ($id == 0) {
    $user = getNewUser();
    $action = "CREATE";
    $libelle = "Créer";
} else {
    $user = readUser($id);
    $action = "UPDATE";
    $libelle = "Mettre à jour";
}
?>

<form class="signin" action="./create.php" method="POST">
<br />
    <h2>Créer votre compte</h2>

    <div class="row justify-content-center">
        <div class="col">
            <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>"/>
        </div>
        <div class="col">
            <input type="hidden" name="action" value="<?php echo $action; ?>"/>
        </div>
    </div>
        <br>
    <div class="row justify-content-center">
        <div class="col-4">
            <input type="text" class="form-control" id="fullname" name="fullname" value="" placeholder="Nom complet">
        </div>
        <div class="col-4">
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="">
        </div>
    </div>
        <br>
    <div class="row justify-content-center">
        <div class="col-4">
            <input type="text" class="form-control" id="username" name="username" value="" placeholder="@username">
        </div>
        <div class="col-4">
            <input type="password" class="form-control" id="password" name="password" value="" placeholder="Mot de passe">
        </div>
    </div>
        <br>
    <div class="row justify-content-center">
        <div class="col-8">
            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Adresse email">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-8">
            <button type="submit" class=" btn form-control"><?php echo $libelle; ?></button>
        </div>
    </div>
</form>

<?php if ($action!="CREATE") { ?>
<form class="d-grid gap-2 col-6 mx-auto" action="./inscription.php" method="get">
        <input type="hidden" name="action" value="DELETE"/>
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>"/>
    <p>
        <div class="button">
            <button type="submit">Supprimer</button>
        </div>
    </p>
</form>
<?php } ?>


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