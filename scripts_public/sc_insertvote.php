<?php
session_start();
//var_dump($_GET);
//var_dump($_POST);
//var_dump($_SESSION);

if (isset($_POST["vote"]) && isset($_SESSION["id_users"]) && isset($_GET["id"]) ) {
  
    $vote = $_POST['vote'];
    $id_users = $_SESSION["id_users"];
    $id_articles = $_GET["id"];

    //echo "<p> $id_users -> $id_articles</p>";
    require_once("../connections/connection.php"); // We need the function!

    $link = new_db_connection(); // Create a new DB connection

    $stmt = mysqli_stmt_init($link); // create a prepared statement 

    $query_verify_vote = "SELECT mp_users_id_users, mp_article_id_articles 
    FROM mp_users_has_mp_article 
    WHERE mp_users_id_users = ? AND mp_article_id_articles = ?";
     
    if (mysqli_stmt_prepare($stmt, $query_verify_vote)) { // Prepare the statement

        mysqli_stmt_bind_param($stmt, 'ii', $id_users, $id_articles );

        mysqli_stmt_execute($stmt); // Execute the prepared statement

        mysqli_stmt_bind_result($stmt, $mp_users_id_users_v, $mp_article_id_articles_v ); // Bind results
        
        if (mysqli_stmt_fetch($stmt)){ // Fetch values

            // implemetar um aviso tipo modal
            //echo 'este user já colocou like';
            header("Location: ../article_details.php?id=$id_articles#loginarea");
            } else {
                //echo "vai inserir na BD";
                $query_insert_vote = "INSERT INTO mp_users_has_mp_article (mp_users_id_users, mp_article_id_articles) VALUES (?,?)";

                if (mysqli_stmt_prepare($stmt, $query_insert_vote)) {
                    /* Bind paramenters */
                    mysqli_stmt_bind_param($stmt, "ii", $id_users, $id_articles);
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error:" . mysqli_stmt_error($stmt);
                    } else {
                        /* Update done */
                        header("Location: ../article_details.php?id=$id_articles");
                    }
                } else {
                    echo("Error description: " . mysqli_error($link));
                }
            }

    } else {
        echo "Error: " . mysqli_error($link); // Errors related with the query
    }
        
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    header("Location: ../login.php?msg=5#login");
    //echo "É necessario Autenticar";
}