<?php

function getDatabaseConnexion(){
    try{
        //Connexion bdd
        $user = "root";
        $pass = "root";

        $bdd = new PDO('mysql:host=localhost;dbname=common-database', $user, $pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;

    } catch (PDOException $e){
        // Message d'erreur si echec connexion bdd
        print 'Erreur : ' . $e->getMessage();
        die();
    }
        echo "Objet PDO créé";
    }

function getAllUsers(){
    $con = getDatabaseConnexion();
    $requete = 'SELECT * FROM users';
    $rows = $con->query($requete);
    return $rows;
}

function createUser($fullname, $birthdate, $username, $email, $password){
    $username = "@".$username;
    $_SESSION["userExists"] = false;
    try{
        $con = getDatabaseConnexion();
        // VERIFICATION QUE L'USERNAME N'EXISTE PAS DEJA
        $results = $con->query("SELECT * FROM users WHERE username='" . $username . "'")->fetch();
        if (!$results) {
            $sql = "INSERT INTO users (fullname, birthdate, username, email, password) VALUES ('$fullname', '$birthdate', '$username', '$email', '$password')";
            $con->exec($sql);
        } else {
            $_SESSION["userExists"] = true;
        }
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

function readUser($id){
    $con = getDatabaseConnexion();
    $requete = "SELECT * FROM users WHERE user_id = '$id'";
    $stmt = $con->query($requete);
    $row = $stmt->fetchAll();
    if (!empty($row)){
        return $row[0];
    }
}

function updateUser($id, $fullname, $birthdate, $phone, $email, $password, $picture, $banner, $biography, $username){
    try{
        $con = getDatabaseConnexion();
        $sql = "UPDATE users set fullname = '$fullname', birthdate = '$birthdate', phone = '$phone', email = '$email', password = '$password', picture = '$picture', banner ='$banner', biography = '$biography', username = '$username' WHERE user_id = '$id' ";
        $stmt = $con->query($sql);
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

function deleteUser($id){
    try{
        $con = getDatabaseConnexion();
        $sql = "DELETE from users where user_id = '$id' ";
        $stmt = $con->query($sql);
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

function getNewUser() {
    $user['user_id'] = "";
    $user['fullname'] = "";
    $user['birthdate'] = "";
    $user['email'] = "";
    $user['username'] = "";
    $user['password'] = "";
}

?>