<?php
function getDatabaseConnexion(){
try{
    //Connexion bdd
    $bdd = new PDO('mysql:host=localhost;dbname=twitter', "user", "UserPassword");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    // Message d'erreur si echec connexion bdd
    print 'Erreur : ' . $e->getMessage();
    die();
}
    echo "Objet PDO créé";
}
?>