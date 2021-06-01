<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = "root";
        $pass = "root";
        $bdd = new PDO('mysql:host=localhost;dbname=common-database', $user, $pass);

        $sql = "SELECT * FROM users where username = '@$username' ";
        $result = $bdd->prepare($sql);
        $result->execute();

        if($result->rowCount() > 0)
        {
                //Connexion si l'utilisateur existe.
                $data = $result->fetchAll();
                $password = hash('ripemd160', $password . "vive le projet tweet_academy");
                if (hash_equals($password, $data[0]["password"]))
                {
                    var_dump("test");
                    header("Location: ./tweetServer.php");
                    echo "Connexion effectuée";
                    $_SESSION['userId'] = $data[0]["user_id"];
                    $_SESSION['username'] = $data[0]["username"];
                }
        }
        else
        {
?>
        <!-- Redirection vers page d'inscription si l'utilisateur n'exsite pas -->
        <h1>Ce compte n'existe pas. Voulez-vous en créer un ?</h1>
        <a href="./inscription.php">Créer un compte !</a>
<?php }
    }
?>

</body>
</html>


