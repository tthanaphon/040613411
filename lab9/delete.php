<?php include "db.php" ?>
<?php
    $stmt = $pdo->prepare("DELETE FROM member WHERE username=?");
    $stmt->bindParam(1, $_GET["username"]); 
    $username = $_GET["username"];
    
    $fileToDelete = "member_photo/$username.jpg";

    if (file_exists($fileToDelete)) {
        if (unlink($fileToDelete)) {
            echo "รูปภาพถูกลบเรียบร้อยแล้ว";
        } else {
            echo "ไม่สามารถลบรูปภาพได้";
        }        
    }else{
        echo "ไม่พบรูปภาพที่ต้องการลบ";
    }

    if ($stmt->execute()) {
        header("location: w6.php");
    }
    
?>