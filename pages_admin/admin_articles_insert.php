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
                    <h1 class="h3 mb-0 text-gray-800">New article</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" method="post" action="../scripts_admin/sc_articles_insert.php"  enctype="multipart/form-data">
                                    <div class="card h-100">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Title (mandatory)</label>
                                            <input class="form-control" name="title" required>
                                        </div>
                                        </br>
                                        <div class="form-group">
                                            <a>Upload small image (max 100kb) </a>
                                            <input type="file" class="btn btn-info" name="images_s_path" id="images_s_path">
                                        </div>
                                        <div class="form-group">
                                            <label>Small image description tooltip and tab</label>
                                            <input class="form-control" name="images_s_desc">
                                        </div>
                                        <div class="form-group">
                                            <label>Short article description (mandatory)</label>
                                            <input class="form-control" name="desc_s" required>
                                        </div>
                                        </div>
                                        </div>
                                        </br>
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">New article detail</h1>
                                        </div>
                                        <div class="card h-100">
                                        <div class="card-body">
                                        <div class="form-group">
                                            <a>Upload large image (max 500kb) </a>
                                            <input type="file" class="btn btn-info" name="images_lg_path" id="images_lg_path" >
                                        </div>
                                        <div class="form-group">
                                            <label>Large image description tooltip and tab</label>
                                            <input class="form-control" name="images_lg_desc" >
                                        </div>
                                        <div class="form-group">
                                            <label>Large article description</label>
                                            <textarea rows="6" class="form-control" name="desc_lg" id="editor1"></textarea>
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