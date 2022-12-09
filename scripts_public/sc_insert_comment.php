<?php
session_start();
//var_dump($_GET);
//var_dump($_POST);
//var_dump($_SESSION);

if (isset($_POST["comments"]) && isset($_SESSION["id_users"]) && isset($_GET["id"]) ) {
  
    $comment_text = $_POST['comments'];
    $mp_users_id_users = $_SESSION["id_users"];
    $mp_article_id_articles = $_GET["id"];
    $id_articles = $_GET["id"];

    //echo "<p>$comment_text -> $mp_users_id_users -> $id_articles</p>";
    require_once("../connections/connection.php"); // We need the function!

    $link = new_db_connection(); // Create a new DB connection

    $stmt = mysqli_stmt_init($link); // create a prepared statement

    $query = "INSERT INTO mp_comments (comment_text, mp_users_id_users, mp_article_id_articles) VALUES (?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        /* Bind paramenters */
        mysqli_stmt_bind_param($stmt, "sii", $comment_text, $mp_users_id_users, $mp_article_id_articles);
        /* execute the prepared statement */
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        } else {
            /* Update done */
            header("Location: ../article_details.php?id=$id_articles#comments");
        }
    } else {
        echo("Error description: " . mysqli_error($link));
    }
                
    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    echo "Campos do formulário por preencher";
}