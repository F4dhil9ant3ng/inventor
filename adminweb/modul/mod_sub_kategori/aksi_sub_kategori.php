<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];
// Hapus Kategori
if ($module=='subkategori' AND $act=='hapus'){
  mysql_query("DELETE FROM sub_kategori WHERE id_sub_kategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='subkategori' AND $act=='input'){
  //$kategori_seo = seo_title($_POST['nama_sub_kategori']);
  mysql_query("INSERT INTO sub_kategori(nama_sub_kategori,id_kategori) VALUES('$_POST[nama_sub_kategori]','$_POST[kategori]')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='subkategori' AND $act=='update'){
  $kategori_seo = seo_title($_POST['nama_sub_kategori']);
  mysql_query("UPDATE sub_kategori SET nama_sub_kategori = '$_POST[nama_sub_kategori]',id_kategori='$_POST[kategori]' WHERE id_sub_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
