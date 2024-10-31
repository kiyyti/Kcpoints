<?php 

    session_start();
    require_once "db.php";
    
    if (isset($_POST['btnlogin'])) {
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        if (empty($email)) {
            header("location: ../view/login.php");
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../view/login.php");
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        } else if (empty($password)) {
            header("location: ../view/login.php");
            $_SESSION['error'] = 'กรุณากรอกเลขประจำตัวนักเรียน';
        } else {
            try {
                $check = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check->bindParam(":email", $email);
                $check->execute();
                $row = $check->fetch(PDO::FETCH_ASSOC);

                if ($check ->rowCount() > 0) {
                    $_SESSION['Email'] = $email;
                    if ($email == $row['email']) {
                        if (password_verify($password , $row['stid'])) {
                            if ($row['urole'] == 'admin') {
                                header('location: ../view/admin.php');
                                $_SESSION['success'] = 'ยินดีต้อนรับเข้าสู่ระบบ';
                            } else if ($row["urole"] == 'user') {
                                $_SESSION['success'] = 'ยินดีต้อนรับเข้าสู่ระบบ';
                                header("location: ../view/index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านของคุณไม่ถูกต้อง';
                            header('location: ../view/login.php');
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลของคุณไม่ถูกต้อง';
                        header("location: ../view/login.php");
                    }
                } else {
                    $_SESSION['error'] = "ขออภัยไม่พบบัญชีผู้ใช้ของคุณ";
                    header("location: ../view/login.php");
                }
            } catch (PDOException $e) {
                echo 'error: ' . $e->getMessage();
            }
        }
    }
?>