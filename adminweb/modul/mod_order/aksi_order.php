<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_thumb.php";
	$module=$_GET['module'];
	$act=$_GET['act'];
	if ($module=='order' AND $act=='update'){		
		  		// Update stok barang saat transaksi sukses (Lunas)
		   if ($_POST[status_order]=='Approve'){ 
			
			  // Update untuk mengurangi stok 
		 /*     mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and 								               orders_detail.id_orders='$_POST[id]'");*/
			  
			  // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
			  mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and                orders_detail.id_orders='$_POST[id]'");
		
				
			  // Update status order
			  mysql_query("UPDATE orders SET status_order='$_POST[status_order]',nama_file='$nama_file' where id_orders='$_POST[id]'");
		
			  header('location:../../media.php?module='.$module);
			} elseif($_POST[status_order]=='Batal'){
				// Update untuk menambah stok
				mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and  orders_detail.id_orders='$_POST[id]'"); 
				
				// Update untuk menambahkan produk yang tidak jadi dibeli (tidak jd best seller)
			  mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$_POST[id]'");
		
				// Update status order Batal
			  $tgl_skrg = date("Ymd");
			  $jam_skrg = date("H:i:s");	
			  mysql_query("UPDATE orders SET status_order='".$_POST[status_order]."',tgl_pembatalan='".$tgl_skrg."',jam_pembatalan='".$jam_skrg."' where id_orders='$_POST[id]'");
		
				header('location:../../media.php?module='.$module);
			  }	else{
			  mysql_query("UPDATE orders SET status_order='$_POST[status_order]' where id_orders='$_POST[id]'");
			  header('location:../../media.php?module='.$module);
			}
	}else if ($module=='order' AND $act=='ambil'){
		$tgl_skrg = date("Ymd");
		$jam_skrg = date("H:i:s");
		$module=$_GET[module];
	    $act=$_GET[act];
		$lokasi_file = $_FILES['fupload']['tmp_name'];
 		$nama_file   = $_FILES['fupload']['name'];
		//awb
		$lokasi_file_awb=$_FILES['file_awb']['tmp_name'];
		$nama_file_awb=$_FILES['file_awb']['name'];
		
	switch($file_extension){
			case "pdf": $ctype="application/pdf"; break;
			case "exe": $ctype="application/octet-stream"; break;
			case "zip": $ctype="application/zip"; break;
			case "rar": $ctype="application/rar"; break;
			case "doc": $ctype="application/msword"; break;
			case "xls": $ctype="application/vnd.ms-excel"; break;
			case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
			case "gif": $ctype="image/gif"; break;
			case "png": $ctype="image/png"; break;
			case "jpeg":
			case "jpg": $ctype="image/jpg"; break;
			default: $ctype="application/proses";
		 }if ($file_extension=='php'){
		  		 echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
				window.location=('../../media.php?module=download')</script>";
		  }else{
		  		UploadFile($nama_file);
				UploadFile($nama_file_awb);
				$tipe_pic=$_POST[tipe_pic];
				$fe_pic=$_POST[fe_pic];
				$nama_pic_tipe=$_POST[name_pic_fe];
								
		  		if ($_POST[status_order]=='Pengambilan'){ 
				// Update status order
					if($tipe_pic=='Fe'){
						 mysql_query("UPDATE orders SET tgl_pengambilan='".$tgl_skrg."',jam_pengambilan='".$jam_skrg."', pic_penerima='".$_POST[name_pic_fe]."',
							pic_penyerah_barang='".$_POST[penyerah_barang]."', status_order='".$_POST[status_order]."',nama_file='$nama_file', 
							id_wo='".$_POST[id_wo]."',tipe_pic='".$tipe_pic."',fe_pic='".$fe_pic."' where id_orders='".$_POST[id]."'");
							header('location:../../media.php?module='.$module);	
					}else{
						 mysql_query("UPDATE orders SET tgl_pengambilan='".$tgl_skrg."',jam_pengambilan='".$jam_skrg."',
							pic_penyerah_barang='".$_POST[penyerah_barang]."', status_order='".$_POST[status_order]."',nama_file='$nama_file', 
							id_wo='".$_POST[id_wo]."',kode_awb='".$_POST[kode_awb]."',file_awb='$nama_file_awb' where id_orders='".$_POST[id]."'");
							header('location:../../media.php?module='.$module);	
					}
				}else if($_POST[status_order]=='Sudah Diambil'){
					if($tipe_pic=='Fe'){
						 mysql_query("UPDATE orders SET tgl_pengambilan='".$tgl_skrg."',jam_pengambilan='".$jam_skrg."', pic_penerima='".$_POST[name_pic_fe]."',
							pic_penyerah_barang='".$_POST[penyerah_barang]."', nama_file='$nama_file', 
							id_wo='".$_POST[id_wo]."',tipe_pic='".$tipe_pic."',fe_pic='".$fe_pic."' where id_orders='".$_POST[id]."'");
							header('location:../../media.php?module='.$module);	
					}else{
						 mysql_query("UPDATE orders SET tgl_pengambilan='".$tgl_skrg."',jam_pengambilan='".$jam_skrg."',
							pic_penyerah_barang='".$_POST[penyerah_barang]."',nama_file='$nama_file', 
							id_wo='".$_POST[id_wo]."',kode_awb='".$_POST[kode_awb]."',file_awb='$nama_file_awb' where id_orders='".$_POST[id]."'");
							header('location:../../media.php?module='.$module);	
					}
				}else{
				// Update untuk menambah stok
				mysql_query("UPDATE produk,orders_detail SET produk.stok=produk.stok+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$_POST[id]'"); 
							
				// Update untuk menambahkan produk yang tidak jadi dibeli (tidak jd best seller)
				 mysql_query("UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$_POST[id]'");
					
				// Update status order Batal
			mysql_query("UPDATE orders SET status_order='".$_POST[status_order]."',tgl_pembatalan='".$tgl_skrg."',jam_pembatalan='".$jam_skrg."' where id_orders='$_POST[id]'");
			header('location:../../media.php?module='.$module);
			}				
		 }	
	}else if ($module=='order' AND $act=='Return'){
		$tgl_skrg = date("Ymd");
		$jam_skrg = date("H:i:s");
		$module=$_GET[module];
	    $act=$_GET[act];
		
		mysql_query("UPDATE orders_detail SET status='Return',tgl_return_barang='".$tgl_skrg."'
		,jam_return_barang='".$jam_skrg."',keterangan='".$_POST[keterangan]."' where id_orders='$_POST[id]'");
		header('location:../../media.php?module='.$module);
	}	
}
?>
