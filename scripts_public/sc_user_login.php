<?php
require_once "../connections/connection.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT id_users, password_hash, ref_id_roles, active 
    FROM mp_users 
    WHERE username 
    LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        
        mysqli_stmt_bind_param($stmt, 's', $username);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $id_users, $password_hash, $perfil, $active);

            if (mysqli_stmt_fetch($stmt)) {
                if ($active == true){
                    if (password_verify($password, $password_hash)) {
                        // Guardar sessão de utilizador
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["role"] = $perfil;
                        $_SESSION["id_users"] = $id_users;

                        // Feedback de sucesso
                        header("Location: ../login.php?msg=3#login");

                    } else {
                        // Password está errada
                        header("Location: ../login.php?msg=2#login");
                        //echo "Incorrect credentials!";
                        //echo "<a href='../login.php?msg=2#login'>Try again</a>";
                    }
                } else {
                    session_start();
                    session_destroy();
                    header("Location: ../login.php?msg=4#login");
                }    
            } else {
                // Username não existe
                header("Location: ../login.php?msg=2#login");
                //echo "Incorrect credentials!";
                //echo "<a href='../login.php?msg=2#login'>Try again</a>";
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
