<?php
class consult_controller {
    private $db;

    public function __construct(){
        require_once("models/consult_model.php");
        $this->con = new consult_model();
    }

    public function get_user($user, $pass){
        # Call the model
        $res = $this->con->get_user($user, $pass);

        # Return response
        return $res;
    }

    public function consult_activities($post){
        # Define the variable
        $id         = $post['id'];
        $id_user    = $post['id_user'];

        # Call the model
        $data = $this->con->get_activities($id, $id_user);

        # Test the data
        if ($data === false || $data === null){
            $res = array(
                'state'     => 0,
                'message'   => 'Consult with error'
            );
        } else {
            $res = array(
                'state'     => 1,
                'message'   => 'Consult successfully',
                'data'      => $data
            );
        }
        
        # Return response
        return $res;
    }

    public function consult_times($post){
        # Define the variable
        $id             = $post['id'];
        $id_activity    = $post['id_activity'];

        # Call the model
        $data = $this->con->get_times($id, $id_activity);

        # Test the data
        if ($data === false || $data === null){
            $res = array(
                'state'     => 0,
                'message'   => 'Consult with error'
            );
        } else {
            $res = array(
                'state'     => 1,
                'message'   => 'Consult successfully',
                'data'      => $data
            );
        }
        
        # Return response
        return $res;
    }

    public function consult_hours($id_activity){
        $hours = 0;
        # Call the model
        $data = $this->con->get_hours($id_activity);
        
        # Test the data
        if ($data != false || $data != null){
            $hours = $data[0]['hours'];
        }
        
        # Return response
        return $hours;
    }
}
?>
