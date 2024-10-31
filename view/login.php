<?php
    session_start();
    require_once '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/form.css">
    <link rel="stylesheet" href="../public/css/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/sw2.js"></script>
    <title>Login & Registration</title>
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
    <!-- start navbar -->
    <nav class="nav">
        <div class="nav-logo">
            <p>
                <img src="../public/picture/logoschool.svg" alt="school_logo" width="50px" class="logoschool">
            </p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">หน้าแรก</a></li>
                <li><a href="#" class="link">ตารางคะแนน</a></li>
                <li><a href="#" class="link">แลกของรางวัล</a></li>
                <li><a href="#" class="link">เกี่ยวกับ</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">เข้าสู่ระบบ</button>
            <button class="btn" id="registerBtn" onclick="register()">สมัครสมาชิก</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
    <!-- end navbar -->

    <!-----------------------------start Form boxๆ เสียงนี้พันธุ์ซามอยด์ ----------------------------------->    
    <div class="form-box">
        
        <!-------------------start login boxๆ พันธุ์คอร์กี้้ -------------------------->

        <div class="login-container" id="login">
            <form action="../config/loginac.php" method="POST">
                <?php if (isset($_SESSION['error'])) { ?>
                        <div class="aleart aleart-danger" role='aleart'>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <script>
                                    showError("<?php echo $_SESSION['error']; ?>")
                                    <?php  unset($_SESSION['error']); ?>
                                </script>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <div class="top">
                    <header>เข้าสู่ระบบ</header>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="บัญชี หรือ อีเมล" name="Email">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="เลขประจำตัวนักเรียน" name="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <button type="submit" class="submit" name="btnlogin">เข้าสู่ระบบ</button>
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check" class="member">จดจำรหัสผ่าน</label>
                    </div>
            </form>
                <div class="two">
                    <span clss="regi">หากคุณยังไม่ได้สมัครบัญชีกรุณา <a href="#" onclick="register()" style="color: white;">สมัครสมาชิก</a></span>
                </div>
            </div>
    </div>
        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <header>สมัครสมาชิก</header>
            </div>
            <form action="../config/regisac.php" method="post">
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="ชื่อ" name="FirstName">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="นามสกุล" name="LastName">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="อีเมล" name="Email">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="เลขประจำตัวนักเรียน" name="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <button type="submit" class="submit" name="submit">สมัครสมาชิก</button>
            </div>
        </form>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check">จดจำรหัสผ่าน</label>
                </div>
                <div class="two">
                    <span>หากมีบัญชีแล้ว <a href="#" onclick="login()" style="color: white;">เข้าสู่ระบบ</a></span>
                </div>
            </div>
        </div>
    </div>
</div>   


<script src="../public/js/nav.js"></script>
<script src="../public/js/login.js"></script>

</body>
</html>