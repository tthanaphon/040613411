<?php include "db.php" ?>
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["image"])) {
            // ใช้ username เป็นชื่อไฟล์
            $username = $_POST["username"];
            $targetDir = "member_photo/";
            $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $targetFile = $targetDir . $username . "." . $extension;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "รูปภาพถูกอัปโหลดเรียบร้อยแล้ว";
            } else {
                echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ";
            }
        } else {
            echo "กรุณาเลือกไฟล์รูปภาพ";
        }
    }

    $stmt = $pdo->prepare("INSERT INTO member VALUES ( ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->bindParam(3, $_POST["name"]);
    $stmt->bindParam(4, $_POST["address"]);
    $stmt->bindParam(5, $_POST["mobile"]);
    $stmt->bindParam(6, $_POST["email"]);

    $stmt->execute();
    $pid = $pdo->lastInsertId();
    header("location: w7.php");
?>