<?php
  include('../includes/db_conn.php');
  session_start();
  $user_id = $_SESSION['id'];

  // Processing Ajax Request
  if(isset($_POST['view'])){
    if($_POST['view'] === 'seen2'){  // Changing notification status to 2 - seen, no notifications, no display
       $update_query = "DELETE FROM notifications WHERE receipient = {$user_id} AND status = 0 AND type != 1";
       mysqli_query($link, $update_query);
    }

    $query = "SELECT type, link FROM notifications WHERE receipient = {$user_id}";
    $result = mysqli_query($link, $query);
    $count = mysqli_num_rows($result);
    $output = '';  // if an error occurs the output will still exist
    if($count > 0){
    while($row = mysqli_fetch_assoc($result)){    // preparing the notifications
        $not_link = $row['link'];
        switch($row['type']){
            case 1:
            $output .= '
            <li>
                <a><span class="label label-danger">Blokada</span><p>Zostałeś Zablokowany</p></a>
            </li>
            ';
            break;
            case 2:
            $output .= '
            <li>
                <a href="'.$not_link.'"><span class="label label-info">Komentarz</span><p>Nowy Komentarz</p></a>
            </li>
            ';
            break;
            case 3:
            $output .= '
            <li>
                <a href="'.$not_link.'"><span class="label label-success">Komentarz</span><p>Nowa Odpowiedź</p></a>
            </li>
            ';   
            break;
            case 4:
            $output .= '
            <li>
                <a><span class="label label-success">Odblokowanie</span><p>Zostałeś Odblokowany</p></a>
            </li>
            ';
            break;
        }
    }
    $output .= '
    <li class="divider"><li>
    <li>
    <a class="notifications_button" id="notification_dropdown_button">Oznacz jako przeczytane</a>
    </li>
    ';
    }else{  // if no new notifications found - explain it
        $output = '<li><a href="#" class="text-bold text-italic">No New Comments</a></li>';
    }

    $data = array(
       'notification' => $output,
       'unseen_notification'  => $count
    );
    echo json_encode($data);      // since the Java Script is expecting a json response we need to encode it
    session_abort();

  }
  // /.Processing Ajax Request
?>
