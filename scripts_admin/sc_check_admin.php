<?php
session_start();

if(isset($_SESSION["role"])){
    $id_role = $_SESSION["role"];
    //var_dump($id_role);
        if($id_role == 1){
           //echo "é admin";
           header("Location: ../pages_admin/admin_users.php");
        }
        if($id_role == 2){
            //echo "é user";
            header("Location: ../");
        } 
} else {
    header("Location: ../");
}
?>