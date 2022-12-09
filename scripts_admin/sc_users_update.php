<?php

session_start();
if (isset($_POST["username"]) && ($_POST["username"] != "") && (isset($_POST["email"]) && ($_POST["email"] != "") && (isset($_SESSION["id"])))) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    
    $active = 0;
    if(isset($_POST['active'])){
        $active = 1;
    }

    $id_roles = $_POST["id_roles"];
    $id_users = $_SESSION["id"];
    unset($_SESSION['id']);
    
    require_once ("../connections/connection.php"); // We need the function!
    
    $link = new_db_connection(); // Create a new DB connection
    
    $stmt = mysqli_stmt_init($link); /* create a prepared statement */

    $query = "UPDATE mp_users
              SET username = ?, email = ?, active = ?, ref_id_roles = ?
              WHERE id_users = ?";

    if (mysqli_stmt_prepare($stmt, $query)) { 
        
        mysqli_stmt_bind_param($stmt, "ssiii", $username, $email, $active, $id_roles, $id_users);  /* Bind paramenters */
        
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt); /* execute the prepared statement */
        } else {
            var_dump($_POST);
          header("Location: ../pages_admin/admin_users.php"); /* Update done */
        }
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    
    mysqli_stmt_close($stmt); // Close statement
                    
    mysqli_close($link); // Close connection
}