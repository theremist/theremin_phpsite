<?php

session_start();
if (isset($_GET["id"]) && ($_GET["id"] != "")) {
    $id_comments = $_GET["id"];

    require_once ("../connections/connection.php"); // We need the function!
    
    $link = new_db_connection(); // Create a new DB connection
    
    $stmt = mysqli_stmt_init($link); /* create a prepared statement */

    $query = "DELETE FROM mp_comments WHERE mp_comments.id_comments = ?";

    if (mysqli_stmt_prepare($stmt, $query)) { 
        
        mysqli_stmt_bind_param($stmt, "i", $id_comments);  /* Bind paramenters */
        
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt); /* execute the prepared statement */
        } else {
            var_dump($_POST);
          header("Location: ../pages_admin/admin_comments.php"); /* Update done */
        }
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    
    mysqli_stmt_close($stmt); // Close statement
                    
    mysqli_close($link); // Close connection
}