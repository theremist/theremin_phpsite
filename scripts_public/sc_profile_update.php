<?php
session_start();
//var_dump($_FILES["avatar"]["name"]);
//var_dump($_SESSION);
var_dump($_POST);

///////////////////////////////////// UPLOAD IMAGENS AVATAR //////////////////////////////////////////////////

    $target_dir = "../imgs_upload/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["avatar"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["avatar"]["size"] > 200000) {
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
      if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }


///////////////////////////////////// BD UPDATE //////////////////////////////////////////////////

if (isset($_POST["username"]) && ($_POST["username"] != "") && (isset($_POST["email"]) && ($_POST["email"] != "") && (isset($_SESSION["id"])))) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $id_users = $_SESSION["id"];

    // quando a variavel esta vazia mantem a da sessão 
    if($_FILES["avatar"]["name"] == ""){
      $avatar = $_SESSION["avatar"];
    } else {
      $avatar = $_FILES["avatar"]["name"]; 
    }
    
    require_once ("../connections/connection.php"); // We need the function!
    
    $link = new_db_connection(); // Create a new DB connection
    
    $stmt = mysqli_stmt_init($link); /* create a prepared statement */

    $query = "UPDATE mp_users
              SET username = ?, email = ?, avatar = ?
              WHERE id_users = ?";

    if (mysqli_stmt_prepare($stmt, $query)) { 
        
        mysqli_stmt_bind_param($stmt, "sssi", $username, $email, $avatar, $id_users);  /* Bind paramenters */
        
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt); /* execute the prepared statement */
        } else {
          header("Location: ../scripts/sc_signin.php"); /* Update done */
        }
    } else {
        echo("Error description: " . mysqli_error($link));
    }
    
    mysqli_stmt_close($stmt); // Close statement
                    
    mysqli_close($link); // Close connection

    var_dump($_GET);
var_dump($_SESSION);

}
?>