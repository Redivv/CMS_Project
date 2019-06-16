<?php
    declare(strict_types = 1);
    include('../includes/db_conn.php');
    session_start();
    $user_id = $_SESSION['id'];
    if(isset($_POST['check'])){
        $query = "SELECT role, ban_date FROM users WHERE id = {$user_id}";
        if($result = mysqli_query($link,$query)){
            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                $current_role = $row['role'];
                $logged_role = $_SESSION['role'];
                $ban_date = $row['ban_date'];
                if(($ban_date != '0000-00-00') && ($ban_date <= date('Y-m-d'))){  // check whether your ban has passed
                    $query = "UPDATE users SET role = 2, ban_date = '0000-00-00' WHERE id = {$user_id}";
                    mysqli_query($link,$query);
                    $query = "DELETE FROM notifications WHERE type = 1 AND receipient = {$user_id}";
                    mysqli_query($link,$query);
                    $query = "INSERT INTO notifications VALUES ({$user_id},4,NULL,0)";
                    mysqli_query($link,$query);
                    echo json_encode('redirect');
                    session_abort();
                    die;
                }
                elseif($current_role != $logged_role){      // check wheter you were unbanned/banned by administrator
                    echo json_encode('redirect');
                    session_abort();
                    die;
                }
            }else{  // if your account doesn't exist, logout
                echo json_encode('redirect');
                session_abort();
                die;
            }
        }
    }
?>