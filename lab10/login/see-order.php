<?php
include "connect.php";
session_start();

if ($_SESSION["rule"] !== "admin") {
    echo "ไม่มีสิทธ์เข้าถึงข้อมูล";
    exit(); 
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?");
    $stmt->bindParam(1, $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<h2>รายการสั่งซื้อทั้งหมดของ $username</h2>";

        while ($row = $stmt->fetch()) {
            $orderId = $row["ord_id"];
            $orderDate = $row["ord_date"];
            $orderStatus = $row["status"];

            echo "<h3>รหัส Order: $orderId</h3>";
            echo "<p>วันที่ Order: $orderDate</p>";
            echo "<p>สถานะ: $orderStatus</p>";

            $itemStmt = $pdo->prepare("SELECT i.*, p.pname, p.price FROM item i JOIN product p ON i.pid = p.pid WHERE i.ord_id = ?");
            $itemStmt->bindParam(1, $orderId);
            $itemStmt->execute();

            if ($itemStmt->rowCount() > 0) {
                echo "<table border='1'>";
                echo "<tr><th>ชื่อรายการ</th><th>จำนวน</th><th>ราคาต่อชิ้น</th><th>รวมราคา</th></tr>";

                $orderTotalPrice = 0; 
                
                while ($row2 = $itemStmt->fetch()) {
                    $itemName = $row2["pname"];
                    $itemQuantity = $row2["quantity"];
                    $itemPrice = $row2["price"];
                    $subtotal = $itemPrice * $itemQuantity;

                    echo "<tr>";
                    echo "<td>$itemName</td>";
                    echo "<td>$itemQuantity</td>";
                    echo "<td>$itemPrice</td>";
                    echo "<td>$subtotal</td>";
                    echo "</tr>";

                    $orderTotalPrice += $subtotal; 
                }

                echo "</table>";
                echo "<p>ราคารวมสำหรับ Order นี้: $orderTotalPrice</p><hr>";
            }
        }

        echo "<br> <a href='user-home.php'>กลับไปยังหน้ารายการสั่งซื้อ</a>";
    } else {
        echo "ไม่พบรายการสั่งซื้อสำหรับ $username";
        echo "<br> <a href='user-home.php'>กลับไปยังหน้ารายการสั่งซื้อ</a>";
    }
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    echo "<br> <a href='user-home.php'>กลับไปยังหน้ารายการสั่งซื้อ</a>";
}
?>

<style>

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    h3 {
        color: #333;
    }

    p {
        color: #666;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }

    hr {
        border: 1px solid #ddd;
    }
</style>
