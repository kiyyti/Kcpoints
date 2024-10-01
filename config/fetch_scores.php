<?php
session_start();
require_once "../config/db.php"; // เชื่อมต่อฐานข้อมูล

$query = $conn->prepare("SELECT fname, lname, point FROM users ORDER BY point DESC");
$query->execute();
$data = [];

if ($query->rowCount() > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
}

// ส่งข้อมูล JSON กลับไปยัง JavaScript
header('Content-Type: application/json');
echo json_encode($data);
?>
