<?php

    session_start();
    require_once "gifdb.php";


    if (isset($_POST['submit'])) {
        $prename = $_POST['name'];
        $class = $_POST['floor'];
        $tel = $_POST['telphone'];

        if (empty($prename)) {
            $_SESSION['error'] = 'กรุณากรอกชื่อ-นามสกุล';
            header("location: ../view/gif.php");
        } else if (empty($class)) {
            $_SESSION['error'] = 'กรุณากรอกห้อง/ชั้นของคุณ';
            header("location: ../view/gif.php");
        } else if (empty($tel)) {
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทรศัพท์';
            header('location: ../view/gif.php');
        } else {
                $stmt = $conn->prepare("INSERT INTO gif(p_name, class, tel)
                                        VALUES(:p_name, :clss, :tel)");
                $stmt->bindParam(":p_name", $prename);
                $stmt->bindParam(":clss", $class);
                $stmt->bindParam(":tel", $tel);
                $stmt->execute();
                $_SESSION["success"] = 'แลกของขวัญสำเร็จกรุณารอการติดต่อกลับไป';
                header("location: ../view/gif.php");
        }
    }
?>