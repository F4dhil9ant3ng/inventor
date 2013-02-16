<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus produk
if ($module=='produk' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
     unlink("../../../foto_produk/$_GET[namafile]");   
     unlink("../../../foto_produk/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);


  mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input produk
elseif ($module=='produk' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[merk]);
  $merk 			=$_POST[merk];
  $model 			=$_POST[model];
  $jenis 			=$_POST[jenis];
  $vendor 			=$_POST[vendor];
  $warehouse_location =$_POST[warehouse_location];
  $serial_number 	=$_POST[serial_number];
  $kategori 		=$_POST[kategori];
  $berat 			=$_POST[berat];
  $harga 			=$_POST[harga];
  $stok 			=$_POST[stok];
  $no_po			=$_POST[no_po];
  $spesification 	=$_POST[spesification];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=produk)</script>";
    }
    else{
    UploadImage($nama_file_unik);

    mysql_query("INSERT INTO produk(merk,
									model,
                                    produk_seo,
                                    jenis,
                                    vendor,
                                    warehouse_location,
                                    no_po,
                                    serial_number,
                                    id_kategori,
									berat,
                                    harga,
                                    stok,
									spesification,
                                    gambar) 
                            VALUES('$merk',
								   '$model',
                                   '$produk_seo',
                                   '$jenis',
                                   '$vendor',
                                   '$warehouse_location',
                                   '$no_po',
                                   '$serial_number',
                                   '$kategori',
								   '$berat',                                 
                                   '$harga',
                                   '$stok',
								   '$spesification',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module.'&idsub='.$_POST[kategori]);
  }
  }
  else{
    mysql_query("INSERT INTO produk(merk,
									model,
                                    produk_seo,
                                    jenis,
                                    vendor,
                                    warehouse_location,
                                    no_po,
                                    serial_number,
                                    id_kategori,
									berat,
                                    harga,
                                    stok,
									spesification) 
                            VALUES('$merk',
								   '$mode',
                                   '$produk_seo',
                                   '$jenis',
                                   '$vendor',
                                   '$warehouse_location',
                                   '$no_po',
                                   '$serial_number',
								   '$kategori',
                                   '$berat',
								   '$harga',                                 
                                   '$stok',
								   '$spesification')");
    /* echo('merk : '. $merk);
	 echo('<br>model : '.$model);
	 echo('<br>produk seo : '.$produk_seo);
	 echo('<br>Berat : '.$berat);
	 echo('<br>harga : '.$harga);
	 echo('<br>stok : '.$stok);		
	 echo('<br>ketrgori : '.$kategori);	*/							   
  header('location:../../media.php?module='.$module.'&idsub='.$_POST[kategori]);
  }
}

// Update produk
elseif ($module=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $produk_seo      = seo_title($_POST[merk]);
  $merk 			=$_POST[merk];
  $model 			=$_POST[model];
  $jenis 			=$_POST[jenis];
  $vendor 			=$_POST[vendor];
  $warehouse_location =$_POST[warehouse_location];
  $no_po 			=$_POST[no_po];
  $serial_number 	=$_POST[serial_number];
  $kategori 		=$_POST[kategori];
  $berat 			=$_POST[berat];
  $harga 			=$_POST[harga];
  $stok 			=$_POST[stok];
  $spesification 	=$_POST[spesification];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET merk 		= '$merk',
								   model 		= '$model',
                                   produk_seo  	= '$produk_seo', 
                                   jenis 		= '$jenis',
                                   vendor       = '$vendor',
                                   warehouse_location = '$warehouse_location',
                                   no_po        = '$no_po',
                                   serial_number= '$serial_number',
                                   kategori   	= '$kategori',
								   berat	   	= '$berat',
                                   harga 		= '$harga',
								   stok	   		=  '$stok',
								   spesification= '$spesification'
                             WHERE id_produk   	= '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&idsub='.$_POST[kategori]);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=produk)</script>";
    }
    else{
    UploadImage($nama_file_unik);
  	mysql_query("UPDATE produk SET merk 		= '$merk',
								   model 		= '$model',
                                   produk_seo  	= '$produk_seo', 
                                   jenis 		= '$jenis',
                                   vendor       = '$vendor',
                                   warehouse_location = '$warehouse_location',
                                   no_po        = '$no_po',
                                   serial_number= '$serial_number',
                                   kategori   	= '$kategori',
								   berat	   	= '$berat',
                                   harga 		= '$harga',
								   stok	   		=  '$stok',
								   spesification= '$spesification'
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
    header('location:../../media.php?module='.$module.'&idsub='.$_POST[kategori]);
    }
  }
}
}
?>
