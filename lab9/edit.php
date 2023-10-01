<?php
include "db.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["image"])) {
            
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

    $stmt = $pdo->prepare("UPDATE member SET name=?, address=?, mobile=?, email=? WHERE username=?");
    $stmt->bindParam(1, $_POST["name"]);
    $stmt->bindParam(2, $_POST["address"]);
    $stmt->bindParam(3, $_POST["mobile"]);
    $stmt->bindParam(4, $_POST["email"]);
    $stmt->bindParam(5, $_POST["username"]);

    if ($stmt->execute()) {
        echo "แก้ไขข้อมูล " . $_POST["name"] . " สำเร็จ";
    }

?>

<html>
    <body>
        <a href="w9.php">ย้อนกลับ</a>
    </body>
</html>