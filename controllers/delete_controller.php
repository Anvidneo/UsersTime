<?php
class delete_controller {
    private $db;

    public function __construct(){
        require_once("models/modific_model.php");
        $this->con = new modific_model();
    }

    public function delete_activity($post){
        # Define the variable
        $id = $post['id'];

        # Call the model
        $data = $this->con->delete_activity($id);
        
        # Return response
        return $data;
    }

    public function delete_time($post){
        # Define the variable
        $id = $post['id'];

        # Call the model
        $data = $this->con->delete_time($id);
        
        # Return response
        return $data;
    }

}
?>
