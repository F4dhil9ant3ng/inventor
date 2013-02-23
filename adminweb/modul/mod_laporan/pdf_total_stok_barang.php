<?php
error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "class.ezpdf.php";
include "../../../config/koneksi.php";
include "rupiah.php";
  
$pdf = new Cezpdf();
 
// Set margin dan font
$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('fonts/Courier.afm');

$all = $pdf->openObject();

// Tampilkan logo
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo.jpg',20,800,69);

// Teks di tengah atas untuk judul header
$pdf->addText(350, 550, 16,'<b>Laporan Total Stok Barang</b>');
$pdf->addText(300, 530, 14,'<b>Data Warehouse Online System Indosat</b>');
// Garis atas untuk header
$pdf->line(10, 795, 578, 795);

// Garis bawah untuk footer
$pdf->line(10, 50, 578, 50);
// Teks kiri bawah
$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

// Baca input tanggal yang dikirimkan user
/*$mulai=$_POST[thn_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[tgl_mulai];
$selesai=$_POST[thn_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[tgl_selesai];*/

$mulai=$_POST[tglmulai];
$selesai=$_POST[tglselesai];

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("select *,DATE_FORMAT(produk.tgl_masuk, '%d-%m-%Y') as tanggal from produk,kategori,sub_kategori
					 where produk.tgl_masuk BETWEEN '$mulai' AND '$selesai' 
					 AND produk.id_kategori=sub_kategori.id_sub_kategori 
					 AND sub_kategori.id_kategori=kategori.id_kategori
					 order BY kategori.nama_kategori ASC");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $quantityharga=rp($r[stok]*$r[harga]);
  $hargarp=rp($r[harga]); 
  $faktur=$r[faktur];
  
  $data[$i]=array('<b>No</b>'=>$i, 
                  '<b>Nama Barang</b>'=>$r[merk], 
				  '<b>Model</b>'=>$r[model],
				  '<b>Kategori</b>'=>$r[nama_kategori], 
				  '<b>S.Kategori</b>'=>$r[nama_sub_kategori], 
                  '<b>S.Number</b>'=>$r[serial_number], 
                  '<b>Vendor</b>'=>$r[vendor],
				  '<b>Jenis</b>'=>$r[jenis],
                  '<b>Stok</b>'=>$r[stok],
				  '<b>harga</b>'=>rp($r[harga]),
                  '<b>Sub Total</b>'=>$quantityharga);
	$total = $total+($r[stok]*$r[harga]);
	$totqu = $totqu + $r[stok];
  $i++;
}

$pdf->ezTable($data, '', '', '');

$tot=rp($total);
$pdf->ezText("\n\nTotal Keseluruhan Harga : Rp. {$tot}");
$pdf->ezText("\nJumlah Total Produk : {$jml} unit");
$pdf->ezText("\nJumlah Total Stok Barang : {$totqu} unit");

// Penomoran halaman
$pdf->ezStartPageNumbers(320, 15, 8);
$pdf->ezStream();
}
else{
  $m=$_POST[tgl_mulai].'-'.$_POST[bln_mulai].'-'.$_POST[thn_mulai];
  $s=$_POST[tgl_selesai].'-'.$_POST[bln_selesai].'-'.$_POST[thn_selesai];
  echo "Tidak ada transaksi/stok pada Tanggal $m s/d $s";
}
}
?>
