<?php
    declare(strict_types = 1);
    include('../includes/db_conn.php');
    session_start();
    $user_id = $_SESSION['id'];
    if(isset($_POST['check'])){
        $query = "SELECT role FROM users WHERE id = {$user_id}";
        if($result = mysqli_query($link,$query)){
            $row = mysqli_fetch_assoc($result);
            $current_role = $row['role'];
            $logged_role = $_SESSION['role'];
            if($current_role != $logged_role){
                if($current_role > 1){
                    $query = "DELETE FROM notifications WHERE type = 1 AND receipient = {$user_id}";
                    mysqli_query($link,$query);
                    $query = "INSERT INTO notifications VALUES ({$user_id},4,NULL,0)";
                    mysqli_query($link,$query);
                }
                header('location:../logout.php');
                die;
            }
        }
    }
?>