<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=kcpoint", $username , $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        // echo "เสร็จแล้วจ้าาาาาาาาาาาา";
    } catch(PDOException $e) {
        // echo "ไม่ได้โห่เศร้าว่า เครียดว่ะ" . $e->getMessage();
    }
?>
