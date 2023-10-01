<?php include "db.php" ?>
<html>
    <body>
        <?php
            $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ?");
            $stmt->bindParam(1, $_GET["username"]); 
            $stmt->execute();
            $row = $stmt->fetch();
        ?>

        <h2><?=$row["name"]?></h2>
        ที่อยู่ : <?=$row ["address"]?> <br>
        เบอร์ : <?=$row ["mobile"]?> <br> 
        อีเมล : <?=$row ["email"]?> <br> <br>

        <form action="edit.php" method="post" enctype="multipart/form-data">

            กรอกข้อมูลที่ต้องการแก้ไข <br>

            <input type="hidden" 
                name="username" 
                value="<?=$row["username"]?>" required>

            ชื่อ-นามสกุล : <input type="text" 
                name="name" 
                value="<?=$row["name"]?>" required> <br>

            ที่อยู่ : <textarea name="address" required><?=$row["address"]?></textarea> <br>

            เบอร์ : <input type="text" 
                name="mobile" 
                value="<?=$row["mobile"]?>" required> <br>

            อีเมล : <input type="email" 
                name="email" 
                value="<?=$row["email"]?>" required> <br>

            ใส่รูปภาพ : <input type="file" name="image" required> <br>

            <input type="submit" value="แก้ไขข้อมูล">
        </form>

    </body>
</html>