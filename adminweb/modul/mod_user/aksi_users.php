<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='user' AND $act=='hapususer'){
  mysql_query("DELETE FROM kustomer WHERE nik='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input user
elseif ($module=='user' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO kustomer(nik,
                                 password,
                                 nama_lengkap,
								 divisi,
								 unit_kerja,
								 lokasi_kerja,
								 nama_manajer,
                                 email, 
                                 telpon) 
	                       VALUES('$_POST[nik]',
                                '$pass',
                                '$_POST[nama_lengkap]',
								'$_POST[divisi]',
								'$_POST[unit_kerja_lantai]',
								'$_POST[lokasi_kerja]',
								'$_POST[nama_manajer]',
                                '$_POST[email]',
                                '$_POST[telpon]')");
  header('location:../../media.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
  if (empty($_POST[password])) {
    mysql_query("UPDATE kustomer SET nama_lengkap   = '$_POST[nama_lengkap]',
								  divisi		  = '$_POST[divisi]',	 
								  unit_kerja_lantai     = '$_POST[unit_kerja_lantai]',
								  lokasi_kerja   = '$_POST[lokasi_kerja]',
								  nama_manajer   = '$_POST[nama_manajer]',
                                  email          = '$_POST[email]', 
                                  telpon        = '$_POST[telpon]'  
                           WHERE  nik     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE kustomer SET password    = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
								 divisi		     = '$_POST[divisi]',	 
								 unit_kerja_lantai      = '$_POST[unit_kerja]',
								 lokasi_kerja    = '$_POST[lokasi_kerja]',
								 nama_manajer    = '$_POST[nama_manajer]',
                                 email           = '$_POST[email]',   
                                 telpon         = '$_POST[telpon]'  
                           WHERE nik      = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
