<?php 
    session_start();
    require_once "../config/Qrcodedb.php";
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
    <title>Admin</title>
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/sw2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode/1.4.4/qrcode.min.js"></script>
    <script src="../public/js/genQr.js"></script>

</head>
<body>
    <div class="warpper">

    <nav class="nav">
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
            <div class="nav-button" >
                <button class="btn-out">
                    <a href="../config/logout.php" class="out">ออกจากระบบ</a>
                </button>
            </div>
        </nav>

    <div class="generateqr">
        <h1 align="center">Generate qrcode</h1>
        <form action="../config/Qrcodeac.php" method="POST" id="genqr">
            <center>    
            <div class="input-wrapper">
                <input type="text" class="head-activity" id="activity" name="activity" placeholder="หัวข้อกิจกรรม">
                <input type="number" class="head-activity" name="point" class="point" id="point" placeholder="คะแนน">
                <div class="qrcode">
                    <canvas id="qrcode"></canvas>
                </div>
                <button class="gen" name="gencode" id="gencode">สร้าง Qr code</button>
                
            </div>
        </center>
    </form>
    </div>
</div> 


<script>
        document.getElementById("genqr").addEventListener("submit", function(event) {
    event.preventDefault();  // ป้องกันการ reload หน้าเว็บ

    const activity = document.getElementById("activity").value.trim();
    const score = document.getElementById("point").value.trim();

    if (activity === "" || score === "") {
        Swal.fire({
            icon: 'error',
            title: 'ข้อผิดพลาด',
            text: 'กรุณากรอกข้อมูลให้ครบถ้วน'
        });
        return;  
    }

    const maxActivityLength = 10;
    const qrcodeData = `เข้าร่วมกิจกรรม:${activity.slice(0, maxActivityLength)} คะแนนที่ได้:${score}`;

    document.getElementById("qrcode").innerHTML = "";

    QRCode.toCanvas(document.getElementById("qrcode"), qrcodeData, { width: 200 }, function (error) {
        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'ข้อผิดพลาด',
                text: 'ไม่สามารถสร้าง QR code ได้'
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: 'QR code ถูกสร้างแล้ว'
            });

            $.ajax({
                url: '../config/Qrcodeac.php',
                type: 'POST',
                data: {
                    activity: activity,
                    score: score
                },
                success: function(response) {
                    console.log("ข้อมูลถูกบันทึกในฐานข้อมูล:", response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("เกิดข้อผิดพลาดในการบันทึกข้อมูล:", textStatus, errorThrown);
                }
            }); 
        }
    });
});

</script>




</body>
</html>