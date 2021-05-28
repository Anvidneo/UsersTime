<?php
class modific_model{
    private $db;
 
    public function __construct(){
        require_once("db/db.php");
        $this->db=Conect::connection();
        $this->db = $this->db['con'];
    }

    # FUNCTIONS TO USERS
    public function insert_user($param){
        # Generate query
        $sql = "INSERT INTO tbl_users (user, password, date_created) VALUES ($param);";
        $result = mysqli_query($this->db, $sql);
        if ($result){
            $data = array(
                'state'     => 1,
                'message'   => 'Insert user successfully'
            );
        } else {
            $data = array(
                'state'     => 0,
                'message'   => 'Insert user error',
                'error'     => "Errormessage: %s\n", $this->db->error
            );
        }
        
        # Return result
        return $data;
    }
    
    # FUNCTIONS TO ACTIVITIES
    public function insert_activity($param){
        # Generate query
        $sql = "INSERT INTO tbl_activities (description, date_created, id_user) VALUES ($param);";
        if (mysqli_query($this->db, $sql)){
            $data = array(
                'state'     => 1,
                'message'   => 'Insert activity successfully'
            );
        } else {
            $data = array(
                'state'     => 0,
                'message'   => 'Insert activity error',
                'error'     => "Errormessage: %s\n", $this->db->error
            );
        }
        
        # Return result
        return $data;
    }

    public function update_activity($id, $description, $id_user){
        # Generate query
        $sql = "UPDATE tbl_activities SET description = '$description', id_user = '$id_user' WHERE id = $id;";
        if (mysqli_query($this->db, $sql)){
            $data = array(
                'state'     => 1,
                'message'   => 'Update activity successfully'
            );
        } else {
            $data = array(
                'state'     => 0,
                'message'   => 'Update activity error',
                'error'     => "Errormessage: %s\n", $this->db->error
            );
        }
        # Return result
        return $data;
    }

    public function delete_activity($id){
        # Generate query
        $sql = "DELETE FROM tbl_activities WHERE id = $id;";
        if (mysqli_query($this->db, $sql)){
            $data = array(
                'state'     => 1,
                'message'   => 'Delete activity successfully'
            );
        } else {
            $data = array(
                'state'     => 0,
                'message'   => 'Delete activity error',
                'error'     => "Errormessage: %s\n", $this->db->error
            );
        }

        # Return result
        return $data;
    }

    # FUNCTIONS TO TIMES
    public function insert_time($param, $id_activity, $new_time){
        $time = 0;

        require_once('controllers/consult_controller.php');
        $con = new consult_controller();
        $time = $con->consult_hours($id_activity);
        $time = $time+$new_time;
        if ($time <= 8) {
            # Generate query
            $sql = "INSERT INTO tbl_times (time, date, id_activity) VALUES ($param);";
            if (mysqli_query($this->db, $sql)){
                $data = array(
                    'state'     => 1,
                    'message'   => 'Insert time successfully'
                );
            } else {
                $data = array(
                    'state'     => 0,
                    'message'   => 'Insert time error',
                    'error'     => "Errormessage: %s\n", $this->db->error
                );
            }
        } else {
            $data = array(
                'state'     => 0,
                'message'   => 'Insert time error, time exceeded',
                'error'     => "Errormessage: %s\n", $this->db->error
            );
        }
        
        # Return result
        return $data;
    }

    public function delete_time($id){
        # Generate query
        $sql = "DELETE FROM tbl_times WHERE id = $id;";
        if (mysqli_query($this->db, $sql)){
            $data = array(
                'state'     => 1,
                'message'   => 'Delete time successfully'
            );
        } else {
            $data = array(
                'state'     => 0,
                'message'   => 'Delete time error',
                'error'     => "Errormessage: %s", $this->db->error
            );
        }

        # Return result
        return $data;
    }

}
?>
