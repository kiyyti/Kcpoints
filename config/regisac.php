<?php

    session_start();
    require_once "db.php";

    if (isset($_POST['submit'])) {
        $fname = $_POST['FirstName'];
        $lname = $_POST['LastName'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $point = 0;
        $urole = 'user';
        
        if (empty($fname)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ!';
            header("location: ../view/login.php");
        } else if(empty($lname)) {
            $_SESSION['error'] = 'กรุณากรอกนามสกุล!';
            header("location: ../view/login.php");
        } else if (empty($email)){
            $_SESSION["error"] = 'กรุณากรอกอีเมล!';
            header("location: ../view/login.php");
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'ขออภัยรูปแบบอีเมลของคุณไม่ถูกต้อง';
            header("location: ../view/login.php");
        } else if(empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกเลขประจำตัวนักเรียน!';
            header("location: ../view/login.php");
        } else {
            try {
                $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
                $check_email->bindParam(":email", $email);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(fname, lname, email, stid, point, urole)
                                            VALUES(:fname, :lname, :email, :stid, :point, :urole)");
                    $stmt->bindParam(":fname", $fname);
                    $stmt->bindParam(":lname", $lname);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":stid", $passwordHash);
                    $stmt->bindParam(":point", $point);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->execute();
                    $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว!";
                    $_SESSION['Email'] = $email;
                    header("location: ../view/index.php");
                } else {
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: ../view/index.php");
                    }
                } catch(PDOException $e) {
                    echo "มีปัญหาอีกละ เศร้าว้า เคลียดว้า โอ๊ว: " . $e->getMessage();
            }
        }
    }
?>   