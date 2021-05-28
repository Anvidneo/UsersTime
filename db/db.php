<?php
class Conect{
    public static function connection(){
        # Define parameters of conexion
        $namebd= 'db_users_time';
        $userbd = 'root';
        $passbd = '';

        # Generate connection 
        $connection = mysqli_connect("localhost", $userbd, $passbd, $namebd);

        if (isset($connection)) {
            $connection = array(
                'state'     => 1,
                'message'   => 'Connection success',
                'con'       => $connection
            );
        } else {
            $connection = array(
                'state'     => 0,
                'message'   => 'Error in connection to database'
            );  
        }

        # Return connection
        return $connection;
    }
}
?>
