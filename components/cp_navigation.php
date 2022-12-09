<?php
session_start();

if(!isset($_SESSION["username"])){    
    $msg = "Login";
} else {
    $msg = $_SESSION["username"];
}

if(isset($_SESSION["role"])){
    $id_role = $_SESSION["role"];
    //var_dump($id_role);
        if($id_role == 1){
            $display = 'style="display: block;"';
        }
        if($id_role == 2){
            $display = 'style="display: none;"';
        } 
}
//var_dump($_SESSION);
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Therelabs</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?#articles">Articles</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                <?php if(isset($_SESSION["role"])){?>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" <?=$display?> href="pages_admin/index.php">Admin page</a></li>
                <?php }?>

                    <li class="nav-item dropdown">
                    <?php if(isset($_SESSION["username"])){?>
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><?=$msg?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item"  href="./profile.php">Profile</a>
                            <a class="dropdown-item"  href="scripts/sc_logout.php">Logout</a>
                        </ul>
                        <?php }?>
                    </li>

                    <?php if(!isset($_SESSION["username"])){?>
                        <li class="nav-item"><a class="nav-link" href="login.php"><?=$msg?></a></li>
                    <?php }?>
            </ul>
        </div>
    </div>
</nav>
