<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                   
    $email = $_POST['email'];
    $password = $_POST['password'];

    $successNext = TRUE;
    $jeTamEmail = FALSE;
    $file_name = 'data'. '.json';

    $current_data = file_get_contents("$file_name");
    $array = json_decode($current_data, TRUE);

    foreach ($array as $insecure_val) {
        if($insecure_val['email'] == $email) {
            $jeTamEmail = TRUE;
            if($insecure_val['password'] == $password){
                $successNext = FALSE;
                readfile("loggedindex.php");
                break;
            }
        }
        
    }
    if($jeTamEmail && $successNext){
        echo "spatne heslo";
    }
    
    
    function get_data() {
        $email = $_POST['email'];
        $file_name='data'. '.json';
   
        if(file_exists("$file_name")) { 
            $current_data = file_get_contents("$file_name");
            $array_data = json_decode($current_data, true);
                               
            $extra = array(
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            );
            $array_data[]=$extra;
            return json_encode($array_data);
        }
        else {
            $datae=array();
            $datae[]=array(
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            );
            return json_encode($datae);   
        }
    }
      
    if($successNext && $jeTamEmail == FALSE){
        if(file_put_contents("$file_name", get_data())) {
            echo 'success';
        }                
        else {
            echo 'There is some error';                
        }
    }
    
}
 
?>