<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweet@ca</title>
    <link rel="stylesheet" href="followStyle.css">
</head>
<?php
include './tweetStart.php';
?>

<body>
    <div class="navBar">
        <nav>
            <ul>
                <li><a href="tweetServer.php">Main</a></li>
                <li><a href="searchServer.php">Search</a></li>
                <li><a href="mpServer.php">Message</a></li>
                <li><a href="profileServer.php">Profile</a></li>
                <li><a href="settingsServer.php">Settings</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <?php
        if (isset($_GET["user"])) {
            $results = $dbh->query("SELECT * FROM users WHERE username='" . $_GET["user"] . "'")->fetch();
            $userId = $results["user_id"];
            $followers = $dbh->query("SELECT * FROM follows JOIN users ON follows.follower_id=users.user_id WHERE follows.user_id=" . $userId);
            while ($row = $followers->fetch()) {
                echo '
                <div class="userSection">
                    <div class="userPicture"><img src="' . $row["picture"] . '" alt="profile picture"></div>
                    <div class="userContent">
                        <div class="userSectionName">
                            <a href="./profileServer.php?search=%40' . substr($row["username"], 1, strlen($row["username"])) . '" class="lienUsername" >'. $row["username"] .'
                            </a>
                        </div>
                        <div class="userBio"><p>' . $row["biography"] . '</p></div>
                    </div>
                </div>';
            }
        }
        ?>
    </div>
</body>

<script src="jquery-3.5.1.min.js"></script>
<script src="tweetScript.js"></script>

</html>