<?php
//reanudamos la session
@session_start();
    if( $_SESSION['logged_in']<>TRUE){
        header('location: index.php');
        exit;
    }

 ?>