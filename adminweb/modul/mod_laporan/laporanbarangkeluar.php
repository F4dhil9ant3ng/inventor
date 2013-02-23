<?php
session_start();
	
	$req = $_SERVER['REQUEST_METHOD'];
	if($req=='POST'){
		$mulaii=$_POST['mulai'];
		$selesaii=$_POST['selesai'];
	}else{
		$mulaii=$_GET['mulai'];
		$selesaii=$_GET['selesai'];
	}
	
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	include "rupiah.php";
   echo "<h2>Laporan Barang Keluar</h2>
			
          <form method=POST action='?module=laporanbarangkeluar'>
          <table>
          <tr><td colspan=2><b>Laporan Per Periode</b></td></tr>
          <tr><td>Dari Tanggal</td><td> : ";        
          combotgl(1,31,'tgl_mulai',$tgl_skrg);
          combonamabln(1,12,'bln_mulai',$bln_sekarang);
          combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);

    echo "</td></tr>
          <tr><td>s/d Tanggal</td><td> : ";
          combotgl(1,31,'tgl_selesai',$tgl_skrg);
          combonamabln(1,12,'bln_selesai',$bln_sekarang);
          combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang);

    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Proses></td></tr>
          </table>
          </form>";
}// Baca input tanggal yang dikirimkan user

if($mulaii!="" || $selesaii!=""){
	$mulai=$mulaii;
	$selesai=$selesaii;
}else{
	$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
	$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];
}

	$p      = new Paging;
    $batas  = 12;
    $posisi = $p->cariPosisi($batas);
// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("select orders.id_orders,orders.status_order,DATE_FORMAT(orders.tgl_order, '%d-%m-%Y') as tgl_order,orders.jam_order,
					DATE_FORMAT(orders.tgl_pengambilan, '%d-%m-%Y') as tgl_pengambilan,orders.jam_pengambilan,orders.use_for,orders.id_wo,
					orders.nama_pelanggan,produk.merk,sub_kategori.nama_sub_kategori,orders_detail.jumlah,produk.harga,produk.stok 
					from orders,orders_detail,produk,sub_kategori 
					Where orders.id_orders=orders_detail.id_orders
					AND orders.status_order ='Pengambilan'
					AND produk.id_produk=orders_detail.id_produk
					AND produk.id_kategori=sub_kategori.id_sub_kategori
					AND orders.tgl_pengambilan BETWEEN '$mulai' AND '$selesai' 
					order BY orders.tgl_pengambilan DESC LIMIT $posisi,$batas");
$jml = mysql_num_rows($sql);
	echo("<form method=POST action='modul/mod_laporan/pdf_barang_keluar.php'><table><tr><th>No</th><th>No.Order</th><th>Id Wo</th><th>Tgl Order</th><th>Tgl Keluar</th><th>Nama Barang</th><th>S.Kategori</th><th>Use For</th><th>Pelanggan</th><th>Jml</th><th>Harga</th><th>Sub Total</th></tr>");
	
	
	if ($jml > 0){
	$i = 1;
		 while($r=mysql_fetch_array($sql)){
		  $quantityharga=rp($r[stok]*$r[harga]);
		  $hargarp=rp($r[harga]); 
		  $faktur=$r[faktur];
		  
		  echo "<tr><td>$i</td>
						  <td>$r[id_orders]</td>
						  <td>$r[id_wo]</td>
						  <td>$r[tgl_order]</td>
						  <td>$r[tgl_pengambilan]</td>
						  <td>$r[merk]</td>
						  <td>$r[nama_sub_kategori]</td>
						  <td>$r[use_for]</td>
						  <td>$r[nama_pelanggan]</td>
						  <td>$r[jumlah]</td>
						  <td>".rp($r[harga])."</td>
						  <td>$quantityharga</td></tr>";
			$total = $total+($r[stok]*$r[harga]);
			$totqu = $totqu + $r[stok];
		  $i++;
		}
		$tot=rp($total);
	}
	  echo "<tr><td colspan=11>Total Keseluruhan Harga : Rp.</td><td>".$tot."</td></tr>";
	  echo "<tr><td colspan=11>Jumlah Total Produk : Rp.</td><td>".$jml." unit</td></tr>";
	  echo "<tr><td colspan=11>Jumlah Total Stok Barang : Rp.</td><td>".$totqu." unit</td></tr>";
	  echo(" <input type=hidden name=tglmulai value=$mulai>");
	  echo(" <input type=hidden name=tglselesai value=$selesai>");
	  echo "<tr><td colspan=12 align=right><input type=submit value=Cetak></td></tr>";
	echo("</table></form>");
	
	$jmldata = mysql_num_rows(mysql_query("select orders.id_orders,orders.status_order,DATE_FORMAT(orders.tgl_order, '%d-%m-%Y') as tgl_order,orders.jam_order,
											DATE_FORMAT(orders.tgl_pengambilan, '%d-%m-%Y') as tgl_pengambilan,orders.jam_pengambilan,orders.use_for,orders.id_wo,
											orders.nama_pelanggan,produk.merk,sub_kategori.nama_sub_kategori,orders_detail.jumlah,produk.harga,produk.stok 
											from orders,orders_detail,produk,sub_kategori 
											Where orders.id_orders=orders_detail.id_orders
											AND orders.status_order ='Pengambilan'
											AND produk.id_produk=orders_detail.id_produk
											AND produk.id_kategori=sub_kategori.id_sub_kategori
											AND orders.tgl_pengambilan BETWEEN '$mulai' AND '$selesai' 
											order BY orders.tgl_pengambilan DESC"));
	 $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
	 $linkHalaman = $p->navHalamanLaporan($_GET[halaman], $jmlhalaman,$mulai,$selesai);
	 echo "<div id=paging>Hal: $linkHalaman</div><br>";	
?>
