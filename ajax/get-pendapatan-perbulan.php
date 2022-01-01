<?php 


include '../sys/config.php';
$c = new Config();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$ttl_pemasukan = array();
	for ($bulan=1; $bulan < 13; $bulan++) {
	  $grafik_dc = $c->query(" SELECT sum(jumlah_pemasukan) as ttl_pemasukan FROM transaksi_masuk WHERE MONTH(tanggal) = '$bulan' AND is_delete = 0 ");
	  $ttl_pemasukan[] = !empty($grafik_dc[0]['ttl_pemasukan']) ? $grafik_dc[0]['ttl_pemasukan'] : 0;
	}

	echo json_encode($ttl_pemasukan);

}

?>