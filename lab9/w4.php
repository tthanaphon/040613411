<?php include "db.php" ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
    <input type="text" name="keyword">
    <input type="submit" value="ค้นหา">
    </form>
    <div style="display:flex">
    <?php 
        $stmt = $pdo->prepare("SELECT * FROM member WHERE name LIKE ?");

        if(!empty($_GET)&&$_GET["keyword"] !=''){
            $value = '%'.$_GET["keyword"].'%';
            $stmt->bindParam(1, $value); 
            $stmt->execute();
        }
        
           
    ?>
<?php while ($row = $stmt->fetch()) : ?>
    <div style="padding: 15px; text-align: center">
    <img src='member_photo/<?=$row["username"]?>.jpg' width='100'><br>
    <?=$row ["name"]?><br><?=$row ["address"]?><br> <?=$row ["email"]?>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>



