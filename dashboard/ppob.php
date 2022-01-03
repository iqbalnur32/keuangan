<?php

$page = "Transaksi PPOB";

ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);

include '../sys/config.php';
include '../vendor/autoload.php';
Session::init();
Session::checkSession();
// Session::checkRole("1");
$c = new Config();
$id_user = Session::get('id');
?>
<style>
#tablehead th{
    border: 1px solid black;
}
#tablebody td {
    border: 1px solid black;
}
</style>
<?php include('../include/head.php')?>
    <div class="wrapper">
    	<div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="page-title m-0"><?php echo ucwords($page)?></h4>
                            </div>
                           <!--  <div class="col-md-4">
                                <div class="float-right">
                                    <a href="?add-tabungan=add" class="btn btn-primary waves-effect waves-light btn-xl">Tambah Tabungan</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" style="border:2px solid black">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <button class="ppob_icons" id="pulsa" style="background-color: white; border: 0px;" value="pulsa"><img style="height: 80px; width: 80px;" src="../assets/icons/pulsa-ppob.png"></button>
                                </div>
                                <div class="col-3">
                                    <button class="ppob_icons" id="data" style="background-color: white; border: 0px;" value="data"><img style="height: 80px; width: 80px;" src="../assets/icons/data-ppob.png"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('../include/footer.php')?>

<script type="text/javascript">
    const url = "https://api-live.hobikoe.com/";
    // const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYXBpLWxpdmUuaG9iaWtvZS5jb21cL1wvYXBpXC9hdXRoXC9lbWFpbCIsImlhdCI6MTY0MTA0NTM1OSwiZXhwIjoxNjQxNjUwMTU5LCJuYmYiOjE2NDEwNDUzNTksImp0aSI6IlY5b0xpV3FyN0ZLTzZ1UkMiLCJzdWIiOjM4NSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.cioKv0i3x8fHAEte1Di62yYKJO27AOX3CzTHvHEPdu8";
    $(document).ready(function() {
        /*Click PPOB */
        // $.ajax({
        //     'url': url + 'api/private/ppob/list',
        //     "method": 'GET',
        //     "async": true,
        //     "headers": {
        //         "Content-Type": "application/json",
        //         "Authorization": "Bearer " + token,
        //         "Accept": "*/*",
        //         "Access-Control-Allow-Headers": "*",
        //         "Host": "api-live.hobikoe.com"
        //     },
        //     success: (result) => {
        //         console.log(result);
        //     },
        //     error: (err) => {
        //         console.log(err);
        //     }

        // })
    })
</script>
