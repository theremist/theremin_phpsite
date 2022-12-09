<?php
// Verificação de credenciais de acesso à área de administração
session_start();

if(isset($_SESSION["role"])){
    $id_role = $_SESSION["role"];
    //var_dump($id_role);
        if($id_role == 1){
           //echo "é admin continua no script";
        }
        if($id_role == 2){
            //echo "é user";
            header("Location: ../");
        } 
} else {
    header("Location: ../");
}
?>

<!-- Sidebar -->

<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">THERELABS ADMIN PAGE</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestão
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="../scripts_admin/sc_check_admin.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>User management</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../pages_admin/admin_articles.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Article management</span></a>
    </li>
    <li class="nav-item">

        <a class="nav-link" href="../pages_admin/admin_comments.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Commments management</span></a>
    </li>
    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
