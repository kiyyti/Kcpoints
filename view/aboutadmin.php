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
    <title>About</title>
    <link rel="stylesheet" href="../public/css/navbar.css">
    <link rel="stylesheet" href="../public/css/about.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <style>


        * {
            font-family: 'Mali', sans-serif;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- start navbar -->
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
        <!-- end navbar -->
        
        <div class="row">
            <h2 style="text-align:center; color: white;">ผู้จัดทำโครงงาน</h2>
            <div class="column">
                <div class="card">
                    <img src="../public/picture/kitti.jpg" alt="Jane" class="profile" style="width:100%">
                    <div class="container">
                        <h2 class="name">กิตติ เจียมอนุกูลกิจ</h2>
                        <p class="title">หน้าที่</p>
                        <p class="work">เอ่อทำไรอ่ะคนเนี้ย</p>
                        <p class="email">kit.kng18@gmail.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">
                    <img src="../public/picture/panhathai.jpg" alt="Mike" class="profile" style="width:100%">
                    <div class="container">
                        <h2 class="name">ปานหทัย สุพร</h2>
                        <p class="title">หน้าที่</p>
                        <p class="work">ปกครองผืนป่า</p>
                        <p class="email">saipan@gmail.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>
        
            <div class="column">
                <div class="card">
                    <img src="../public/picture/phanuwat.jpg" alt="John" class="profile" style="width:100%">
                    <div class="container">
                        <h2 class="name">ภานุวัฒน์ จันทะโยธา</h2>
                        <p class="title">หน้าที่</p>
                        <p class="work">มือดีหนองปรือ</p>
                        <p class="email">phanuwat@gmail.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>

            <h2 style="text-align:center; color: white;">ที่ปรึกษาโครงงาน</h2>
            <div class="techer">
                <div class="column">
                    <div class="card">
                        <img src="../public/picture/krupom.jpg" alt="Jane" class="profile" style="width:100%">
                        <div class="container">
                            <h2 class="name">ภาสกร สายนาโก</h2>
                            <p class="title">ตำแหน่ง</p>
                            <p class="work">ที่ปรึกษาโครงงาน</p>
                            <p class="email">pasakorn@gmail.com</p>
                            <p><button class="button">Contact</button></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="techer">
                <div class="column">
                    <div class="card">
                        <img src="../public/picture/krutic.jpg" alt="Jane" class="profile" style="width:100%">
                        <div class="container">
                            <h2 class="name">บุศรินทร์ หาญสินธุ์</h2>
                            <p class="title">ตำแหน่ง</p>
                            <p class="work">เลี้ยงดูผู้จัดทำ</p>
                            <p class="email">bootsarin@gmail.com</p>
                            <p><button class="button">Contact</button></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="techer">
                <div class="column">
                    <div class="card">
                        <img src="../public/picture/pwen.jpg" alt="Jane" class="profile" style="width:100%">
                        <div class="container">
                            <h2 class="name">พิสิษฐ์ ศรีชำนาจ</h2>
                            <p class="title">ตำแหน่ง</p>
                            <p class="work">ตัวตึงมอขอไข่</p>
                            <p class="email">pisit@gmail.com</p>
                            <p><button class="button">Contact</button></p>
                        </div>
                    </div>
                </div>
            </div>

            <h2 style="text-align:center;color:white;">แผนที่มายังโรงเรียน</h2>
            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3824.7497279249005!2d104.04185487514603!3d16.538727884210942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313d117c90eee297%3A0x18de80cb5bb9ab4e!2z4LmC4Lij4LiH4LmA4Lij4Li14Lii4LiZ4LiB4Li44LiJ4Li04LiZ4Liy4Lij4Liy4Lii4LiT4LmM!5e0!3m2!1sth!2sth!4v1728648472221!5m2!1sth!2sth" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <h2 style="text-align:center;color:white;margin-top:3%;">วิดีโอแนะนำโรงเรียน</h2>
            <div class="reccoment">
                <iframe width="1000" height="450" src="https://www.youtube.com/embed/n80Ju17ZuXw?si=FigKUL4SOzcbF_qp&amp;start=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> 
            </div>
        </div>
    </div>

    <script src="../public/js/readQr.js"></script>
    <script src="../public/js/scroll.js"></script>
</body>
</html> 