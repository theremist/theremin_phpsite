
<?php if(!isset($_SESSION["role"])){
    $display = 'style="display: block;"';
    } else {
    $display = 'style="display: none;"';}?>

<div class=" row bg-black m-0 py-1 ">
<div class="col-12 text-center ">
    <ul class="py-4" <?= $display?> >
    <a class="btn comment_button text-uppercase" href="login.php" id="submitButton" type="submit">Register to post a comment</a>
    </ul>
</div>
</div>

<?php if(isset($_SESSION["username"]))
{
    $username= ($_SESSION["username"])?>
    <div class="row bg-dark pt-3 m-0">
        <div class="col-2">
        </div>
            <div class="col-8 ">
            <h5 class="font-weight-bold title_articles my-4">Hello <?= $username?></h5>
                <form id="comments" class="py-2" role="form" action="scripts_public/sc_insert_comment.php?id=<?= $id_articles?>" method="post">
                <div class="input-group my-2">
                    <div class="input-group-prepend col-12 px-0">
                        <div class="input-group-text">
                            <span class="fas fa-edit solid fa-xl"></span>
                        </div>
                        <textarea rows="3" class="form-control text-dark" placeholder="Post your comments" name="comments" required></textarea>
                    </div>
                </div>
                <div class="input-group mx-0 mt-4">
                    <button type="submit" class="btn comment_button font-weight-bold" >
                                <a class="mx-2">Post</a>
                    </button>
                </div>
                </form>
            </div>
        <div class="col-2">
        </div>
    </div>
<?php }?>

<div class="p-2 m-0 text-white bg-dark ">
    <h3 class="font-weight-strong text-center ">Comments</h3>
</div>
        <?php
            //var_dump($_SESSION);
            //var_dump($_GET);
            //$page_first_result = 1;

            // referencia biografica https://www.javatpoint.com/php-pagination
            $results_per_page = 5;

            if (isset($_GET["id"])) {
                
                $id_articles = $_GET["id"];
                
                require_once("connections/connection.php"); // We need the function!

                $link = new_db_connection(); // Create a new DB connection

                $stmt = mysqli_stmt_init($link); // create a prepared statement

                //define total number of comments in this article
                $query = "SELECT COUNT( id_comments )number_of_result 
                FROM mp_comments
                JOIN mp_article
                ON mp_article_id_articles = id_articles
                WHERE id_articles = ?";

                if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                    mysqli_stmt_bind_param($stmt, "i", $id_articles);
                    
                    if(mysqli_stmt_execute($stmt)) { // Execute the prepared statement

                    mysqli_stmt_bind_result($stmt, $number_of_result); // Bind results

                    mysqli_stmt_fetch($stmt);// Fetch values
                        
                        //echo '<p>total likes: '.$comments_total.'</p>';
                    }  else {
                        // Acção de erro
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "Error: " . mysqli_error($link); // Errors related with the query
                }

                //determine the total number of pages available  
                $number_of_page = ceil ($number_of_result / $results_per_page);  
            
                //determine which page number visitor is currently on  
                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                }
            
                //determine the sql LIMIT starting number for the results on the displaying page  
                $page_first_result = ($page-1) * $results_per_page;  
                
                ////////////////////////////////////////////////////
                $query = "SELECT mp_comments.comment_text, mp_comments.time_stamp_comments, mp_comments.mp_article_id_articles, mp_users.username
                FROM mp_comments 
                JOIN mp_users
                ON mp_comments.mp_users_id_users = mp_users.id_users
                WHERE mp_comments.mp_article_id_articles LIKE ?
                ORDER BY mp_comments.time_stamp_comments DESC
                LIMIT " . $page_first_result . ',' . $results_per_page; 
                            
                            // preciso de achar o mp_users_id_users
                            // unicamente para teste WHERE mp_comments.mp_article_id_articles LIKE '".$_GET["id"]."'

                            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                mysqli_stmt_bind_param($stmt, 'i', $id_articles);

                                if (mysqli_stmt_execute($stmt)) { // Execute the prepared statement

                                    mysqli_stmt_bind_result($stmt, $comment_text, $time_stamp_comments, $id_articles, $username); // Bind results
                                    //var_dump($id_articles);

                                    while (mysqli_stmt_fetch($stmt)) { // Fetch values

                                            echo '<div id="comments">';
                                            echo '</div>';
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
                                            echo '<a href="user_comments.php?id=' . $username . '"><small>View other comments from this user</small></a>';
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
            } else {
                echo "Campos do formulário por preencher";
            }
            //var_dump($_SESSION);

            echo "<div class='text-center bg-dark pb-3'>";
            //display the link of the pages in URL  
            for($page = 1; $page<= $number_of_page; $page++) {    
            echo '<a class="btn comment_button text-uppercase text-center " href = "article_details.php?id='.$id_articles.'&page=' . $page . '#comments"> ' . $page . ' </a><a> _</a>';
            }
            echo "</div>";
?>
