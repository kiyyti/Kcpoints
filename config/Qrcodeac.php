<?php
    session_start();
    require_once "../config/db.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $activity = $_POST['activity'];
        $score = $_POST['score'];
        $check_email = $_SESSION['Email'];

        if (!empty($activity) && !empty($score)) {
            $query = $conn->prepare("UPDATE users SET point = point + :score Where email = :email");
            $query->bindParam(":score", $score, PDO::PARAM_INT);
            $query->bindParam(":email", $check_email, PDO::PARAM_STR);
            $query->execute();

        }
    }
?>

