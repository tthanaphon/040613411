<?php include "db.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
$stmt = $pdo->prepare("SELECT name,address,email FROM member");
$stmt->execute();
while ($row = $stmt->fetch()):
?>

 ชื่อสมาชิก :<?= $row ["name"]?><br>
 ที่อยู่ : <?= $row ["address"]?> <br>
 อีเมล : <?= $row ["email"]?> <br><hr>
<?php endwhile;?>

</body>
</html>