<?php
session_start();
include "connect.php";

if ($_SESSION["rule"] !== "admin") {
    echo "ไม่มีสิทธ์ การเข้าถึงข้อมูลสต๊อกสินค้า";
    // header("Location: user-home.php"); 
    exit(); 
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>สินค้าคงเหลือ</title>
    <style>
     
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>สินค้าคงเหลือ</h1>

    <?php
    // ดึงข้อมูลสินค้าที่คงเหลืออยู่ในคลังจากฐานข้อมูล
    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>รหัสสินค้า</th><th>ชื่อสินค้า</th><th>คงเหลือ</th><th>ราคา</th></tr>";

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["pid"] . "</td>";
            echo "<td>" . $row["pname"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "ไม่พบสินค้าคงเหลือในคลัง";
    }
    ?>

    <br>
    <a href='user-home.php'>กลับไปยังหน้าหลัก</a>
</body>
</html>
