<?php

$page = "Pemasukan Keuangan";

ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);

include '../sys/config.php';
include '../vendor/autoload.php';
Session::init();
Session::checkSession();
// Session::checkRole("1");



$c = new Config();
$id_user = Session::get('id');
$listService = $c->query2("SELECT * FROM transaksi_masuk WHERE id_user = '$id_user' AND is_delete = 0 ORDER BY tanggal DESC ")->rowObject();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-pemasukan'])) 
{

    // $create = $c->inputTransaksi($_POST);
    $create = $c->inputTransaksImage($_POST);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete-pemasukan']))
{
    $id = $_GET['delete-pemasukan'];
    $create = $c->deleteByWhere('transaksi_masuk', 'id_transaksi', $id, 'pemasukan-keuangan');
    exit();
}


// if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filter'])) 
// {
//     $create = $c->getTotaltransaksiMasuk($_GET);
//     exit();
// }

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit-pemasukan'])) 
{
    $create = $c->editTransaksiImage($_POST);
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
   Session::destroy();
}


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
        	<?php if (!isset($_GET['tambah-pemasukan']) && !isset($_GET['edit-pemasukan']) && !isset($_GET['delete-pemasukan']) ): ?>
	        	<div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0"><?php echo ucwords($page)?></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                    	<a href="?tambah-pemasukan=add" class="btn btn-primary waves-effect waves-light btn-xl">Tambah Pemasukan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-12">
                		<div class="card" style="border:2px solid black">
                			<div class="card-body">
                				<form action="" method="GET">
	                				<div class="row">
	                					<div class="col-4">
	                						<div class="form-group">
		                						<label>Start Date</label>
		                						<input class="form-control" type="date" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : "" ?>">
	                						</div>
	                					</div>	
	                					<div class="col-4">
	                						<div class="form-group">
		                						<label>End Date</label>
		                						<input class="form-control" type="date" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : "" ?>">
	                						</div>
	                					</div>	
	                					<div class="col-4">
	                						<div class="form-group">
		                						<label>Pencarian</label>
		                						<button class="form-control btn btn-primary" name="filter" value="filter">Filter</button>
	                						</div>
	                					</div>
	                				</div>
                				</form>
                                <div class="table">
                                    <table id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                            <tr id="tablehead">
                                                <th>No</th>
                                                <th>Pemasukan Dari</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php $no = 1; foreach ((object)$listService as $key => $value): ?>
                                        		<tr>
                                        			<td><?= $no++ ?></td>
                                        			<td><?= $value->name_pemasukan ?></td>
                                        			<td>Rp. <?= number_format($value->jumlah_pemasukan) ?></td>
                                        			<td><?= $value->tanggal ?></td>
                                        			<td>
                                                        <a  class="btn btn-primary waves-effect waves-light btn-xl" data-toggle="modal" data-target="#modalDetail<?= $value->id_transaksi ?>">Detail</a>
                                        				<a href="?edit-pemasukan=<?= $value->id_transaksi ?>" class="btn btn-primary waves-effect waves-light btn-xl">Edit</a>
                                        				<a href="?delete-pemasukan=<?= $value->id_transaksi ?>" class="btn btn-primary waves-effect waves-light btn-xl">Delete</a>
                                        			</td>
                                        		</tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalDetail<?= $value->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Pemasukan <?= $value->name_pemasukan ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Name Pemasukan</label>
                                                                        <input class="form-control" value="<?= $value->name_pemasukan ?>" type="text" name="" disabled="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Tanggal Pemasukan</label>
                                                                        <input class="form-control" value="<?= $value->tanggal ?>" type="date" name="" disabled="">
                                                                    </div>      
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Total Pemasukan</label>
                                                                        <input class="form-control" value="Rp. <?= number_format($value->jumlah_pemasukan) ?>" type="text" name="" disabled="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Total Pemasukan</label>
                                                                        <textarea class="form-control" disabled="" cols="5" rows="2"><?= $value->ket_pemasukan ?></textarea>
                                                                    </div>      
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <label>Image</label>
                                                                    <img class="img-fluid" src="<?= $value->image != NULL ? '../assets/images/bukti_pemasukan/'.$value->image : "https://balkes.kemenkeu.go.id/assets/shared/images/image-not-found.png" ?>">
                                                                </div>
                                                            </div>
                                                        </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                        	<?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Total Pendapatan Pemasukan</label>
                                        <?php if (isset($_GET['filter'])): ?>
                                        	<?php $ttl_masuk = $c->getTotaltransaksiMasuk($_GET); ?>
                                        <?php else: ?>
                                        	<?php $ttl_masuk = $c->getTotaltransaksiMasuk(""); ?>
                                        <?php endif ?>
                                        <!-- <?php print_r($ttl_masuk); ?> -->
                                        <input type="text" class="form-control border-black" style="font-weight:bold;"  value="Rp. <?= number_format($ttl_masuk->ttl_pemasukan) ?>" disabled="">
                                    </div>
                                </div>
                            </div>
                		</div>
                	</div>
                </div>
        	<?php elseif(isset($_GET['tambah-pemasukan'])): ?>
        		<div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0"><?php echo ucwords($page)?></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                    	<a href="pemasukan-keuangan" class="btn btn-primary waves-effect waves-light btn-xl">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-12">
                		<form action="" method="POST" enctype="multipart/form-data">
	                		<div class="card" style="border: 2px solid black">
	                			<div class="card-body">
	                				<div class="row">
	                					<div class="col-6">
	                						<div class="form-group">
	                							<label>Jumlah Pemasukan</label>
	                							<input class="form-control" type="text" name="jumlah_pemasukan" id="rupiah" placeholder="Rp. 0">
	                						</div>
	                						<div class="form-group">
	                							<label>Tanggal Transaksi</label>
	                							<input class="form-control" type="date" name="tanggal" value="<?= date('Y-m-d') ?>">
	                						</div>
	                					</div>
	                					<div class="col-6">
	                						<div class="form-group">
	                							<label>Name Pemasukan</label>
	                							<input class="form-control" type="text" name="name_pemasukan" placeholder="Beli Baju">
	                						</div>
	                						<div class="form-group">
	                							<label>Jenis Transaksi</label>
	                							<select class="form-control" name="jenis_transaksi">
	                								<option value="transfer">Transfer</option>
	                								<option value="cash">Cash</option>
	                							</select>
	                						</div>
	                					</div>
	                				</div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control" name="gambar_bukti">
                                            </div>
                                        </div>
                                    </div>
	                				<div class="row">
	                					<div class="col-12">
	                						<div class="form-group">
	                							<label>Keterangan Transaksi</label>
	                							<textarea class="form-control" name="ket_transaksi" placeholder="Keterangan Transksi" rows="4" cols="50"></textarea>
	                						</div>
	                						<div class="float-left">
	                							<button class="btn btn-primary waves-effect waves-light btn-xl" name="add-pemasukan" value="add-pemasukan" >Simpan</button>
	                						</div>
	                					</div>
	                				</div>		
	                			</div>
	                		</div>
                		</form>
                	</div>
                </div>
    		<?php elseif(isset($_GET['edit-pemasukan'])): ?>
    		<?php $id = $_GET['edit-pemasukan'] ;$transkasi = $c->getEachTable('transaksi_masuk', 'id_transaksi', $id); ?>
    			<div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0">Edit Transkasi Pemasukan</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                    	<a href="pemasukan-keuangan" class="btn btn-primary waves-effect waves-light btn-xl">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-12">
                		<form action="" method="POST" enctype="multipart/form-data">
	                		<div class="card" style="border: 2px solid black">
	                			<div class="card-body">
	                				<div class="row">
	                					<div class="col-6">
	                						<div class="form-group">
	                							<label>Jumlah Pemasukan</label>
	                							<input type="hidden" name="id_transaksi" value="<?= $transkasi->id_transaksi ?>">
	                							<input class="form-control" type="text" name="jumlah_pemasukan" id="rupiah" value="Rp. <?= number_format($transkasi->jumlah_pemasukan) ?>" placeholder="Rp. 0">
	                						</div>
	                						<div class="form-group">
	                							<label>Tanggal Transaksi</label>
	                							<input class="form-control" type="date" name="tanggal" value="<?= $transkasi->tanggal ?>">
	                						</div>
	                					</div>
	                					<div class="col-6">
	                						<div class="form-group">
	                							<label>Name Pemasukan</label>
	                							<input class="form-control" type="text" name="name_pemasukan" placeholder="Beli Baju" value="<?= $transkasi->name_pemasukan ?>">
	                						</div>
	                						<div class="form-group">
	                							<label>Jenis Transaksi</label>
	                							<select class="form-control" name="jenis_transaksi">
	                								<option <?= $transkasi->jenis_transaksi == 'transfer' ? "selected" : "" ?> value="transfer">Transfer</option>
	                								<option <?= $transkasi->jenis_transaksi == 'cash' ? "selected" : "" ?> value="cash">Cash</option>
	                							</select>
	                						</div>
	                					</div>
	                				</div>
	                				<div class="row">
	                					<div class="col-12">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control" name="gambar_bukti">
	                						</div>
                                            <div class="form-group">
	                							<label>Keterangan Transaksi</label>
	                							<textarea class="form-control" name="ket_transaksi" placeholder="Keterangan Transksi" rows="4" cols="50"><?= $transkasi->ket_pemasukan ?></textarea>
	                						</div>
                                            <div class="form-group">
                                                <img style="height: 100px; width: auto;" class="img-fluid" src="<?= $transkasi->image != NULL ? '../assets/images/bukti_pemasukan/'.$transkasi->image : "https://balkes.kemenkeu.go.id/assets/shared/images/image-not-found.png" ?>">
                                            </div>
                                            <br>
	                						<div class="float-left">
	                							<button class="btn btn-primary waves-effect waves-light btn-xl" name="edit-pemasukan" value="edit-pemasukan" >Update</button>
	                						</div>
	                					</div>
	                				</div>
	                			</div>
	                		</div>
                		</form>
                	</div>
                </div>
    		<?php elseif(isset($_GET['delete-pemasukan'])): ?>

        	<?php endif ?>
        </div>
    </div>
<?php include('../include/footer.php')?>

<script type="text/javascript">
	var rupiah = document.getElementById('rupiah');
	rupiah.addEventListener('keyup', function(e){
		rupiah.value = formatRupiah(this.value, 'Rp. ');
	});
	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
</script>