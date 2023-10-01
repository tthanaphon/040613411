<?php include "db.php" ?>
<html>
<head><meta charset="utf-8"></head>
    <body>
        <?php
            $stmt = $pdo->prepare("SELECT * FROM member");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
            ?>
            ชื่อสมาชิก : <?=$row ["name"]?><br>
            ที่อยู่ : <?=$row ["address"]?><br>
            อีเมล : <?=$row ["email"]?><br>
            
            <a href="w5-detail.php?username=<?=$row["username"]?>">
                <img src='member_photo/<?=$row["username"]?>.jpg' width='100'>
            </a>
            <br>
            
            <hr>
        <?php } 
        ?>
    </body>
</html>