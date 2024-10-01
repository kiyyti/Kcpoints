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
    <title>Homepage</title>
    <link rel="stylesheet" href="../public/css/background.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
    <link rel="stylesheet" href="../public/css/homepage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/sw2.js"></script>
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
                <button class="btn-out" id="readQr">แสกน QR</button>
                <button class="btn-out">
                    <a href="../config/logout.php" class="out">ออกจากระบบ</a>
                </button>
            </div>
            
        </nav>
        <!-- end navbar -->

        <?php if (isset($_SESSION['success'])) { ?>
            <script>
                showSuccess("<?php echo $_SESSION["success"];?>")
                <?php unset($_SESSION['success']); ?>
            </script>
        <?php } ?>

        <div class="content">  
            <div class="card">  
                <div class="profile">
                    <h1 class="heads">Welcome students of Kuchinarai School.</h1>
                    <h3 class="unheads">PROFILE</h3>
                    <div class="box">
                        <div class="avatar">
                            <div class="avatar--t6-Pn">
                                <div>
                                    <figure class="content-image__figure--7vume">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <img src="../public/picture/images.jpg" alt="User avatar." loading="lazy" width="170px" height="170px">
                                        </picture>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <form action="/profile/upload" method="post" enctype="multipart/form-data">
                            <input type="file" class="point-btn" name="avatar" />
                            <button class="point-btn" >Upload</button>
                        </form>
                        <div class="form-wrapper">
                            <div class="text--gq6o- text--is-fixed-size--5i4oU text--is-xl---ywR- label--57-z9 label--is-dirty--oQgf4 label--is-error--PTn8Y basic-input--rrvny username-input--slW1S" data-t="username-input">
                                <h2>
                                    <?php echo $username; ?>
                                </h2>
                                <!-- name -->
                            </div>
                            <span>
                                <button class="point-btn">
                                    <?php 
                                        echo $point . " " . "point";
                                    ?>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../public/js/readQr.js"></script>

</body>
</html>