<?php include "db.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM member");
$stmt->execute();
while ($row = $stmt->fetch()):
?>

 ชื่อสมาชิก :<?= $row ["name"]?><br>
 ที่อยู่ : <?= $row ["address"]?> <br>
 อีเมล : <?= $row ["email"]?> <br><hr>
 <img src='member_photo/<?=$row ["username"]?>.jpg' width='100'><br>
 
<?php endwhile;?>



</body>
</html>