<?php
class insert_controller {
    private $db;

    public function __construct(){
        require_once("models/modific_model.php");
        $this->con = new modific_model();
    }

    # Insert new user
    public function insert_user($post){
        # Define the variables
        $user           = $post['user'];
        $pass           = $post['pass'];  
        $date_created   = date("Y-m-d");

        # Call the model
        $param = "'$user', '$pass', '$date_created'";
        $data = $this->con->insert_user($param);
        
        # Return response
        return $data;
    }
    
    # Insert new activity
    public function insert_activity($post){
        # Define the variables
        $id_user        = $post['id'];
        $description    = $post['description'];
        $date_created   = date("Y-m-d");

        # Call the model
        $param = "'$description', '$date_created', $id_user";
        $data = $this->con->insert_activity($param);
        
        # Return response
        return $data;
    }

    # Insert new time
    public function insert_time($post){
        # Define the variables
        $id_activity    = $post['id'];
        $time           = $post['time'];
        $date           = $post['date'];

        # Call the model
        $param = "$time, '$date', $id_activity";
        $data = $this->con->insert_time($param, $id_activity, $time);
        
        # Return response
        return $data;
    }
}
?>
