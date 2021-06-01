<?php
    include './CRUD.php';
    include './fonctionsTableau.php';

    $id = $_GET["id"];
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="inscription.php" method="get">
        <p>
        <a href="./listeUser.php">Liste des utilisateurs</a>

        <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>"/>
        <input type="hidden" name="action" value="<?php echo $action; ?>"/>

        <div>
            <label for="fullname">Nom complet :</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>"> <!-- -->
        </div>
        <div>
            <label for="birthdate">Date de naissance :</label>
            <input type="date" id="birthdate" name="birthdate" value="<?php echo $user['birthdate']; ?>"><!-- -->
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><!---->
        </div>
        <div>
            <label for="username">Pseudo :</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><!---->
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>"><!---->
        </div>
        <div class="button">
            <button type="submit"><?php echo $libelle; ?></button>
        </div>
        </p>
    </form>

    <?php if ($action!="CREATE") { ?>
    <form action="update.php" method="get">
            <input type="hidden" name="action" value="DELETE"/>
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>"/>
        <p>
            <div class="button">
                <button type="submit">Supprimer</button>
            </div>
        </p>
    </form>
    <?php } ?>
</body>
</html>