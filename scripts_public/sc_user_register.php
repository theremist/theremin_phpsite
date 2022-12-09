<?php


if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    require_once "../connections/connection.php";

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);
    // Antes de inserir deve fazer-se uma consulta à BD para verificar se o username ou email já existe na BD 
    //var_dump($_POST); 

    $query1 = "SELECT username FROM mp_users WHERE username LIKE ?";
    
        if (mysqli_stmt_prepare($stmt, $query1)) { // Prepare the statement
            mysqli_stmt_bind_param($stmt, 's', $username);

            mysqli_stmt_execute($stmt); // Execute the prepared statement

            mysqli_stmt_bind_result($stmt, $username_v); // Bind results

            if (mysqli_stmt_fetch($stmt)) {// Fetch values
                //   echo "user já existente";
                 header("Location: ../login.php?msg=0#login"); // msg "ocorreu um erro no registo"
                } else {

            $query2 = "INSERT INTO mp_users (username, email, password_hash) VALUES (?,?,?)"; 
            if (mysqli_stmt_prepare($stmt, $query2)) {
                mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password_hash);
    
                // Devemos validar também o resultado do execute!
                if (mysqli_stmt_execute($stmt)) {
                    // Acção de sucesso
                    header("Location: ../login.php?msg=1#login");
                    
                } else {
                    // Acção de erro
                    header("Location: ../login.php?msg=0#login");
                    //echo "Error:" . mysqli_stmt_error($stmt);
                }
            } else {
                // Acção de erro
                echo "Erro na query select " . mysqli_error($link); // Errors related with the query
            }
            }
                
        } else {
            echo "Erro na query1 select " . mysqli_error($link); // Errors related with the query
        }
        
    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    echo "Campos do formulário por preencher";
}