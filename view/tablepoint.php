<?php
session_start();
require_once "../config/db.php"; // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลคะแนนจากฐานข้อมูล
$query = $conn->prepare("SELECT fname, lname, point FROM users ORDER BY point DESC");
$query->execute();
$data = [];
if ($query->rowCount() > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
} else {
    $data = []; // ถ้าไม่มีข้อมูล
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table score</title>
    <link rel="stylesheet" href="../public/css/navbar.css">
    <link rel="stylesheet" href="../public/css/tablescore.css">
</head>
<body>
    <div class="wrapper">

        <nav class="nav" id="navbar">
            <div class="nav-logo">
                <p>
                    <img src="../public/picture/logoschool.svg" alt="school_logo" width="50px" class="logoschool">
                </p>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="index.php" class="link active">หน้าแรก</a></li>
                    <li><a href="tablepoint.php" class="link">ตารางคะแนน</a></li>
                    <li><a href="gif.php" class="link">แลกของรางวัล</a></li>
                    <li><a href="about.php" class="link">เกี่ยวกับ</a></li>
                </ul>
            </div>
            <div class="nav-button">
                
                <button class="btn-out" id="readQr">แสกน QR</button>
                <button class="btn-out">
                    <a href="../config/logout.php" class="out">ออกจากระบบ</a>
                </button>
                
            </div>
        </nav>

        <table id="customers">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($data as $row) {
                        echo "<tr>
                        <td>" . htmlspecialchars($row["fname"]) . "</td>
                        <td>" . htmlspecialchars($row["lname"]) . "</td>
                        <td>" . htmlspecialchars($row["point"]) . "</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
    </div>
    
    <script src="../public/js/fetchscore.js"></script>
    <script src="../public/js/readQr.js"></script>
</body>
</html>
