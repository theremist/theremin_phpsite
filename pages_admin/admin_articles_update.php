<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta-->
<?php include_once '../helpers/help_admin_meta.php';?>

    <title>THERELABS ADMIN PAGE</title>

<!-- CSS Fonts-->
<?php include_once '../helpers/help_admin_css.php';?>

<!-- Text CKEditor -->
<script src="//cdn.ckeditor.com/4.19.0/basic/ckeditor.js"></script>

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once "../components_admin/cp_navbars_side.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once "../components_admin/cp_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Article edit</h1>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <?php
                            if(isset($_GET["id"])){    
                                $id_articles = $_GET["id"];

                                require_once("../connections/connection.php"); // We need the function!

                                        $link = new_db_connection(); // Create a new DB connection

                                        $stmt = mysqli_stmt_init($link); // create a prepared statement

                                        $query =  "SELECT title, time_stamp_article, images_s_path, images_s_desc, images_lg_path, images_lg_desc, 
                                        desc_s, desc_lg 
                                        FROM mp_article 
                                        WHERE id_articles 
                                        LIKE ? "; // Define the query


                                        if (mysqli_stmt_prepare($stmt, $query)) { // Prepare the statement

                                            mysqli_stmt_bind_param($stmt, "i", $id_articles); // foi acrescentado na query (WHERE id_article LIKE ?) para ir buscar os que são iguais ao id_user

                                            if (mysqli_stmt_execute($stmt)) {
                                    
                                                mysqli_stmt_bind_result($stmt, $title, $time_stamp_article, $images_s_path, $images_s_desc, $images_lg_path, $images_lg_desc, $desc_s, $desc_lg); // Bind variables by type to each parameter

                                                if (!mysqli_stmt_fetch($stmt)) { 
                                                    //echo "não há resultado da query";                                                                
                                                }
                                                // session_start(); tem de ser colocado no inicio do script depois do DOCTYPE senão dá erro                            
                                                $_SESSION["id"] = $id_articles;
                                                $_SESSION["images_lg_path"] = $images_lg_path;
                                                $_SESSION["images_s_path"] = $images_s_path;

                                            }  else {
                                                // Acção de erro
                                                echo "Error:" . mysqli_stmt_error($stmt);
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link); // Errors related with the query
                                        }

                                        mysqli_stmt_close($stmt); // Close statement
                                        
                                        mysqli_close($link); // Close connection
                            }
                            ?>
                            <div class="panel-body">
                                <form role="form" method="post" action="../scripts_admin/sc_articles_update.php"  enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Article id: <?= $id_articles?></label>           
                                    </div>
                                    <div class="form-group">
                                        <label>Criation date: <?= $time_stamp_article?></label>
                                    </div>
                                    <div class="card h-100">
                                    <div class="card-body">
                                    <div class="form-group">
                                        <label>Title (mandatory)</label>
                                        <input class="form-control" name="title" value="<?=htmlspecialchars($title)?>" required>
                                    </div>
                                    <div class="form-group">
                                        <p>Actual small image: <?= htmlspecialchars($images_s_path)?> </p>
                                        <a>Upload small image (max 100kb) </a>
                                        <input type="file" class="btn btn-info" name="images_s_path" id="images_s_path" value="<?= $images_s_path?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Small image description tooltip and tab</label>
                                        <input class="form-control" name="images_s_desc" value="<?=htmlspecialchars($images_s_desc)?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Short article description (mandatory)</label>
                                        <input class="form-control" name="desc_s" value="<?=htmlspecialchars($desc_s)?>" required>
                                    </div>
                                    </div>
                                    </div>
                                    </br>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Article edit detail</h1>
                                    </div>
                                    <div class="card h-100">
                                    <div class="card-body">
                                    <div class="form-group">
                                        <p>Actual large image: <?=htmlspecialchars($images_lg_path)?> </p>
                                        <a>Upload large image (max 500kb) </a>
                                        <input type="file" class="btn btn-info" name="images_lg_path" id="images_lg_path" value="<?= $images_lg_path?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Large image description tooltip and tab</label>
                                        <input class="form-control" name="images_lg_desc" value="<?=htmlspecialchars($images_lg_desc)?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Large article description</label>
                                        <textarea rows="6" class="form-control" name="desc_lg" id="editor1"><?= $desc_lg?></textarea>
                                    </div>
                                    </div>
                                    </div>
                                    </br>
                                    <button type="submit" class="btn btn-info">Submit changes</button>
                                </form>
                                </br>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer-->
        <?php include_once '../components_admin/cp_footer.php';?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- JS-->       
<?php include_once '../helpers/help_admin_js.php';?>

</body>
<script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>

</html>