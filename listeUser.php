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

        include './CRUD.php';
        include './fonctionsTableau.php';

        $headers = getHeaderTable();
        $users = getAllUsers();
        showTable($users, $headers);

    ?>

    <a href="./inscription.php?id=0">Créer un utilisateur</a>
</body>
</html>