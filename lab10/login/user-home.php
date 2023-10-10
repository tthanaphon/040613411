<?php
    include "connect.php";
    session_start();
    if (empty($_SESSION["username"]) ) {
    header("location: login-form.php");
    }
?>

<html>
<head>
    <style>
  
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Welcome  <?= $_SESSION["fullname"] ?></h1>

    <?php
    if ($_SESSION["rule"] === "admin") { //admin
        $stmt = $pdo->prepare("SELECT username, COUNT(*) as order_count FROM orders GROUP BY username");
        $stmt->execute();
        echo "<a href='stock.php'>stock</a> <br>";
        if ($stmt->rowCount() > 0) {
            echo "<h2>จำนวน Order ของผู้ใช้แต่ละคน</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ชื่อผู้ใช้</th><th>จำนวน Order</th></tr>";

            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td><a href='see-order.php?username=" . $row["username"] . "'>" . $row["order_count"] . "</a></td>";
                echo "</tr>";
            }

            echo "</table> <br>";

        } else {
            echo "ไม่พบข้อมูล Order ของผู้ใช้";
        }
    } else { //user
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ?");
        $stmt->bindParam(1, $_SESSION["username"]);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<h2>รายการสั่งซื้อ Order ของคุณ</h2>";

            while ($row = $stmt->fetch()) {
                echo "<h3>รหัส Order: " . $row["ord_id"] . "</h3>";
                echo "<p>วันที่ Order: " . $row["ord_date"] . "</p>";
                echo "<p>สถานะ: " . $row["status"] . "</p>";

                $stmt2 = $pdo->prepare("SELECT i.pid, i.quantity, p.pname, p.price FROM item i JOIN product p ON i.pid = p.pid WHERE i.ord_id = ?");
                $stmt2->bindParam(1, $row["ord_id"]);
                $stmt2->execute();

                if ($stmt2->rowCount() > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>ชื่อ</th><th>จำนวน</th><th>ราคาต่อชิ้น</th><th>รวมราคา</th></tr>";

                    $orderTotalPrice = 0; 

                    while ($row2 = $stmt2->fetch()) {
                        $subtotal = $row2["price"] * $row2["quantity"];
                        echo "<tr>";
                        echo "<td>" . $row2["pname"] . "</td>";
                        echo "<td>" . $row2["quantity"] . "</td>";
                        echo "<td>" . $row2["price"] . "</td>";
                        echo "<td>" . $subtotal . "</td>";
                        echo "</tr>";

                        $orderTotalPrice += $subtotal; 
                    }

                    echo "</table>";
                    echo "<p>ราคารวมสำหรับ Order นี้: " . $orderTotalPrice . "</p><hr>";
                }
                
            }
        } else {
            echo "ไม่พบรายการสั่งซื้อ Order ของคุณ <br><br>";
        }
    }

    ?>

    หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
    </body>
</html>
