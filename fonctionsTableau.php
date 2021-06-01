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
    function showTable($rows, $headers) {
?>

        <table border="4">
            <tr>
            <?php foreach ($headers as $header): ?>
                <th><?php echo $header; ?></th>
            <?php endforeach; ?>
            </tr>

            <?php foreach ($rows as $row): ?>
            <tr>
                <?php for ($k = 0; $k < count($headers); $k++): ?>
                <?php if ($k ==0){ ?>

                    <td><?php echo '<a href=update.php?id='.$row
                    [$k].' >'.$row[$k].'</a>'; ?></td>
                <?php } else { ?>
                <td><?php echo $row[$k]; ?></td>
                <?php } ?>
                <?php endfor; ?>
            </tr>
            <?php endforeach; ?>
        </table>

    <?php
    }

function getHeaderTable(){
    $headers = array();
    $headers[] = "user_id";
    $headers[] = "fullname";
    $headers[] = "birthdate";
    $headers[] = "username";
    $headers[] = "email";
    $headers[] = "password";
    return $headers;
}
?>





</body>
</html>