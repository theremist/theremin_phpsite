<div class=" bg-black m-0 pt-5 pb-0" >
        <div class="text-white text-justify pt-5 pb-0">
<?php

if (isset($_GET["id"]) && ($_GET["id"] != "" )) {
    $username = $_GET["id"];

    echo '<div>';
    echo '<h1 class="font-weight-strong text-center py-5">'.$username.' comment summary</h1>';
    echo '</div>';

    require_once("connections/connection.php"); // We need the function!

        $link = new_db_connection(); // Create a new DB connection

        $stmt = mysqli_stmt_init($link); // create a prepared statement

        $query = "SELECT comment_text, time_stamp_comments, username
        FROM mp_comments 
        INNER JOIN mp_users
        ON mp_comments.mp_users_id_users = mp_users.id_users
        WHERE mp_users.username = ?
        ORDER BY mp_comments.time_stamp_comments DESC";


if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

    mysqli_stmt_bind_param($stmt, 's', $username);

    if (mysqli_stmt_execute($stmt)) { // Execute the prepared statement

        mysqli_stmt_bind_result($stmt, $comment_text, $time_stamp_comments, $username); // Bind results

        while (mysqli_stmt_fetch($stmt)) { // Fetch values

            echo '<div class="text-white text-justify">';
            echo '<div class="row bg-dark py-2 px-0 mx-0">';
            echo '<div class="col-2">';
            echo '</div>';
            echo '<div class="col-2 p-0 ">';
            echo '<hr>';
            echo '<a><strong>'.htmlspecialchars($username).'</strong><small> wrote: </small></a>';
            echo '<br>';
            echo '<a>'.$time_stamp_comments.'</a>';
            echo '<br>';
            echo '</div>';
            echo '<div class="col-6 p-0 ">';
            echo '<hr>';
            echo '<p>'.htmlspecialchars($comment_text).'</p>';
            echo '</div>';
            echo '<div class="col-2">';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_stmt_error($stmt);
    }
} else {
    // Acção de erro
    echo "Error:" . mysqli_error($link);
}

mysqli_stmt_close($stmt);
mysqli_close($link);
    
}
?>
</div>
</div>