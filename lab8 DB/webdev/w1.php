<?php include "db.php" ?>
<html>
<head><meta charset="utf-8">
<style>
    table,th,td{
        border: 1px solid black ;
    }
</style>
</head>
<body>

<?php

$stmt = $pdo->prepare("SELECT * FROM product");

$stmt->execute();

echo"<table>";
    echo"<thead>";
        echo"<tr>";
            echo"<th>รหัสสินค้า</th>";
            echo"<th>รหัสสินค้า</th>";
            echo"<th>รหัสสินค้า</th>";
            echo"<th>รหัสสินค้า</th>";
        echo"</tr>";
    echo"</thead>";
    echo "<tbody>";
        while ($row = $stmt->fetch()) {
            echo"<tr>";
                echo"<td>".$row ["pid"]."</td>";
                echo"<td>".$row ["pname"]."</td>" ;
                echo"<td>".$row ["pdetail"]."</td>";
                echo"<td>".$row ["price"]."</td>";

            echo"</tr>";
        }
    echo "</tbody>";
echo"</table>";  
?>

</body>
</html>