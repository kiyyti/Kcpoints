<?php
    session_start();
    require_once "../config/db.php";

    if (isset($_SESSION['Email'])) {
        $useremail = $_SESSION['Email'];
        $query = $conn->prepare("SELECT fname, lname, point, score_gif, num_activity FROM users WHERE email = :email");
        $query->bindParam(":email", $useremail);
        $query->execute();
        if ($query->rowCount() > 0) {
            $stmt = $query->fetch(PDO::FETCH_ASSOC);
            $username = $stmt['fname'] . " " . $stmt['lname'];
            $point = $stmt['point'];
            $score_gif = $stmt['score_gif'];
            $num_activity = $stmt['num_activity'];
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
    <title>Homepage</title>
    <link rel="stylesheet" href="../public/css/background.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
    <link rel="stylesheet" href="../public/css/homepage.css">
    <link rel="stylesheet" href="../public/css/alert.css">
    <link rel="stylesheet" href="../public/css/editprofile.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/sw2.js"></script>
    <script src="../public/js/nav.js"></script>
</head>
<body>
    <div class="wrapper">
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
                    <li class="respon-link"><button id="readQr" class="respon-qr">แสกน Qr</button></li>
                    <li class="respon-link">
                        <button id="btn-out" class="respon-out">
                            <a href="../config/logout.php">ออกจากระบบ</a>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="nav-button" >
                <button class="btn-out" id="readQr" onclick="openscan()">แสกน QR</button>
                <button class="btn-out">
                    <a href="../config/logout.php" class="out">ออกจากระบบ</a>
                </button>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>  
        </nav>

        <?php if (isset($_SESSION['success'])) { ?>
            <script>
                showSuccess("<?php echo $_SESSION["success"];?>")
                <?php unset($_SESSION['success']); ?>
            </script>
        <?php } ?>

        <div class="content" id="content">  
            <div class="profile-container">
                <div class="box profile-box">
                    <div class="profile-header">
                        <div class="profile-details">
                            <img src="../public/picture/non.png" alt="Profile User" class="profileuser" id="profileuser">
                            <div class="profile-info">
                                <h2 class="username" id="username"><?php echo $username; ?></h2>
                                <p id="point">Points: <span id="point"><?php echo $point; ?></p>
                            </div>
                        </div>
                        <!-- ปุ่มแก้ไขโปรไฟล์ -->
                        <button class="edit-profile-btn" onclick="openEditWindow()">แก้ไขโปรไฟล์</button>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="content-row">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Statistics Section -->
                        <div class="box stats-box">
                            <h3>สถิติ</h3>
                            <ul>
                                <li id="completed-quests">อันดับของคุณ:<span id="completed-quests">4</span></li>
                                <li id="total-points">กิจกรรมที่เข้าร่วม:<span id="total-points"><?php echo "$num_activity" ?></span></li>
                                <li id="badges-count">คะแนนคงเหลือ:<span id="badges-count"><?php echo "$score_gif" ?></span></li>
                            </ul>
                        </div>

                        <!-- Activity Details Section -->
                        <div class="box activity-box">
                            <h3>กิจกรรมที่คุณเข้าร่วมทั้งหมด</h3>
                            <ul>
                                <li id="ac">กิจกรรมรับน้อง 30 คะแนน</li>
                                <li id="ac">วันไหว้ครู 20 คะแนน</li>
                                <li id="ac">วันขึ้นปีใหม่ 40 คะแนน</li>
                                <li id="ac">กิจกรรมรับน้อง 30 คะแนน</li>
                                <li id="ac">วันไหว้ครู 20 คะแนน</li>
                                <li id="ac">วันขึ้นปีใหม่ 40 คะแนน</li>
                            </ul>
                        </div>
                    </div>

                    <!-- News Section -->
                    <div class="box news-box">
                        <h3>แจ้งเตือน</h3>
                        <div class="news-content">
                            
                            <div class="success">
                                <svg class="wave_success" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,3" fill-opacity="1"></path></path>
                                </svg>



                                <div class="icon-container-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke-width="0" fill="currentColor" stroke="currentColor" class="icon_success">
                                        <path
                                            d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="message-text-container">
                                    <p class="message-text-success">สำเร็จ</p>
                                    <p class="sub-text">คุณได้เข้าสู่ระบบเป็นครั้งแรก</p>
                                </div>
                            </div>

                            <div class="alert">
                                <svg class="wave_alert" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                                </svg>

                                <div class="icon-container-alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" stroke-width="0" fill="currentColor" stroke="currentColor" class="icon_alert">
                                        <path
                                            d="M236.8,188.09,149.35,36.22h0a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM222.93,203.8a8.5,8.5,0,0,1-7.48,4.2H40.55a8.5,8.5,0,0,1-7.48-4.2,7.59,7.59,0,0,1,0-7.72L120.52,44.21a8.75,8.75,0,0,1,15,0l87.45,151.87A7.59,7.59,0,0,1,222.93,203.8ZM120,144V104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,180Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="message-text-container">
                                    <p class="message-text-alert">แจ้งเตือน</p>
                                    <p class="sub-text">กรุณาตรวจสอบความถูกต้อง</p>
                                </div>
                            </div>

                            <div class="error">
                                <svg class="wave_error" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                                </svg>

                                <div class="icon-container-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke-width="0" fill="currentColor" stroke="currentColor" class="icon_error">
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"></path>
                                    </svg>
                                </div>
                                <div class="message-text-container">
                                    <p class="message-text-error">ผิดพลาด</p>
                                    <p class="sub-text">มีบางอย่างผิดพลาดกรุณาลองอีกครั้ง</p>
                                </div>
                            </div>

                            <div class="error">
                                <svg class="wave_error" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                                </svg>

                                <div class="icon-container-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke-width="0" fill="currentColor" stroke="currentColor" class="icon_error">
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"></path>
                                    </svg>
                                </div>
                                <div class="message-text-container">
                                    <p class="message-text-error">ผิดพลาด</p>
                                    <p class="sub-text">มีบางอย่างผิดพลาดกรุณาลองอีกครั้ง</p>
                                </div>
                            </div>

                            <div class="error">
                                <svg class="wave_error" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                                </svg>

                                <div class="icon-container-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke-width="0" fill="currentColor" stroke="currentColor" class="icon_error">
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"></path>
                                    </svg>
                                </div>
                                <div class="message-text-container">
                                    <p class="message-text-error">ผิดพลาด</p>
                                    <p class="sub-text">มีบางอย่างผิดพลาดกรุณาลองอีกครั้ง</p>
                                </div>
                            </div>

                            <div class="error">
                                <svg class="wave_error" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0,256L11.4,240C22.9,224,46,192,69,192C91.4,192,114,224,137,234.7C160,245,183,235,206,213.3C228.6,192,251,160,274,149.3C297.1,139,320,149,343,181.3C365.7,213,389,267,411,282.7C434.3,299,457,277,480,250.7C502.9,224,526,192,549,181.3C571.4,171,594,181,617,208C640,235,663,277,686,256C708.6,235,731,149,754,122.7C777.1,96,800,128,823,165.3C845.7,203,869,245,891,224C914.3,203,937,117,960,112C982.9,107,1006,181,1029,197.3C1051.4,213,1074,171,1097,144C1120,117,1143,107,1166,133.3C1188.6,160,1211,224,1234,218.7C1257.1,213,1280,139,1303,133.3C1325.7,128,1349,192,1371,192C1394.3,192,1417,128,1429,96L1440,64L1440,320L1428.6,320C1417.1,320,1394,320,1371,320C1348.6,320,1326,320,1303,320C1280,320,1257,320,1234,320C1211.4,320,1189,320,1166,320C1142.9,320,1120,320,1097,320C1074.3,320,1051,320,1029,320C1005.7,320,983,320,960,320C937.1,320,914,320,891,320C868.6,320,846,320,823,320C800,320,777,320,754,320C731.4,320,709,320,686,320C662.9,320,640,320,617,320C594.3,320,571,320,549,320C525.7,320,503,320,480,320C457.1,320,434,320,411,320C388.6,320,366,320,343,320C320,320,297,320,274,320C251.4,320,229,320,206,320C182.9,320,160,320,137,320C114.3,320,91,320,69,320C45.7,320,23,320,11,320L0,320Z" fill-opacity="1"></path>
                                </svg>

                                <div class="icon-container-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" stroke-width="0" fill="currentColor" stroke="currentColor" class="icon_error">
                                        <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"></path>
                                    </svg>
                                </div>
                                <div class="message-text-container">
                                    <p class="message-text-error">ผิดพลาด</p>
                                    <p class="sub-text">มีบางอย่างผิดพลาดกรุณาลองอีกครั้ง</p>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <button class="respon-qr-homepage" id="readQr">แสกน QR</button>
            </div>
        </div>


        <!-- responsive -->
        <div class="content-respon" >
            <div class="profile-respon">
                <button onclick="openEditWindow()" class="edit-profile-respon">
                    <img src="../public/picture/non.png" alt="Profile User" class="profileuser-respon" id="profileuser">
                </button>
                <div class="profile-info-respon">
                    <h2 class="username-respon" id="username"><?php echo $username; ?></h2>
                    
                    <button class="edit-profile-btn-respon">
                        <p id="point-respon">Points: <span id="point"><?php echo $point; ?></p>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="achive-respon">
        <button class="activity-respon" onclick="open_achivewindow()">
            <img src="../public/picture/achive.svg" class="achive-svg">
            <h2 class="achive-text">กิจกรรม</h2>
        </button>
    </div>

    <div class="stats-respon">
        <button class="stats-btn" onclick="open_statswindow()">
        <img src="../public/picture/stats.svg" alt="" class="stats-svg">
        <h2 class="stats-text">สถิติ</h2>
        </button>
    </div>

    <div class="scanner-respon" >
        <button class="scanner-btn" id="readQr" onclick="openscan()">
            <img src="../public/picture/scanqr.png" class="scanner-svg">
            <h2 class="scanner-text">แสกนQr code</h2>
        </button>

        
    </div>

    <!--all window -->
    <div id="edit-profile-window" class="edit-window">
        <div class="edit-content">
            <span class="close-btn" onclick="closeEditWindow()">&times;</span>
            <h2>แก้ไขโปรไฟล์</h2>
            
            <label for="profile-pic-upload">เลือกรูปโปรไฟล์:</label>
            <input type="file" id="profile-pic-upload" accept="image/*" onchange="previewProfile(event)">
            <img id="profile-pic-preview" src="../public/picture/non.png" alt="Profile Preview" class="profile-pic-preview">

            <button class="save-btn" onclick="editProfile()">บันทึก</button>
            <button class="cancel-btn" onclick="closeEditWindow()">ยกเลิก</button>
        </div>
    </div>
    
    <div id="windowstats" class="windowstats">
        <div class="stats-window-content">
            <span class="close-btn" onclick="close_statswindow()">&times;</span>
            <h2>สถิติ</h2>
            <ul>
                <li id="head-stats-respon">อันดับของคุณ:<span id="under-stats-respon">4</span></li>
                <li id="head-stats-respon">กิจกรรมที่เข้าร่วม:<span id="under-stats-respon"><?php echo "$num_activity" ?></span></li>
                <li id="head-stats-respon">คะแนนคงเหลือ:<span id="under-stats-respon"><?php echo "$score_gif" ?></span></li>
            </ul>
        </div>
    </div>

    <div id="window-achive" class="window-achive">
        <div class="achive-window-content">
            <span class="close-btn" onclick="close_achivewindow()">&times;</span>
            <h2>กิจกรรมที่เข้าร่วม</h2>
        </div>
    </div>



    <script src="../public/js/readQr.js"></script>
    <script src="../public/js/homepage.js"></script>

</body>
</html>