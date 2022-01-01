<?php

// DEFINE("WEB", "localhost/keuangan/"); // SET WEBSITE ADDRESS
DEFINE("WEB", ""); // SET WEBSITE ADDRESS


date_default_timezone_set("Asia/Jakarta");

include_once 'session.php';
include 'db.php';

class Notifications {

	public static function setNotif($text)
	{
		$_SESSION['notif'] = $text;
	}

	public static function notif()
	{
		if(isset($_SESSION['notif']))
		{
			echo '<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered wd-sm-400" role="document">
							<div class="modal-content">
								<div class="text-center py-4 px-2">
									<h4 class="tx-spacing-1 mb-3">' . $_SESSION['notif'] . '</h4>
									<button type="button" class="btn btn-primary mb-0 text-white" data-dismiss="modal">OK</button>
								</div>
							</div>
						</div>
					</div>';
			unset($_SESSION['notif']);
		}
	}

}

class Config
{

	private $db;
	public function __construct()
	{
		$this->db = new Databese();
	}

	public function random_string_idcl($length) {
	    $key = '';
	    $keys = array_merge(range(0, 9), range('a', 'z'));

	    for ($i = 0; $i < $length; $i++) {
	        $key .= strtoupper($keys[array_rand($keys)]);
	    }

	    return $key;
	}

	/* Site Url */
	public function site_url()
    {
    	$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$config['base_url'] .= "://".$_SERVER['HTTP_HOST'];
		$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

		return $config['base_url'];
	}

	public function insert($table,$data){
		$fields = "(";
		$values = "(";
		$index  = 0;
		
		foreach ($data as $key => $val) {
			$fieldname = ($index < count($data)-1) ? $key.", " : $key. ")";
			$valuedata = ($index < count($data)-1) ? "'".$val."', "  : "'".$val."')";
	
			$fields .= $fieldname;
			$values .= $valuedata;
	
			$index++;
		}
		$query = $this->db->pdo->prepare("INSERT INTO ".$table." ".$fields." VALUES ".$values." ");
		$query->execute();
		return $query;
	}
	
	public function update($table_name, $fields, $where) {  
		$query = '';  
		$condition = '';  
		foreach($fields as $key => $value){  
			$query .= $key . "='".$value."', ";  
		}  
		$query = substr($query, 0, -2);  
		foreach($where as $key => $value){  
			$condition .= $key . "='".$value."' AND ";  
		}  
		$condition = substr($condition, 0, -5);  
	
		$query = $this->db->pdo->prepare("UPDATE ".$table_name." SET ".$query." WHERE ".$condition."");
		$query->execute();  
		return $query;
	  }
	
	// umum
	public function readTable($table, $id){
		$sql = "SELECT * FROM $table ORDER BY $id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function query($sql){
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function query2($sql)
	{
		$this->query = $this->db->pdo->prepare($sql);
		return $this;
	}


	public function readTable5($table){
		$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 5";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	public function readTableBy($table,$mandatory,$key){
		$sql = "SELECT * FROM $table WHERE $mandatory = $key  ORDER BY id desc";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function readtByOrder($table,$mandatory,$key, $sort_mode, $sort_by)
	{
		$sql = "SELECT * FROM $table WHERE $mandatory = $key  ORDER BY $sort_mode $sort_by";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function getEachTable($table,$mandatory,$key){
		$sql = "SELECT * FROM $table WHERE $mandatory = '$key'";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function getEachTableCok($table,$mandatory,$key){
		$sql = "SELECT * FROM $table WHERE $mandatory = '$key'";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		while($data = $query->fetch(PDO::FETCH_OBJ)){
			$result[] = $data;
		}
		return empty($result) ? null : $result;
		// $result = $query->fetch(PDO::FETCH_OBJ);
		// return $result;
	}

	public function getEachTblArry($table,$mandatory,$key){
		$sql = "SELECT * FROM $table WHERE $mandatory='$key'";
		// echo $sql;die;
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function getTotaltransaksiMasuk($data)
	{
		$start_date = !empty($data) ? $data['start_date'] : NULL;
		$end_date = !empty($data) ? $data['end_date'] : NULL;
        $id_user = Session::get('id');
		$sql = "SELECT SUM(jumlah_pemasukan) as ttl_pemasukan from transaksi_masuk"; 
		if ($start_date != "" && $end_date != "") $sql .= " WHERE tanggal BETWEEN '$start_date' AND '$end_date' AND id_user = '$id_user' AND is_delete = 0 ";
		if($start_date == "" && $end_date == "") $sql .= " WHERE id_user = '$id_user' AND is_delete = 0 ";
// 		print_r($sql); die;
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function getTotalPengeluaran($data)
	{
		$start_date = !empty($data) ? $data['start_date'] : NULL;
		$end_date = !empty($data) ? $data['end_date'] : NULL;
        $id_user = Session::get('id');
		$sql = "SELECT SUM(total) as ttl_pemasukan from pengeluaran transaksi_masuk"; 
		if ($start_date != "" && $end_date != "") $sql .= " WHERE tanggal BETWEEN '$start_date' AND '$end_date' AND id_user = '$id_user' AND is_delete = 0 ";
		if($start_date == "" && $end_date == "") $sql .= " WHERE id_user = '$id_user' AND is_delete = 0 ";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function inputTransaksPengeluaranImage($data)
	{
		$tanggal = $data['tanggal'];
		$nama_file = "KUY-$tanggal-".$this->random_string_idcl(15).".png";
        $path = "../assets/images/butki_pengeluaran/".$nama_file;
        if (!$_FILES['gambar_bukti'] && !isset($_FILES)) {
        	$data = array(
				'total' => preg_replace('/\D/','', $data['total']), 
				'tanggal' => $data['tanggal'], 
				'name_pengeluaran' => $data['name_pengeluaran'], 
				'id_category_pengeluaran' => $data['nama_category'], 
				'keterangan' => $data['keterangan'], 
				'id_user' => Session::get('id'),
				'is_delete' => 0,
				'created_date' => date('Y-m-d H:s:i'),
				'created_by' => Session::get('nama')
			);
			
			$result = $this->insert('pengeluaran', $data);
			if($result){
				Notifications::setNotif("Data Pengeluaran Berhasil Di simpan");
				header("Location: ".WEB."pengeluaran-keuangan");
				exit();
			}else{
				Notifications::setNotif("Data Pengeluaran Gagal Di simpan");
				header("Location: ".WEB."pengeluaran-keuangan");
			}
        }else{
        	$tmp_file     = $_FILES['gambar_bukti']['tmp_name'];
            $tipe_file    = $_FILES['gambar_bukti']['type'];
            $ukuran_file  = $_FILES['gambar_bukti']['size'];
            if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
                if($ukuran_file <= 2000000){
                    if(move_uploaded_file($tmp_file, $path)){
						$data = array(
							'total' => preg_replace('/\D/','', $data['total']), 
							'tanggal' => $data['tanggal'], 
							'image' =>$nama_file, 
							'name_pengeluaran' => $data['name_pengeluaran'], 
							'id_category_pengeluaran' => $data['nama_category'], 
							'keterangan' => $data['keterangan'], 
							'id_user' => Session::get('id'),
							'is_delete' => 0,
							'created_date' => date('Y-m-d H:s:i'),
							'created_by' => Session::get('nama')
						);
						
						$result = $this->insert('pengeluaran', $data);
						if($result){
							Notifications::setNotif("Data Pengeluaran Berhasil Di simpan");
							header("Location: ".WEB."pengeluaran-keuangan");
							exit();
						}else{
							Notifications::setNotif("Data Pengeluaran Gagal Di simpan");
							header("Location: ".WEB."pengeluaran-keuangan");
						}
                    }
                }
            }
        }
	}

	public function inputPengeluran($data)
	{
		$data = array(
			'total' => preg_replace('/\D/','', $data['total']), 
			'tanggal' => $data['tanggal'], 
			'name_pengeluaran' => $data['name_pengeluaran'], 
			'id_category_pengeluaran' => $data['nama_category'], 
			'keterangan' => $data['keterangan'], 
			'id_user' => Session::get('id'),
			'is_delete' => 0,
			'created_date' => date('Y-m-d H:s:i'),
			'created_by' => Session::get('nama')
		);
		
		$result = $this->insert('pengeluaran', $data);
		if($result){
			Notifications::setNotif("Data Pengeluaran Berhasil Di simpan");
			header("Location: ".WEB."pengeluaran-keuangan");
			exit();
		}else{
			Notifications::setNotif("Data Pengeluaran Gagal Di simpan");
			header("Location: ".WEB."pengeluaran-keuangan");
		}
			
	}

	public function editPengeluaran($data)
	{
		$data = array(
			'total' => preg_replace('/\D/','', $data['total']), 
			'tanggal' => $data['tanggal'], 
			'name_pengeluaran' => $data['name_pengeluaran'], 
			'id_category_pengeluaran' => $data['nama_category'], 
			'keterangan' => $data['keterangan'], 
			'id_user' => Session::get('id'),
			'is_delete' => 0,
			'created_date' => date('Y-m-d H:s:i'),
			'created_by' => Session::get('nama')
		);

		$where = array(
			'id_pengeluaran' => $_GET['edit-pengeluaran']
		);

		$result = $this->update('pengeluaran', $data, $where);
		// print_r($result);die;
		if($result){
			Notifications::setNotif("Data Pengeluaran Berhasil Di update");
			header("Location: ".WEB."pengeluaran-keuangan");
			exit();
		}else{
			Notifications::setNotif("Data Pengeluaran Gagal Di update");
			header("Location: ".WEB."pengeluaran-keuangan");
			exit();
		}

	}
    
    public function inputTransaksImage($data)
	{
		$tanggal = $data['tanggal'];
		$nama_file = "KUY-$tanggal-".$this->random_string_idcl(15).".png";
        $path = "../assets/images/bukti_pemasukan/".$nama_file;
        if (!$_FILES['gambar_bukti'] && !isset($_FILES)) {
        	$data = array(
				'jumlah_pemasukan' => preg_replace('/\D/','', $data['jumlah_pemasukan']), 
				'tanggal' => $data['tanggal'], 
				'name_pemasukan' => $data['name_pemasukan'], 
				'jenis_transaksi' => $data['jenis_transaksi'], 
				'ket_pemasukan' => $data['ket_transaksi'], 
				'id_user' => Session::get('id'),
				'is_delete' => 0
			);
			// print_r("Location: ".WEB."/dashboard/pemasukan-keuangan");die;
			$result = $this->insert('transaksi_masuk', $data);
			if($result){
				Notifications::setNotif("Data Transkasi Masuk Berhasil Di simpan");
				header("Location: ".WEB."pemasukan-keuangan");
				exit();
			}else{
				Notifications::setNotif("Data Transkasi Masuk Gagal Di simpan");
				header("Location: ".WEB."pemasukan-keuangan");
				exit();
			}
        }else{
        	$tmp_file     = $_FILES['gambar_bukti']['tmp_name'];
            $tipe_file    = $_FILES['gambar_bukti']['type'];
            $ukuran_file  = $_FILES['gambar_bukti']['size'];
            if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
                if($ukuran_file <= 2000000){
                    if(move_uploaded_file($tmp_file, $path)){
						$data = array(
							'jumlah_pemasukan' => preg_replace('/\D/','', $data['jumlah_pemasukan']), 
							'tanggal' => $data['tanggal'], 
							'image' =>$nama_file, 
							'name_pemasukan' => $data['name_pemasukan'], 
							'jenis_transaksi' => $data['jenis_transaksi'], 
							'ket_pemasukan' => $data['ket_transaksi'], 
							'id_user' => Session::get('id'),
							'is_delete' => 0
						);
						// print_r("Location: ".WEB."/dashboard/pemasukan-keuangan");die;
						$result = $this->insert('transaksi_masuk', $data);
						if($result){
							Notifications::setNotif("Data Transkasi Masuk Berhasil Di simpan");
							header("Location: ".WEB."pemasukan-keuangan");
							exit();
						}else{
							Notifications::setNotif("Data Transkasi Masuk Gagal Di simpan");
							header("Location: ".WEB."pemasukan-keuangan");
							exit();
						}
                    }
                }
            }
        }
	}
    
	public function inputTransaksi($data)
	{
		$data = array(
			'jumlah_pemasukan' => preg_replace('/\D/','', $data['jumlah_pemasukan']), 
			'tanggal' => $data['tanggal'], 
			'name_pemasukan' => $data['name_pemasukan'], 
			'jenis_transaksi' => $data['jenis_transaksi'], 
			'ket_pemasukan' => $data['ket_transaksi'], 
			'id_user' => Session::get('id'),
			'is_delete' => 0
		);
		// print_r("Location: ".WEB."/dashboard/pemasukan-keuangan");die;
		$result = $this->insert('transaksi_masuk', $data);
		if($result){
			Notifications::setNotif("Data Transkasi Masuk Berhasil Di simpan");
			header("Location: ".WEB."pemasukan-keuangan");
			exit();
		}else{
			Notifications::setNotif("Data Transkasi Masuk Gagal Di simpan");
			header("Location: ".WEB."pemasukan-keuangan");
			exit();
		}
	}

	public function editTransaksi($data)
	{
		$data = array(
			'jumlah_pemasukan' => preg_replace('/\D/','', $data['jumlah_pemasukan']), 
			'tanggal' => $data['tanggal'], 
			'name_pemasukan' => $data['name_pemasukan'], 
			'jenis_transaksi' => $data['jenis_transaksi'], 
			'ket_pemasukan' => $data['ket_transaksi'], 
			'id_user' => Session::get('id'),
			'is_delete' => 0
		);

		$where = array(
			'id_transaksi' => $_POST['id_transaksi']
		);
		$result = $this->update('transaksi_masuk', $data, $where);
		// print_r($result);die;
		if($result){
			Notifications::setNotif("Data Transkasi Masuk Berhasil Di update");
			header("Location: ".WEB."pemasukan-keuangan");
			exit();
		}else{
			Notifications::setNotif("Data Transkasi Masuk Gagal Di update");
			header("Location: ".WEB."pemasukan-keuangan");
			exit();
		}
	}

	/*
	* Login Query
	*/
	public function getLogin($username, $password)
	{
		$sql = "SELECT * FROM login WHERE username = :username AND password = :password AND status = '1' LIMIT 1";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':username', $username);
		$query->bindValue(':password', $password);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function userLogin($data)
	{
		$username 	= $data['username'];
		$password	= md5($data['password']);
		$result     = $this->getLogin($username, $password);

		if($result != ''){
			$tanggal 		= date("Y-m-d");
			$jam			= date("H:i");
			$aktifitas 		= "Login";
			$keterangan 	= "Login";
			$admin 			= $result->id;

			$sql = "INSERT INTO log (tanggal,jam,aktifitas,keterangan,admin) VALUES ('$tanggal','$jam','$aktifitas','$keterangan','$admin')";
			$query = $this->db->pdo->prepare($sql);
			$asd = $query->execute();

			Session::init();
			Session::set("login", true);
			Session::set("id", $result->id);
			Session::set("nama", $result->nama);
			Session::set("role", $result->role);
			Notifications::setNotif("Login Berhasil !");
			header("Location: ".WEB."dashboard/index");
			exit;
			/*if ($result->role == "1"){
				header("Location: ".WEB."pemilik/dashboard");
				exit;
			}*/
		}else{
			Notifications::setNotif("Cek Kembali Username dan Password Anda Mungkin Ada Yang Salah");
			header("Location: ".WEB."./");
			exit;
		}


	}

	public function deleteByWhere($table,$mandatory, $key, $route)
	{
		$sql = "UPDATE $table SET is_delete = 1 WHERE $mandatory = '$key'";
		$query = $this->db->pdo->prepare($sql);
		$result = $query->execute();
		if($result){
			Notifications::setNotif("Delete data Berhasil Di update");
			header("Location: ".WEB.$route);
			exit();
		}else{
			Notifications::setNotif("Delete data Gagal Di update");
			header("Location: ".WEB.$route);
			exit();
		}
	}

	// logout
	public function logout()
	{
		$tanggal	= date("Y-m-d");
		$jam		= date("H:i");
		$aktifitas 	= "Logout";
		$keterangan = "Logout";
		$admin		= Session::get('id');

		$sql = "INSERT INTO log (tanggal,jam,aktifitas,keterangan,admin) VALUES ('$tanggal','$jam','$aktifitas','$keterangan','$admin')";
		$query = $this->db->pdo->prepare($sql);
		$result = $query->execute();
		return $result;
	}

	public function rowObject(){
		$this->query->execute();
	    while($data = $this->query->fetch(PDO::FETCH_OBJ)){
	      $result[] = $data;
	    }
	    return empty($result) ? null : $result;
    }

    public function rowArray(){
		$this->query->execute();
	    while($data = $this->query->fetchAll()){
	      $result[] = $data;
	    }
	    return empty($result) ? null : $result;
    }

}
?>