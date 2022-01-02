<?php

$page = "dashboard";

ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);

include '../sys/config.php';
Session::init();
Session::checkSession();
// Session::checkRole(1,2,3,4);


$c = new Config();


if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
   Session::destroy();
}


?>
<?php include('../include/head.php')?>
    <div class="wrapper">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <h4 class="page-title m-0 text-center">Dashboard Keuangan <?= Session::get('nama') ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card border-black">
                        <div class="card-body">
                            <h2 class="m-b-30 m-t-0">Keuangan</h2>
                            <a href="pemasukan-keuangan"><h4 class="text-dark">1. Pemasukan Keuangan</h4></a>
                            <a href="pengeluaran-keuangan"><h4 class="text-dark">2. Pengeluaran Keuangan</h4></a>
                            <a href="pendapatan"><h4 class="text-dark">3. Pendapatan Keuangan</h4></a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
<?php include('../include/footer.php')?>
