<?php
session_start();
//DATABASE CONNECTION
try {
    $dbh = new PDO('mysql:host=localhost;dbname=common-database', 'root', 'root');
} catch (PDOException $e) {
    print "Erreur! : " . $e->getMessage() . "<br>";
    die();
}