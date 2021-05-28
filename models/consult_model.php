<?php
class consult_model{
    private $db;
 
    public function __construct(){
        require_once("db/db.php");
        $this->db=Conect::connection();
        $this->db = $this->db['con'];
    }

    public function get_user($user, $pass){
        # Generate query
        $sql = "SELECT id, user FROM tbl_users WHERE user = '$user'";
        $result = mysqli_query($this->db, $sql);
        $data = [];
        while($row = mysqli_fetch_array($result)){
            $data[] = array(
                'id'            =>$row['id'],
                'user'          =>$row['user']
            );
        }

        #Validate if user exist
        if ($data != []) {
            $sql = "SELECT id, user FROM tbl_users WHERE user = '$user' AND password = '$pass'";
            $result = mysqli_query($this->db, $sql);
            $data = [];
            while($row = mysqli_fetch_array($result)){
                $data[] = array(
                    'id'            =>$row['id'],
                    'user'          =>$row['user']
                );
            }

            # Validate if pass is correct
            if ($data != []) {
                $res = array(
                    'state'     => 1,
                    'message'   => 'Consult successfully',
                    'data'      => $data
                );
            } else {
                $res = array(
                    'state'     => 0,
                    'message'   => 'Consult with error',
                    'msg'       => "Password don't coincide"
                );
            }
        } else {
            $res = array(
                'state'     => 0,
                'message'   => 'Consult with error',
                'msg'       => "User does not registered"
            );
        }
        
        # Return result
        return $res;
    }

    public function get_activities($id = '', $id_user){
        # Validate the id and category
        $where  = ($id == '') ? "WHERE id != ''": "WHERE id = '$id'";
        
        # Generate query
        $sql = "SELECT a.* FROM tbl_activities as a $where AND id_user = $id_user";
        $result = mysqli_query($this->db, $sql);
        $data = [];
        while($row = mysqli_fetch_array($result)){
            $data[] = array(
                'id'            => $row['id'],
                'description'   => $row['description'],
                'date_created'  => $row['date_created'],
            );
        }
        
        # Return result
        if (isset($data)) {
            return $data;
        } else { 
            return null; 
        }
    }
    
    public function get_times($id = '', $id_activity){
        # Validate the id and category
        $where  = ($id == '') ? "WHERE id != ''": "WHERE id = '$id'";
        
        # Generate query
        $sql = "SELECT a.* FROM tbl_times as a $where AND id_activity = $id_activity";
        $result = mysqli_query($this->db, $sql);
        $data = [];
        while($row = mysqli_fetch_array($result)){
            $data[] = array(
                'id'    => $row['id'],
                'time'  => $row['time'],
                'date'  => $row['date'],
            );
        }
        
        # Return result
        if (isset($data)) {
            return $data;
        } else { 
            return null; 
        }
    }

    public function get_hours($id_activity){
        # Generate query
        $sql = "SELECT id, SUM(time) as hours FROM tbl_times as a WHERE id_activity = $id_activity";
        $result = mysqli_query($this->db, $sql);
        $data = [];
        while($row = mysqli_fetch_array($result)){
            $data[] = array(
                'id'        => $row['id'],
                'hours'     => $row['hours']
            );
        }
        
        # Return result
        if (isset($data)) {
            return $data;
        } else { 
            return null; 
        }
    }
    
}
?>
