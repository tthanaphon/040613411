<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>เข้าสู่ระบบ</h1>

    <form action="login.php">
        <table border="1" cellpadding="10" cellspacing="5">
            <tr><td>Username: </td><td><input type="text" 
                name="username" autofocus required  ></td></tr>
            <tr><td>Password: </td><td><input type="text"  name="password" required></td></tr>
            <tr><td colspan="2">กรุณาพิมพ์ตามตัวเลขที่ปรากฏ: <br>1559 <br>
                <input type="text" required 
                name="code"
                pattern=1559 ></td></tr>
        </table>
        <br><br>

        <input type="image" src="login.png" alt="Submit" width="70" height="70">
</form>
</body>
</html>