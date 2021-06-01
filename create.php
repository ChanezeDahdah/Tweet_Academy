<?php
        include './CRUD.php';
        include './fonctionsTableau.php';
session_start();


    if (isset($_POST)){
    $action = $_POST["action"];

            $fullname = $_POST["fullname"];
            $birthdate = $_POST["birthdate"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"] . "vive le projet tweet_academy";
            $password = hash('ripemd160', $password);
    };

        if ($action == "CREATE"){
            createUser($fullname, $birthdate, $username, $email, $password);
            if ($_SESSION["userExists"]) {
                echo "<h3 style='color:red'>Username already exists, please choose another...</h3>";
                echo "<a href='inscription.php'>Revenir</a>";    
            } else {
                echo "Utilisateur crée <br>";
                echo "<a href='listeUser.php'>Liste des utilisateurs</a>";
            }

        if(empty($username) || empty($password) || empty($fullname) || empty($birthdate) || empty($email))
        {
            echo '<script language="Javascript">
                alert ("Veuillez completer tous les champs" )
                </script>';
        }
    }
