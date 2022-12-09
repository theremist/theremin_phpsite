<div class="row bg-black m-0 py-5" id="articles">
        <div class=" text-white text-justify">
        <h1 class="font-weight-strong text-center">Theremin articles and curiosities</h1>
            <?php
                require_once("connections/connection.php"); // We need the function!

                $link = new_db_connection(); // Create a new DB connection

                $stmt = mysqli_stmt_init($link); // create a prepared statement

                $query = "SELECT mp_article.id_articles, mp_article.title, mp_article.images_s_path, mp_article.images_s_desc, mp_article.desc_s, mp_article.time_stamp_article, 
                COUNT(mp_comments.id_comments)count_comm
                FROM mp_article
                LEFT JOIN mp_comments ON mp_article.id_articles = mp_comments.mp_article_id_articles
                GROUP BY id_articles
                ORDER BY mp_article.title;"; 

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement
                    mysqli_stmt_execute($stmt); // Execute the prepared statement

                    mysqli_stmt_bind_result($stmt, $id_articles, $title, $images_s_path, $images_s_desc, $desc_s, $time_stamp_article, $count_comm); // Bind results

                    while (mysqli_stmt_fetch($stmt)) { // Fetch values
                        // echo "<p>$id -> $title -> $name -> $description_short</p>";
                        echo '<div class="row py-5 px-0 mx-0">';
                        echo '<div class="col-2">'; 
                        echo '</div>';
                        echo '<div class="col-1 my-auto">';
                        echo '<img src="./imgs/'.htmlspecialchars($images_s_path).'" class="img-fluid w-auto mx-auto mx-0 " data-toggle="tooltip" title="'.htmlspecialchars($images_s_desc).'" alt="'.htmlspecialchars($images_s_desc).'">';
                        echo '</div>';
                        echo '<div class="col-7 my-auto">';
                        echo '<div class="text-white text-justify px-0">';
                        echo '<a href="article_details.php?id='.$id_articles.'">';
                        echo '<h3 class="font-weight-strong title_articles my-4">'.htmlspecialchars($title).'</h3>';
                        echo '</a>';
                        echo '<p>'.htmlspecialchars($desc_s).'</p>';
                        echo '<p>Comments: '.$count_comm.'</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-2">';
                        echo '</div>';
                        echo '</div>';
                    }
                    mysqli_stmt_close($stmt); // Close statement
                } else {
                    echo "Error: " . mysqli_error($link); // Errors related with the query
                }
                mysqli_close($link); // Close connection
            ?>
        </div>
</div>