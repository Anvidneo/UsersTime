<?php
    header('Access-Control-Allow-Origin: *');
    $request = array_key_exists('request', $_POST) ? $_POST['request']: '';
    // print_r($_POST);
    switch ($request) {
        # AUTH 
        case 'get_user':
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            
            require_once('controllers/consult_controller.php');
            $con = new consult_controller();
            $data = $con->get_user($user, $pass);
            $res = $data;
            break;

        case 'new_user':
            require_once('controllers/insert_controller.php');
            $con = new insert_controller();
            $data = $con->insert_user($_POST);
            $res = $data;
            break;

        # ACTIVITIES
        case 'new_activity':
            require_once('controllers/insert_controller.php');
            $con = new insert_controller();
            $data = $con->insert_activity($_POST);
            $res = $data;
            break;

        case 'activities':
            require_once('controllers/consult_controller.php');
            $con = new consult_controller();
            $data = $con->consult_activities($_POST);
            $res = $data;
            break;
        
        case 'update_activity':
            require_once('controllers/update_controller.php');
            $con = new update_controller();
            $data = $con->update_activity($_POST);
            $res = $data;
            break;
        
        case 'delete_activity':
            require_once('controllers/delete_controller.php');
            $con = new delete_controller();
            $data = $con->delete_activity($_POST);
            $res = $data;
            break;
        
        # TIMES
        case 'new_time':
            require_once('controllers/insert_controller.php');
            $con = new insert_controller();
            $data = $con->insert_time($_POST);
            $res = $data;
            break;

        case 'times':
            require_once('controllers/consult_controller.php');
            $con = new consult_controller();
            $data = $con->consult_times($_POST);
            $res = $data;
            break;
                
        case 'delete_time':
            require_once('controllers/delete_controller.php');
            $con = new delete_controller();
            $data = $con->delete_time($_POST);
            $res = $data;
            break;

        # DEFAULT
        default:
            require_once('views/index.php');
            $res = '';
            break;

    }
    // ob_end_clean();
    $res = json_encode($res);
    echo $res;
?>
