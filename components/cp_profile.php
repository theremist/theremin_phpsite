<?php

    if (isset($_SESSION["id_users"]) && ($_SESSION["id_users"] != "")) {
        
        $id_users = $_SESSION["id_users"];
        
        require_once("connections/connection.php"); // We need the function!

        $link = new_db_connection(); // Create a new DB connection

        $stmt = mysqli_stmt_init($link); // create a prepared statement
        
        $query = "SELECT username, date_creation, email, avatar
        FROM mp_users
        WHERE id_users = ?";
    
        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    
            mysqli_stmt_bind_param($stmt, 'i', $id_users);
    
            mysqli_stmt_execute($stmt); // Execute the prepared statement
    
            mysqli_stmt_bind_result($stmt, $username, $date_creation, $email, $avatar); // Bind results
    
            if (mysqli_stmt_fetch($stmt)){ // Fetch values

            } else {
                echo "Error: " . mysqli_error($link); // Errors related with the query
            }
        } 
        ?>

        <div class="row bg-dark pt-5 m-0">
        <div class="col-3">
        </div>
        
            <div class="col-4 ">
            <h3 class="font-weight-strong title_articles my-4">Profile user</h3>
            <div class="text-white py-3">
                <p>Member since: <?= htmlspecialchars($date_creation)?></p>
                </br>
                <p>Username: <?= htmlspecialchars($username)?></p>
                <p>Email address: <?= htmlspecialchars($email)?></p>
                <ul class="py-4 px-0" >
                <a class="btn comment_button text-uppercase" href="profile_edit.php?id=<?= $id_users?>" id="submitButton" type="submit">Edit profile</a>
                </ul>
                </div>
            </div>
            <div class="col-2 ">
                <img class="mx-auto m-5 rounded-circle img-fluid img-center" src="./imgs_upload/<?= $avatar?>" alt="user avatar" />
            </div>
        <div class="col-3">
        </div>
        </div>
        </div>
        <div class="pb-4 m-0 text-white bg-dark text-center">
                <h4 class="font-weight-strong "> You voted for these articles</h4>
        </div>
        <?php
        $query2 = "SELECT mp_users_has_mp_article.timestamp_vote, mp_article.title, mp_article.id_articles
        FROM mp_article 
        INNER JOIN mp_users_has_mp_article
        ON mp_article.id_articles = mp_users_has_mp_article.mp_article_id_articles
        WHERE mp_users_has_mp_article.mp_users_id_users LIKE ?
        ORDER BY timestamp_vote DESC;";

                    if (mysqli_stmt_prepare($stmt, $query2)) { // Prepare the statement

                        mysqli_stmt_bind_param($stmt, 'i', $id_users);

                        if (mysqli_stmt_execute($stmt)) { // Execute the prepared statement

                            mysqli_stmt_bind_result($stmt, $timestamp_vote, $title, $id_articles); // Bind results
                            //var_dump($id_articles);

                            while (mysqli_stmt_fetch($stmt)) { // Fetch values

                                    echo '<div class="text-white text-justify">';
                                    echo '<div class="row bg-dark pb-4 px-0 mx-0">';
                                    echo '<div class="col-3">';
                                    echo '</div>';
                                    echo '<div class="col-6 pb-0 ">';
                                    echo '<hr>';
                                    echo '<p> '.$timestamp_vote.'</p>';
                                    echo  "<a href='./article_details.php?id=".$id_articles."'>".htmlspecialchars($title)."</a>";
                                    echo '<br>';
                                    echo '</div>';
                                    echo '<div class="col-3">';
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
    } else {
        header("Location: ./");
        //echo "Campos do formulário por preencher";
    }
    //var_dump($_SESSION);

?>
