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
   echo "<h2>Laporan Total Stok Barang</h2>

          <form method=POST action='?module=laporanstokbarang'>
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
}
// Baca input tanggal yang dikirimkan user
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
$sql = mysql_query("select *,DATE_FORMAT(produk.tgl_masuk, '%d-%m-%Y') as tanggal from produk,kategori,sub_kategori
					 where produk.tgl_masuk BETWEEN '$mulai' AND '$selesai' 
					 AND produk.id_kategori=sub_kategori.id_sub_kategori 
					 AND sub_kategori.id_kategori=kategori.id_kategori
					 order BY kategori.nama_kategori ASC LIMIT $posisi,$batas");
$jml = mysql_num_rows($sql);
	echo("<form method=POST action='modul/mod_laporan/pdf_total_stok_barang.php'><table><tr><th>No</th><th>Nama Barang</th><th>Model</th><th>Kategori</th><th>S.Kategori</th><th>S.Number</th><th>Vendor</th><th>Jenis</th><th>Stok</th><th>harga</th><th>Sub Total</th></tr>");
	
	if ($jml > 0){
	$i = 1;
		 while($r=mysql_fetch_array($sql)){
		  $quantityharga=rp($r[stok]*$r[harga]);
		  $hargarp=rp($r[harga]); 
		  $faktur=$r[faktur];
		  
		  echo "<tr><td>$i</td>
						  <td>$r[merk]</td>
						  <td>$r[model]</td>
						  <td>$r[nama_kategori]</td>
						  <td>$r[nama_sub_kategori]</td>
						  <td>$r[serial_number]</td>
						  <td>$r[vendor]</td>
						  <td>$r[jenis]</td>
						  <td>$r[stok]</td>
						  <td>$r[harga]</td>
						  <td>$quantityharga</td></tr>";
			$total = $total+($r[stok]*$r[harga]);
			$totqu = $totqu + $r[stok];
		  $i++;
		}
		$tot=rp($total);
	}
	  echo "<tr><td colspan=10>Total Keseluruhan Harga : Rp.</td><td>".$tot."</td></tr>";
	  echo "<tr><td colspan=10>Jumlah Total Produk : Rp.</td><td>".$jml." unit</td></tr>";
	  echo "<tr><td colspan=10>Jumlah Total Stok Barang : Rp.</td><td>".$totqu." unit</td></tr>";
	  echo(" <input type=hidden name=tglmulai value=$mulai>");
	  echo(" <input type=hidden name=tglselesai value=$selesai>");
	  echo "<tr><td colspan=11 align=right><input type=submit value=Cetak></td></tr>";
	echo("</table></form>");
	
	$jmldata = mysql_num_rows(mysql_query("select *,DATE_FORMAT(produk.tgl_masuk, '%d-%m-%Y') as tanggal from produk,kategori,sub_kategori
						 where produk.tgl_masuk BETWEEN '$mulai' AND '$selesai' 
						 AND produk.id_kategori=sub_kategori.id_sub_kategori 
						 AND sub_kategori.id_kategori=kategori.id_kategori
						 order BY kategori.nama_kategori ASC"));
	
	$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
	 $linkHalaman = $p->navHalamanLaporan($_GET[halaman], $jmlhalaman,$mulai,$selesai);
	 echo "<div id=paging>Hal: $linkHalaman</div><br>";	
?>
