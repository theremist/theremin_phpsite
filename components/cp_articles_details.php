<div class="row bg-black m-0 pt-5 pb-0" id="articles">
        <div class="text-white text-justify pt-5 pb-0">
        <h1 class="font-weight-strong text-center">Theremin article details</h1>
            <?php
  
                if (isset($_GET["id"])) {
                    $id_articles = $_GET["id"];

                    require_once("connections/connection.php"); // We need the function!
    
                        $link = new_db_connection(); // Create a new DB connection
    
                        $stmt = mysqli_stmt_init($link); // create a prepared statement

                        // contador de votos por artigo
                        $query_count_vote = "SELECT COUNT(*) countvote
                        FROM mp_users_has_mp_article 
                        WHERE mp_article_id_articles = ?";
                    
                        if (mysqli_stmt_prepare($stmt, $query_count_vote)) { // Prepare the statement
                    
                            mysqli_stmt_bind_param($stmt, 'i', $id_articles);
                    
                            mysqli_stmt_execute($stmt); // Execute the prepared statement
                    
                            mysqli_stmt_bind_result($stmt, $countvote); // Bind results
                    
                            if (mysqli_stmt_fetch($stmt)){ // Fetch values
                    
                                //echo 'conta e retorna valor '.$countvote.' ';
                            } else {
                                echo "Error: " . mysqli_error($link); // Errors related with the query
                            }
                        }

                        $query = "SELECT title, images_lg_path, images_lg_desc, desc_lg, desc_s, time_stamp_article 
                        FROM mp_article 
                        WHERE id_articles = ?"; // Define the query
     
                        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
    
                            mysqli_stmt_bind_param($stmt, 'i', $id_articles); // Bind variables by type to each parameter
    
                            mysqli_stmt_execute($stmt); // Execute the prepared statement
    
                            mysqli_stmt_bind_result($stmt, $title, $images_lg_path, $images_lg_desc, $desc_lg, $desc_s, $time_stamp_article); // Bind results
    
                            mysqli_stmt_fetch($stmt); // Fetch values

                            echo '<div class="row py-5 px-0 mx-0">';
                            echo '<div class="col-2">';
                            echo '</div>';
                            echo '<div class="col-4 my-auto">';
                            echo '<div class="text-white text-justify px-0">';
                            echo '<h3 class="font-weight-strong title_articles my-4">'.htmlspecialchars($title).'</h3>';
                            echo '<p>Publish date: '.$time_stamp_article.'</p>';
                            echo '</div>';
                            echo '<div class="pt-5">';
                            echo '<img src="./imgs/'.htmlspecialchars($images_lg_path).'" class="img-fluid w-auto mx-auto mx-0 " data-toggle="tooltip" title="'.htmlspecialchars($images_lg_desc).'" alt="'.htmlspecialchars($images_lg_desc).'">';
                            echo '</div>';
                            echo '<div class="pt-4">';
                            echo '<form action="scripts_public/sc_insertvote.php?id='.$id_articles.'" method="post">';
                            echo '<div class="input-group mx-0 mb-2">';
                            echo '<button type="submit" name="vote" value="1" class="btn comment_button text-white">';
                            echo '<span class="fa-solid fa-thumbs-up"></span>';
                            echo '</button>';
                            echo '<a class="ml-4 my-auto"><span >'.$countvote.'</span>- people liked this article</a>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-4 my-auto">';
                            // este campo é inserido através do CKEditor
                            echo '<p>'.$desc_lg.'</p>';
                            echo '</div>';                            
                            echo '<div class="col-2">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            
                        } else {
                            echo "Error: " . mysqli_error($link); // Errors related with the query
                        }

                        mysqli_stmt_close($stmt); // Close statement
                        mysqli_close($link); // Close connection

                    } else {
                        echo "Campos do formulário por preencher";
                    }
            ?>
    </div>
</div>