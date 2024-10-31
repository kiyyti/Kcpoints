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
    <style>
        tbody {
            color: white;
        }

        * {
            font-family: 'Mali', sans-serif;
        }
    </style>
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
                    <li><a href="admin.php" class="link active">สร้าง Qr code</a></li>
                    <li><a href="gifko.php" class="link">หน้าต่างคำขอ</a></li>
                    <li><a href="tableadmin.php" class="link">ตารางคะแนน</a></li>
                    <li><a href="aboutadmin.php" class="link">เกี่ยวกับ</a></li>
                </ul>
            </div>
            <div class="nav-button">
                

                <button class="btn-out">
                    <a href="../config/logout.php" class="out">ออกจากระบบ</a>
                </button>
                
            </div>
        </nav>

        <table id="customers">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>คะแนน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $rank = 1;
                    foreach ($data as $row) {
                        echo "<tr>
                        <td>" . $rank++ ."</td>
                        <td>" . htmlspecialchars($row["fname"]) . "</td>
                        <td>" . htmlspecialchars($row["lname"]) . "</td>
                        <td>" . htmlspecialchars($row["point"]) . "</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
    </div>
    
    <script src="../public/js/readQr.js"></script>
    <script src="../public/js/scroll.js"></script>
    <script>
        function fetchScores() {
            fetch('../config/fetch_scores.php')
            .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        return response.json();
        })

            .then(data => {
                const tbody = document.querySelector('#scoreTable tbody');
                tbody.innerHTML = ''; // เคลียร์ข้อมูลเก่า
                var rank = 1;
                data.forEach(row => {
                    tbody.innerHTML += `<tr>
                    <td>${row.rank++}</td>
                    <td>${row.fname}</td>
                    <td>${row.lname}</td>
                    <td>${row.point}</td>
                    </tr>`;
                });
            })
            
            .catch(error => console.error('Error fetching scores:', error));
        }

        document.addEventListener('DOMContentLoaded', () => {
            fetchScores(); // เรียกใช้ฟังก์ชันเมื่อโหลดหน้า
            setInterval(fetchScores, 5000); // อัปเดตทุก 5 วินาที
        });


    </script>
</body>
</html>
