<?php
class update_controller {
    private $db;

    public function __construct(){
        require_once("models/modific_model.php");
        $this->con = new modific_model();
    }

    public function update_activity($post){
        # Define the variable
        $id             = $post['id'];
        $id_user        = $post['id_user'];
        $description    = $post['description'];

        # Call the model
        $data = $this->con->update_activity($id, $description, $id_user);
        
        # Return response
        return $data;
    }


}
?>
