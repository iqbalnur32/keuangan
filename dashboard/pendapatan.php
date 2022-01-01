<?php

$page = "Pemasukan Keuangan";

ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);

include '../sys/config.php';
include '../vendor/autoload.php';
Session::init();
Session::checkSession();
// Session::checkRole("1");

$labels = [
  "Januari",
  "Februari",
  "Maret",
  "April",
  "Mei",
  "Juni",
  "Juli",
  "Agustus",
  "September",
  "Oktober",
  "November",
  "Desember"
];

$c = new Config();
$id_user = Session::get('id');
/* Pendapatan */
$ttl_pemasukan = array();
for ($bulan=1; $bulan < 13; $bulan++) {
  $grafik_dc = $c->query(" SELECT sum(jumlah_pemasukan) as ttl_pemasukan FROM transaksi_masuk WHERE MONTH(tanggal) = '$bulan' AND id_user = '$id_user' AND is_delete = 0 ");
  $ttl_pemasukan[] = !empty($grafik_dc[0]['ttl_pemasukan']) ? $grafik_dc[0]['ttl_pemasukan'] : 0;
}

/* Pengeluaran */
$ttl_pengeluaran = array();
for ($bulan=1; $bulan < 13; $bulan++) {
  $grafik_dc = $c->query(" SELECT sum(total) as ttl_pengeluaran FROM pengeluaran WHERE MONTH(tanggal) = '$bulan' AND id_user = '$id_user' AND is_delete = 0 ");
  $ttl_pengeluaran[] = !empty($grafik_dc[0]['ttl_pengeluaran']) ? $grafik_dc[0]['ttl_pengeluaran'] : 0;
}
 
/* Laba Bersih */
$ttl_laba_bersih = array();
for ($bulan=1; $bulan < 13; $bulan++) {
  $pemasukan = $c->query(" SELECT sum(jumlah_pemasukan) as ttl_pemasukan FROM transaksi_masuk WHERE MONTH(tanggal) = '$bulan' AND id_user = '$id_user' AND is_delete = 0 ");
  $pengeluaran = $c->query(" SELECT sum(total) as ttl_pengeluaran FROM pengeluaran WHERE MONTH(tanggal) = '$bulan' AND id_user = '$id_user' AND is_delete = 0 ");
  $pemasukan_all = !empty($pemasukan[0]['ttl_pemasukan']) ? $pemasukan[0]['ttl_pemasukan'] : 0;
  $pengeluaran_all = !empty($pengeluaran[0]['ttl_pengeluaran']) ? $pengeluaran[0]['ttl_pengeluaran'] : 0;
  $ttl_laba_bersih[] = $pemasukan_all - $pengeluaran_all;
}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}
function random_color() {
    return '#'.random_color_part() . random_color_part() . random_color_part();
}
$labels_category_pengeluaran =  $c->query("SELECT * FROM category_pengeluaran");
$tampung_label_category_pengeluaran = array();
$no =1;
foreach ($labels_category_pengeluaran as $key) {
    $id_category = $key['id_category_pengeluaran'];
    $pengeluaran = $c->query2("SELECT * FROM pengeluaran WHERE id_category_pengeluaran = '$id_category' AND id_user = '$id_user' ")->rowObject();
    $pengeluaran_cok = !empty($pengeluaran) ? count($pengeluaran) : 0;
    $donut_data_cok[] = round($pengeluaran_cok / count($labels_category_pengeluaran) * 100);
    $category_cok[] = !empty($key['nama_category']) ? $key['nama_category'] : 0;
    $color_donut[] = random_color();
    // $pengeluaran_cok[] = !empty($pengeluaran) ? count($pengeluaran) : 0;
    // $tampung_label_category_pengeluaran[] = $key['nama_category'];
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
                                <div class="row">
                                    <div class="col-4">
                                        <div class="card" style="background-color: #ef5c6a !important;">
                                            <div class="card-header">
                                                <h3 class="text-center" style="color: white">Pemasukan All</h3>
                                                <h3 class="text-center" style="color: white">Rp. <?php echo number_format(array_sum($ttl_pemasukan)) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                         <div class="card" style="background-color: #ef5c6a !important;">
                                            <div class="card-header">
                                                <h3 class="text-center" style="color: white">Pengeluaran All</h3>
                                                <h3 class="text-center" style="color: white">Rp. <?php echo number_format(array_sum($ttl_pengeluaran)) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card" style="background-color: #ef5c6a !important;">
                                            <div class="card-header">
                                                <h3 class="text-center" style="color: white">Laba Bersih</h3>
                                                <h3 class="text-center" style="color: white">Rp. <?php echo number_format(array_sum($ttl_pemasukan) - array_sum($ttl_pengeluaran)) ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                          <div class="card-body">
                                                <canvas id="chartPendapatanPerbulan"></canvas>  
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                          <div class="card-body">
                                                <canvas id="chartPengeluaranPerbulan"></canvas>  
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="card">
                                          <div class="card-body">
                                                <canvas id="chartLabaBersih"></canvas>  
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card">
                                          <div class="card-body">
                                            <p style="text-align: center" >Category Pengeluaran Terbanyak</p>
                                            <div class="chart-container" style="width: 300px; height:281px; text-align: center">
                                                <canvas id="chartDonut"></canvas>  
                                            </div>
                                          </div>
                                        </div>
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
                		<form action="" method="POST">
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
	                							<input class="form-control" type="date" name="tanggal">
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
                		<form action="" method="POST">
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
	                							<label>Keterangan Transaksi</label>
	                							<textarea class="form-control" name="ket_transaksi" placeholder="Keterangan Transksi" rows="4" cols="50"><?= $transkasi->ket_pemasukan ?></textarea>
	                						</div>
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
    Chart.register(ChartDataLabels);
	$(document).ready(function() {
      
      var label_perbulan = <?= json_encode($labels) ?>;
      var label_category = <?= json_encode($category_cok); ?>;
      var data_pemasukan = <?= json_encode($ttl_pemasukan); ?>;
      var data_pengeluaran = <?= json_encode($ttl_pengeluaran); ?>;
      var data_laba_bersih = <?= json_encode($ttl_laba_bersih); ?>;
      var data_donut = <?= json_encode($donut_data_cok); ?>;
      var color = <?= json_encode($color_donut) ?>;
      // console.log(data_donut)
      function getChartPerbulan(data_pemasukan, label_perbulan)
      {
        const data = {
            labels: label_perbulan,
            datasets: [{
              label: 'Data Pendapatan Masuk',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              // data: [1,2,3,4,5,6,7,8,9,10,11,12],
              data: data_pemasukan,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                  datalabels: {
                    color: 'black',
                    formatter: (val, ctx) => {
                      return `Rp. ${val.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")}`
                    }
                  },
                },
            }
        };

        const myChart = new Chart(
            document.getElementById('chartPendapatanPerbulan'),
            config
        );
      }
      getChartPerbulan(data_pemasukan, label_perbulan)

      function getChartPerbulanPengeluaran(data_pengeluaran, label_perbulan)
      {
        const data = {
            labels: label_perbulan,
            datasets: [{
              label: 'Data Pengeluaran',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              // data: [1,2,3,4,5,6,7,8,9,10,11,12],
              data: data_pengeluaran,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                  datalabels: {
                    color: 'black',
                    formatter: (val, ctx) => {
                      return `Rp. ${val.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")}`
                    }
                  },
                },
            }
        };

        const myChart = new Chart(
            document.getElementById('chartPengeluaranPerbulan'),
            config
        );
      }
      getChartPerbulanPengeluaran(data_pengeluaran, label_perbulan)

      function getChartLabaBersih(data_laba_bersih, label_perbulan)
      {
        const data = {
            labels: label_perbulan,
            datasets: [{
              label: 'Laba Bersih',
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              // data: [1,2,3,4,5,6,7,8,9,10,11,12],
              data: data_laba_bersih,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                  datalabels: {
                    color: 'black',
                    formatter: (val, ctx) => {
                      return `Rp. ${val.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")}`
                    }
                  },
                },
            }
        };

        const myChart = new Chart(
            document.getElementById('chartLabaBersih'),
            config
        );
      }
      getChartLabaBersih(data_laba_bersih, label_perbulan)

      function donutChart(data_donut, label_category) {
            const data = {
              labels: label_category,
              datasets: [{
                label: 'Persentae Pengeluaran Terbanyak',
                data: data_donut,
                backgroundColor: color,
                // hoverOffset: 4
              }]
            };
            const config = {
              type: 'pie',
              data: data,
              options: {
                responsive:true,
                maintainAspectRatio: false,
                legend: {
                    position: 'left'
                },
                plugins: {
                  datalabels: {
                    color: 'white',
                    formatter: (val, ctx) => {
                      return `${val}%`
                    }
                  },
                } 
              }
            };
            const myChart = new Chart(
                document.getElementById('chartDonut'),
                config
            );
      }
      donutChart(data_donut, label_category)

    })
</script>