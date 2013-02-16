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

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=produk)</script>";
    }
    else{
    UploadImage($nama_file_unik);

    mysql_query("INSERT INTO produk(nama_produk,
									serial_number,
                                    produk_seo,
                                    id_kategori,
                                    berat,
                                    harga,
                                    diskon,
                                    stok,
                                    deskripsi,
									model,
                                    part_number,
                                    tgl_masuk,
                                    gambar) 
                            VALUES('$_POST[nama_produk]',
								   '$_POST [serial_number]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
                                   '0',
                                   '0',
                                   '0',
                                   '$_POST[stok]',
                                   '$_POST[deskripsi]',
								   '0',                                 
                                   '0',
                                   '$tgl_sekarang',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module.'&id='.$_POST[kategori]);
  }
  }
  else{
    mysql_query("INSERT INTO produk(nama_produk,
									serial_number,
                                    produk_seo,
                                    id_kategori,
                                    berat,
                                    harga,
                                    diskon,
                                    stok,
                                    deskripsi,
									model,
                                    part_number,
                                    gambar,
                                    tgl_masuk) 
                            VALUES('$_POST[nama_produk]',
								   '$_POST[serial_number]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
                                   '0',                                 
                                   '0',
                                   '0',
                                   '$_POST[stok]',
                                   '$_POST[deskripsi]',
								   '0',                                 
                                   '0',
                                   '',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module.'&id='.$_POST[kategori]);
  }
}

// Update produk
elseif ($module=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
								   serial_number = '$_POST[serial_number]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   berat       = '0',
                                   harga       = '0',
                                   diskon      = '0',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]',
								   model	   = '0',
                                   part_number = '0',
								   gambar	   =  '',
								   tgl_masuk   = '$tgl_sekarang'
                             WHERE id_produk   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&id='.$_POST[kategori]);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=produk)</script>";
    }
    else{
    UploadImage($nama_file_unik);
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
								   serial_number = '$_POST[serial_number]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   berat       = '0',
                                   harga       = '0',
                                   diskon      = '0',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]',
								   model	   = '0',
                                   part_number = '0',
								   tgl_masuk   = '$tgl_sekarang',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
    header('location:../../media.php?module='.$module.'&id='.$_POST[kategori]);
    }
  }
}
}
?>
