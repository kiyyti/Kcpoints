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
    <script src="../public/js/nav.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <!-- end navbar -->
        
        <div class="aboutcontent">
            <div>
                <div class="kc-space">
                    <div class="kc-space-item">
                        <h2 class="kc-typography" style="color: white; text-align: center;">ช่องทางการติตตามกิจกรรม</h2>
                    </div>
                </div>
                <div class="contact">
                        
                    <!-- start box facebook -->
                    <a href="https://web.facebook.com/KuchinaraiSchoolSPM24" class="kc-typography" target="_blank" rel="noopener noreferrer">
                        <div class="contactsocial">
                            <div class="icon">
                                <span class="kcicon kcicon-facebook" role="img" aria-label="facebook">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="facebook" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32zm-32 736H663.9V602.2h104l15.6-120.7H663.9v-77.1c0-35 9.7-58.8 59.8-58.8h63.9v-108c-11.1-1.5-49-4.8-93.2-4.8-92.2 0-155.3 56.3-155.3 159.6v89H434.9v120.7h104.3V848H176V176h672v672z"></path>
                                    </svg>
                                </span>
                            </div>
                            <span class="kc-typography">โรงเรียนกุฉินารายณ์</span>
                        </div>
                    </a>
                        <!-- end box facebook -->

                    <a href="https://web.facebook.com/studentcouncilofkuchinaraischool" class="kc-typography" target="_blank" rel="noopener noreferrer">
                        <div class="contactsocial">
                            <div class="icon">
                                <span class="kcicon kcicon-facebook" role="img" aria-label="facebook">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="facebook" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32zm-32 736H663.9V602.2h104l15.6-120.7H663.9v-77.1c0-35 9.7-58.8 59.8-58.8h63.9v-108c-11.1-1.5-49-4.8-93.2-4.8-92.2 0-155.3 56.3-155.3 159.6v89H434.9v120.7h104.3V848H176V176h672v672z"></path>
                                    </svg>
                                </span>
                            </div>
                            <span class="kc-typography">สภานักเรียนโรงเรียนกุฉินารายณ์</span>
                        </div>
                    </a>
                    <!-- end box facebook2 -->    

                    <a href="https://www.instagram.com/std.council.kc/" class="kc-typography" target="_blank" rel="noopener noreferrer">
                        <div class="contactsocial">
                            <div class="icon">
                                <span class="kcicon kcicon-instagram" role="img" aria-label="instagram">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="instagram" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M512 306.9c-113.5 0-205.1 91.6-205.1 205.1S398.5 717.1 512 717.1 717.1 625.5 717.1 512 625.5 306.9 512 306.9zm0 338.4c-73.4 0-133.3-59.9-133.3-133.3S438.6 378.7 512 378.7 645.3 438.6 645.3 512 585.4 645.3 512 645.3zm213.5-394.6c-26.5 0-47.9 21.4-47.9 47.9s21.4 47.9 47.9 47.9 47.9-21.3 47.9-47.9a47.84 47.84 0 00-47.9-47.9zM911.8 512c0-55.2.5-109.9-2.6-165-3.1-64-17.7-120.8-64.5-167.6-46.9-46.9-103.6-61.4-167.6-64.5-55.2-3.1-109.9-2.6-165-2.6-55.2 0-109.9-.5-165 2.6-64 3.1-120.8 17.7-167.6 64.5C132.6 226.3 118.1 283 115 347c-3.1 55.2-2.6 109.9-2.6 165s-.5 109.9 2.6 165c3.1 64 17.7 120.8 64.5 167.6 46.9 46.9 103.6 61.4 167.6 64.5 55.2 3.1 109.9 2.6 165 2.6 55.2 0 109.9.5 165-2.6 64-3.1 120.8-17.7 167.6-64.5 46.9-46.9 61.4-103.6 64.5-167.6 3.2-55.1 2.6-109.8 2.6-165zm-88 235.8c-7.3 18.2-16.1 31.8-30.2 45.8-14.1 14.1-27.6 22.9-45.8 30.2C695.2 844.7 570.3 840 512 840c-58.3 0-183.3 4.7-235.9-16.1-18.2-7.3-31.8-16.1-45.8-30.2-14.1-14.1-22.9-27.6-30.2-45.8C179.3 695.2 184 570.3 184 512c0-58.3-4.7-183.3 16.1-235.9 7.3-18.2 16.1-31.8 30.2-45.8s27.6-22.9 45.8-30.2C328.7 179.3 453.7 184 512 184s183.3-4.7 235.9 16.1c18.2 7.3 31.8 16.1 45.8 30.2 14.1 14.1 22.9 27.6 30.2 45.8C844.7 328.7 840 453.7 840 512c0 58.3 4.7 183.2-16.2 235.8z"></path>
                                    </svg>
                                </span>
                            </div>
                            <span class="kc-typography">สภานักเรียนโรงเรียนกุฉินารายณ์</span>
                        </div>
                    </a>
                    <!-- end box ig -->

                    <!-- start tel box -->
                    <a href="tel:043-851366" class="kc-typography" target="_blank" rel="noopener noreferrer">
                        <div class="contactsocial">
                            <div class="icon">
                                <span class="kcicon kcicon-phone" role="img" aria-label="phone">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="instagram" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M877.1 238.7L770.6 132.3c-13-13-30.4-20.3-48.8-20.3s-35.8 7.2-48.8 20.3L558.3 246.8c-13 13-20.3 30.5-20.3 48.9 0 18.5 7.2 35.8 20.3 48.9l89.6 89.7a405.46 405.46 0 01-86.4 127.3c-36.7 36.9-79.6 66-127.2 86.6l-89.6-89.7c-13-13-30.4-20.3-48.8-20.3a68.2 68.2 0 00-48.8 20.3L132.3 673c-13 13-20.3 30.5-20.3 48.9 0 18.5 7.2 35.8 20.3 48.9l106.4 106.4c22.2 22.2 52.8 34.9 84.2 34.9 6.5 0 12.8-.5 19.2-1.6 132.4-21.8 263.8-92.3 369.9-198.3C818 606 888.4 474.6 910.4 342.1c6.3-37.6-6.3-76.3-33.3-103.4zm-37.6 91.5c-19.5 117.9-82.9 235.5-178.4 331s-213 158.9-330.9 178.4c-14.8 2.5-30-2.5-40.8-13.2L184.9 721.9 295.7 611l119.8 120 .9.9 21.6-8a481.29 481.29 0 00285.7-285.8l8-21.6-120.8-120.7 110.8-110.9 104.5 104.5c10.8 10.8 15.8 26 13.3 40.8z"></path>
                                    </svg>
                                </span>
                            </div>
                            <span class="kc-typography">043-851366</span>
                        </div>
                    </a>
                    <!-- end tel box -->

                    <!-- start email box -->
                    <a href="tel:043-851366" class="kc-typography" target="_blank" rel="noopener noreferrer">
                        <div class="contactsocial">
                            <div class="icon">
                                <span class="kcicon kcicon-phone" role="img" aria-label="phone">
                                    <svg viewBox="64 64 896 896" focusable="false" data-icon="instagram" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                        <path d="M928 160H96c-17.7 0-32 14.3-32 32v640c0 17.7 14.3 32 32 32h832c17.7 0 32-14.3 32-32V192c0-17.7-14.3-32-32-32zm-40 110.8V792H136V270.8l-27.6-21.5 39.3-50.5 42.8 33.3h643.1l42.8-33.3 39.3 50.5-27.7 21.5zM833.6 232L512 482 190.4 232l-42.8-33.3-39.3 50.5 27.6 21.5 341.6 265.6a55.99 55.99 0 0068.7 0L888 270.8l27.6-21.5-39.3-50.5-42.7 33.2z"></path>
                                    </svg>
                                </span>
                            </div>
                            <span class="kc-typography">office@kuchinarai.ac.th</span>
                        </div>
                    </a>
                    <!-- end email box -->

                    <!-- start web site -->
                    <a href="http://www.kuchinarai.ac.th/" class="kc-typography" target="_blank" rel="noopener noreferrer">
                        <div class="contactsocial">
                            <div class="icon">
                                <span class="kcicon kcicon-website" role="img" aria-label="kcicon-website">
                                <i class="fas fa-globe"></i>
                                </span>
                            </div>
                            <span class="kc-typography">Kuchinarai website</span>
                        </div>
                    </a>
                    <!-- end web site -->
                        
                </div>

        <div class="row">
            <h2 style="text-align:center; color: white;">ผู้จัดทำโครงงาน</h2>
            <div class="column">
                <div class="card">
                    <img src="../public/picture/kitti.jpg" alt="Jane" class="profile">
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
                    <img src="../public/picture/panhathai.jpg" alt="Mike" class="profile">
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
                    <img src="../public/picture/phanuwat.jpg" alt="John" class="profile">
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
                        <img src="../public/picture/krupom.jpg" alt="Jane" class="profile">
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
                        <img src="../public/picture/krutic.jpg" alt="Jane" class="profile">
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
                        <img src="../public/picture/pwen.jpg" alt="Jane" class="profile">
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

            
        </div>

        <h2 class="text-maps">แผนที่มายังโรงเรียน</h2>
            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3824.7497279249005!2d104.04185487514603!3d16.538727884210942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313d117c90eee297%3A0x18de80cb5bb9ab4e!2z4LmC4Lij4LiH4LmA4Lij4Li14Lii4LiZ4LiB4Li44LiJ4Li04LiZ4Liy4Lij4Liy4Lii4LiT4LmM!5e0!3m2!1sth!2sth!4v1728648472221!5m2!1sth!2sth" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <h2 id="text-reccomment">วิดีโอแนะนำโรงเรียน</h2>
            <div class="reccoment">
                <iframe src="https://www.youtube.com/embed/n80Ju17ZuXw?si=FigKUL4SOzcbF_qp&amp;start=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> 
            </div>
        
    </div>

    <script src="../public/js/readQr.js"></script>
    <script src="../public/js/scroll.js"></script>
</body>
</html> 