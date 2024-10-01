<?php
    session_start();
    require_once "../config/db.php";

    if (isset($_SESSION['Email'])) {
        $useremail = $_SESSION['Email'];
        $query = $conn->prepare("SELECT fname, lname, point FROM users WHERE email = :email");
        $query->bindParam(":email", $useremail);
        $query->execute();
        if ($query->rowCount() > 0) {
            $name = $query->fetch(PDO::FETCH_ASSOC);
            $username = $name['fname'] . " " . $name['lname'];
            $point = $name['point'];
        } else {
            $username = 'ไม่พบบัญชีผู้ใช้';
        }
    } else {
        header("location: ../view/login.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem rewards</title>
    <link rel="stylesheet" href="../public/css/background.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
    <link rel="stylesheet" href="../public/css/homepage.css">
</head>
<body>
    <div class="wrapper">
        <!-- start navbar -->
        <nav class="nav">
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
                <button class="btn-out" id="readQr" >แสกน QR</button>
                <button class="btn-out" id="registerBtn">
                    <a href="../config/logout.php" class="out">ออกจากระบบ</a>
                </button>
            </div>
            
        </nav>
        <!-- end navbar -->


    </div>

    <script src="../public/js/readQr.js"></script>
</body>
</html>