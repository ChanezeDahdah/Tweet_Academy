<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweet@ca</title>
    <link rel="stylesheet" href="mpStyle.css">
</head>
<?php
include './tweetStart.php';
?>

<body>
    <a href="mpServer.php">Back</a>
    <div class="chatroom">
        <?php
        echo "<p class='username'>".$_GET["receiver"]."</p>";
        $results = $dbh->query("SELECT user_id FROM users WHERE username='" . $_GET["receiver"] . "'")->fetch();
        $_GET["receiver"] = $results["user_id"];
        $results = $dbh->query("SELECT * FROM messages WHERE user_id=" . $_SESSION["userId"] . " AND receiver_id=" . $_GET["receiver"] . " OR user_id=" . $_GET["receiver"] . " AND receiver_id=" . $_SESSION["userId"] . " ORDER BY message_date ASC");
        if ($results->fetch()) {
            while ($row = $results->fetch()) {
                switch (intval($row["user_id"])) {
                    case $_SESSION["userId"]:
                        echo "<div class='userMsg'><div class='dateMsg'>" . $row["message_date"] . "</div><div class='msg'>" . $row["content"] . "</div></div>";
                        break;

                    case $_GET["receiver"]:
                        echo "<div class='receiverMsg'><div class='dateMsg'>" . $row["message_date"] . "</div><div class='msg'>" . $row["content"] . "</div></div>";
                        break;

                    default:
                        echo "Oh no";
                        break;
                }
            }
        } else {
            echo "<div class='receiverMsg'><div class='msg'>Start a new conversation!</div></div>";
        }
        ?>
    </div>
    <div class="chatTextBar">
        <form method="post" id="chatText">
            <input type="text" name="chatTextInput" id="chatTextInput" maxlength="140" autocomplete="off">
            <input type="submit" value="Send">
        </form>
    </div>
</body>
<script src="jquery-3.5.1.min.js"></script>
<script src="mpScript.js"></script>
</html>