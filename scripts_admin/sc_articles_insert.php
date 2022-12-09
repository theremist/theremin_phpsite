<?php
session_start();
//var_dump($_GET);
var_dump($_POST);
var_dump($_SESSION);

///////////////////////////////////// UPLOAD IMAGENS SMALL //////////////////////////////////////////////////
$target_dir = "../imgs/";
$target_file = $target_dir . basename($_FILES["images_s_path"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["images_s_path"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
//if (file_exists($target_file)) {
//  echo "Sorry, file already exists.";
//  $uploadOk = 0;
//}

// Check file size
if ($_FILES["images_s_path"]["size"] > 100000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["images_s_path"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["images_s_path"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

///////////////////////////////////// UPLOAD IMAGENS LARGE //////////////////////////////////////////////////
$target_dir = "../imgs/";
$target_file = $target_dir . basename($_FILES["images_lg_path"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["images_lg_path"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
//if (file_exists($target_file)) {
//  echo "Sorry, file already exists.";
//  $uploadOk = 0;
//}

// Check file size
if ($_FILES["images_lg_path"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["images_lg_path"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["images_lg_path"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

///////////////////////////////////// BD INSERT //////////////////////////////////////////////////

if (isset($_POST["title"]) && ($_POST["title"] != "") && (isset($_POST["desc_s"]) && ($_POST["desc_s"] != ""))) {
    $title = $_POST["title"];
    $images_s_desc = $_POST["images_s_desc"];
    $images_lg_desc = $_POST["images_lg_desc"];
    $desc_s = $_POST["desc_s"];
    $desc_lg = $_POST["desc_lg"];
    $id_users = $_SESSION["id_users"];
    $images_s_path = $_FILES["images_s_path"]["name"];
    $images_lg_path = $_FILES["images_lg_path"]["name"]; 

    unset($_SESSION['id']);

    require_once ("../connections/connection.php"); // We need the function!
    
    $link = new_db_connection(); // Create a new DB connection
    
    $stmt = mysqli_stmt_init($link); /* create a prepared statement */

    $query = "INSERT INTO mp_article (title, mp_users_id_users, images_s_path, images_s_desc, images_lg_path, images_lg_desc, desc_s, desc_lg) VALUES (?,?,?,?,?,?,?,?)";

    if (mysqli_stmt_prepare($stmt, $query)) { 
        
        mysqli_stmt_bind_param($stmt, "sissssss", $title, $id_users, $images_s_path, $images_s_desc, $images_lg_path, $images_lg_desc, $desc_s, $desc_lg);  /* Bind paramenters */
        
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt); /* execute the prepared statement */
        } else {
          header("Location: ../pages_admin/admin_articles.php"); /* Update done */
        }
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    
    mysqli_stmt_close($stmt); // Close statement
                    
    mysqli_close($link); // Close connection
}