<?php

if(isset($_GET["id"]) && ($_GET["id"] != "") && ($_SESSION["username"]) ){    
    $id_users = $_GET["id"];

    require_once("connections/connection.php"); // We need the function!

            $link = new_db_connection(); // Create a new DB connection

            $stmt = mysqli_stmt_init($link); // create a prepared statement

            $query = "SELECT date_creation, username, email, avatar
            FROM mp_users 
            WHERE id_users = ? "; // Define the query

            if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                mysqli_stmt_bind_param($stmt, "i", $id_users); // foi acrescentado na query (WHERE id_users LIKE ?) para ir buscar os que são iguais ao id_user

                if (mysqli_stmt_execute($stmt)) {
        
                    mysqli_stmt_bind_result($stmt, $date_creation, $username, $email, $avatar); // Bind variables by type to each parameter

                    if (!mysqli_stmt_fetch($stmt)) { 
                        //echo "não há resultado da query";                                                                
                    };
                    $_SESSION["id"] = $id_users;
                    $_SESSION["avatar"] = $avatar;

                }  else {
                    // Acção de erro
                    echo "Error:" . mysqli_stmt_error($stmt);
                }
            } else {
                echo "Error: " . mysqli_error($link); // Errors related with the query
            }

            mysqli_stmt_close($stmt); // Close statement
            
            mysqli_close($link); // Close connection

?>                

<section id="profile_edit" class="pb-0">
    <div class="container pb-0 pt-5">
        <h2 class="text-center"></h2>
        <div class="row">
            <div class="col-lg-12 mx-auto">

            </div>
            <div class=" col-6 pb-3 mx-auto">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Profile edit</h2>
                        <form id="login-form" class="py-2" role="form" action="scripts_public/sc_profile_update.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label  class="sr-only form-control-label">Username</label>
                                <div class="mx-auto ">
                                    <input type="text" class="form-control" id="username" name="username" value="<?=htmlspecialchars($username)?>">
                                </div>
                            </div>
                            <div class="form-group">
    
                                <label class="sr-only form-control-label">Email address:</label>
                                <div class="mx-auto ">
                                    <input type="text" class="form-control" id="email" name="email" value="<?=htmlspecialchars($email)?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="mx-auto  pb-3 pt-2 text-center">
                                <label  class=""> Avatar image: <?=htmlspecialchars($avatar)?> </label>
                                
                                <input type="file" class="btn btn-outline-secondary " name="avatar" id="avatar" value="<?=htmlspecialchars($avatar)?>">
                                <p class="text-center"> max 200kb</p>
                                </div>
                            </div>  

                            <div class="form-group">
                                <div class="mx-auto col-sm-10 pb-3 pt-2">
                                    <button type="submit" class="btn btn-outline-secondary btn-lg btn-block" >Submit changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>

<?php
} else {
        header("Location: ./");
        //echo "Campos do formulário por preencher";
    }
?>
