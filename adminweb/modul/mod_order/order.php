<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_order/aksi_order.php";
switch($_GET[act]){
  // Tampil Order
  default:
    echo "<h2>Order</h2>
          <table>
          <tr><th>no.order</th><th>nama kustomer</th><th>tgl. order</th><th>jam</th><th>status</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM orders,kustomer WHERE orders.nik=kustomer.nik ORDER BY id_orders DESC LIMIT $posisi,$batas");
  
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_order]);
      echo "<tr><td align=center>$r[id_orders]</td>
                <td>$r[nama_lengkap]</td>
                <td>$tanggal</td>
                <td>$r[jam_order]</td>";
			
			if($r[status_order]=='Booking'){
				echo("<td style='background:#FF6600; color:#FFFFFF;'><b><a href=?module=order&act=$r[status_order]&id=$r[id_orders]><img src=images/booking.jpg>$r[status_order]</b></a></td>");
			}else if($r[status_order]=='Approve'){
				echo("<td style='background:#FFCC00; color:#FFFFFF;'><b><a href=?module=order&act=$r[status_order]&id=$r[id_orders]><img src=images/Approve_icon.jpg>$r[status_order]</b></a></td>");
			}else if($r[status_order]=='Pengambilan'){
				echo("<td style='background:#00CC00; color:#FFFFFF;'><b><a href=?module=order&act=$r[status_order]&id=$r[id_orders]><img src=images/ambil.jpg>$r[status_order]</b></a></td>");			
			}else if($r[status_order]=='Batal'){
				echo("<td style='background:#3366FF; color:#FFFFFF;'><b><a href=?module=order&act=$r[status_order]&id=$r[id_orders]><img src=images/batal.jpg>$r[status_order]</b></a></td>");
			}else{
				echo("<td style='background:#3366FF; color:#FFFFFF;'><b><a href=?module=order&act=$r[status_order]&id=$r[id_orders]><img src=images/batal.jpg>$r[status_order]</b></a></td>");
			}
			
	   //echo"<td><a href=?module=order&act=$r[status_order]&id=$r[id_orders]>Detail</a></td></tr>";
      $no++;
    }
    echo "</table>";
	
    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM orders"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
  
    
  case "Booking":
    $edit = mysql_query("SELECT * FROM orders,kustomer WHERE orders.nik=kustomer.nik AND id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tgl_order]);
    
    if ($r[status_order]=='Booking'){
        $pilihan_status = array('Approve', 'Batal');
    }
    elseif ($r[status_order]=='Approve'){
        $pilihan_status = array('Pengambilan','Batal');    
    }
    else if($r[status_order]=='Pengambilan'){
        $pilihan_status = array('Pengambilan');    
    }else if($r[status_order]=='Batal'){
        $pilihan_status = array('Batal');    
    }

    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2>Detail Order</h2>
          <form method=POST action=$aksi?module=order&act=update>
          <input type=hidden name=id value=$r[id_orders]>

          <table>
          <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam_order]</td></tr>		 
          <tr><td>Status Order      </td><td>: <select name=status_order>$pilihan_order</select> 
          <input type=submit value='Ubah Status'><input type=button value=Kembali onclick=self.history.back()></td></tr>
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk,orders 
                     WHERE orders_detail.id_produk=produk.id_produk and orders.id_orders=orders_detail.id_orders 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table border=0 width=500>
        <tr><th>Nama Produk</th><th>Use For</th><th>Berat(kg)</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
   $disc        = ($s[diskon]/100)*$s[harga];
   $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
   $subtotal    = ($s[harga]-$disc) * $s[jumlah];

    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s[harga]);
	$totalbarang   = $totalbarang + $s[jumlah];

   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

    echo "<tr><td>$s[merk]</td><td>$s[use_for]</td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td>
              <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";
  }

  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,kustomer,orders 
          WHERE kustomer.id_kota=kota.id_kota AND orders.nik=kustomer.nik AND id_orders='$_GET[id]'"));
  $ongkoskirim1=$ongkos[ongkos_kirim];
  $ongkoskirim=$ongkoskirim1 * $totalberat;

  $grandtotal    = $total + $ongkoskirim; 

  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp  = format_rupiah($grandtotal);    

echo "<tr><td colspan=5 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=5 align=right>Total Barang            : </td><td align=right><b>$totalbarang</b></td></tr>       
      <tr><td colspan=5 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>       
      <tr><td colspan=5 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table border=0 width=500>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama Kustomer</td><td> : $r[nama_lengkap]</td></tr>
        <tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
        </table>";

    break; 
	
	
	//status approve
	case "Approve":
	 		$edit = mysql_query("SELECT * FROM orders,kustomer WHERE orders.nik=kustomer.nik AND id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tgl_order]);
    
    if ($r[status_order]=='Booking'){
        $pilihan_status = array('Approve', 'Batal');
    }
    elseif ($r[status_order]=='Approve'){
        $pilihan_status = array('Pengambilan','Batal');    
    }
    else if($r[status_order]=='Pengambilan'){
        $pilihan_status = array('Pengambilan');    
    }else if($r[status_order]=='Batal'){
        $pilihan_status = array('Batal');    
    }

    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2>Detail Order</h2>
          <form method=POST action=$aksi?module=order&act=ambil enctype='multipart/form-data'>
          <input type=hidden name=id value=$r[id_orders]>

          <table>
          <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam_order]</td></tr>
		  <tr><td>PIC Penerima Barang</td> <td> : <input type=text name=penerima size=35></td></tr>
		  <tr><td>PIC Yang Menyerahkan Barang</td> <td> : <input type=text name=penyerah_barang size=35></td></tr>
		  <tr><td>Id Wo</td> <td> : <input type=text name=id_wo size=30></td></tr>
		  <tr><td>Bukti Serah Terima Barang</td><td> : <input type=file name='fupload' size=40></td></tr> 
		   <tr><td>Kode AWB</td> <td> : <input type=text name=kode_awb size=30></td></tr>
		  <tr><td>Bukti AWB</td><td> :  <input type=file name='file_awb' size=40></td></tr> 
          <tr><td>Status Order  </td><td >: <select name=status_order readonly=true>$pilihan_order</select> 
          <input type=submit value='Submit'><input type=button value=Kembali onclick=self.history.back()></td></tr>
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk ,orders
                     WHERE orders_detail.id_produk=produk.id_produk and orders.id_orders=orders_detail.id_orders 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table border=0 width=500>
        <tr><th>Nama Produk</th><th>Use For</th><th>Berat(kg)</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
   $disc        = ($s[diskon]/100)*$s[harga];
   $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
   $subtotal    = ($s[harga]-$disc) * $s[jumlah];

    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s[harga]);
	$totalbarang   = $totalbarang + $s[jumlah];

   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

    echo "<tr><td>$s[merk]</td><td>$s[use_for]</td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td>
              <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";
  }

  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kustomer,orders 
          WHERE orders.nik=kustomer.nik AND id_orders='$_GET[id]'"));
  $ongkoskirim1=$ongkos[ongkos_kirim];
  $ongkoskirim=$ongkoskirim1 * $totalberat;

  $grandtotal    = $total + $ongkoskirim; 
  
  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp  = format_rupiah($grandtotal);    

echo "<tr><td colspan=5 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>    
	  <tr><td colspan=5 align=right>Total Barang            : </td><td align=right><b>$totalbarang</b></td></tr>      
      <tr><td colspan=5 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>       
      <tr><td colspan=5 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table border=0 width=500>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama Kustomer</td><td> : $r[nama_lengkap]</td></tr>
        <tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
        </table>";
	 break;
	 
	 //status BATAL
	 case "Batal":
		$edit = mysql_query("SELECT * FROM orders,kustomer WHERE orders.nik=kustomer.nik AND id_orders='$_GET[id]'");
		$r    = mysql_fetch_array($edit);
		$tanggal=tgl_indo($r[tgl_order]);
		
		$tanggalbatal=tgl_indo($r[tgl_pembatalan]);
		
		
	   $pilihan_status = array('Batal'); 
	
		$pilihan_status = array('Batal');
		$pilihan_order = '';
		foreach ($pilihan_status as $status) {
		   $pilihan_order .= "<option value=$status";
		   if ($status == $r[status_order]) {
				$pilihan_order .= " selected";
		   }
		   $pilihan_order .= ">$status</option>\r\n";
		}
	
		echo "<h2>Detail Order</h2>
			  <input type=hidden name=id value=$r[id_orders]>
	
			  <table>
			  <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
			  <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam_order]</td></tr>
			  <tr><td>Tgl. & Jam Pembatalan</td> <td> : $tanggalbatal & $r[jam_pembatalan]</td></tr>
			  <tr><td>Status Order      </td><td>: <select name=status_order readonly=true>$pilihan_order</select> 
			  <input type=button value=Kembali onclick=self.history.back()></td></tr>
			  </table>";
	
	  // tampilkan rincian produk yang di order
	  $sql2=mysql_query("SELECT * FROM orders_detail, produk ,orders
						 WHERE orders_detail.id_produk=produk.id_produk and orders.id_orders=orders_detail.id_orders 
						 AND orders_detail.id_orders='$_GET[id]'");
	  
	  echo "<table border=0 width=500>
			<tr><th>Nama Produk</th><th>Use For</th><th>Berat(kg)</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
	  
	  while($s=mysql_fetch_array($sql2)){
		 // rumus untuk menghitung subtotal dan total		
	   $disc        = ($s[diskon]/100)*$s[harga];
	   $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
	   $subtotal    = ($s[harga]-$disc) * $s[jumlah];
	
		$total       = $total + $subtotal;
		$subtotal_rp = format_rupiah($subtotal);    
		$total_rp    = format_rupiah($total);    
		$harga       = format_rupiah($s[harga]);
		$totalbarang   = $totalbarang + $s[jumlah];
	
	   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
	   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
	
		echo "<tr><td>$s[merk]</td><td>$s[use_for]</td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td>
				  <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";
	  }
	
	  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,kustomer,orders 
			  WHERE kustomer.id_kota=kota.id_kota AND orders.nik=kustomer.nik AND id_orders='$_GET[id]'"));
	  $ongkoskirim1=$ongkos[ongkos_kirim];
	  $ongkoskirim=$ongkoskirim1 * $totalberat;
	
	  $grandtotal    = $total + $ongkoskirim; 
	
	  $ongkoskirim_rp = format_rupiah($ongkoskirim);
	  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
	  $grandtotal_rp  = format_rupiah($grandtotal);    
	
	echo "<tr><td colspan=5 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>
		  <tr><td colspan=5 align=right>Total Barang            : </td><td align=right><b>$totalbarang</b></td></tr>       
		  <tr><td colspan=5 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>       
		  <tr><td colspan=5 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>
		  </table>";
	
	  // tampilkan data kustomer
	  echo "<table border=0 width=500>
			<tr><th colspan=2>Data Kustomer</th></tr>
			<tr><td>Nama Kustomer</td><td> : $r[nama_lengkap]</td></tr>
			<tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
			<tr><td>Email</td><td> : $r[email]</td></tr>
			</table>";
	
		break; 
		
		//status Pengambilan
	case "Pengambilan":
				$edit = mysql_query("SELECT * FROM orders,kustomer WHERE orders.nik=kustomer.nik AND id_orders='$_GET[id]'");
		$r    = mysql_fetch_array($edit);
		$tanggal=tgl_indo($r[tgl_order]);
		
		if ($r[status_order]=='Booking'){
			$pilihan_status = array('Approve', 'Batal');
		}
		elseif ($r[status_order]=='Approve'){
			$pilihan_status = array('Pengambilan','Batal');    
		}
		else if($r[status_order]=='Pengambilan'){
			$pilihan_status = array('Sudah Diambil');    
		}else if($r[status_order]=='Batal'){
			$pilihan_status = array('Batal');    
		}
	
		$pilihan_order = '';
		foreach ($pilihan_status as $status) {
		   $pilihan_order .= "<option value=$status";
		   if ($status == $r[status_order]) {
				$pilihan_order .= " selected";
		   }
		   $pilihan_order .= ">$status</option>\r\n";
		}
	
		echo "<h2>Detail Order</h2>
			  <input type=hidden name=id value=$r[id_orders]>
	
			  <table>
			  <tr><td>No. Order</td>        <td> : $r[id_orders]</td></tr>
			  <tr><td>Tgl. & Jam Order</td> <td> : $tanggal & $r[jam_order]</td></tr>
			  <tr><td>PIC Penerima Barang</td> <td> : $r[pic_penerima]</td></tr>
			  <tr><td>PIC Yang Menyerahkan Barang</td> <td> : $r[pic_penyerah_barang]</td></tr>
			  <tr><td>Kode Wo</td> <td> : $r[id_wo]</td></tr>
			  <tr><td>Bukti Serah Terima Barang</td> <td> : <a href='../downlot.php?file=$r[nama_file]'>$r[nama_file]</a></td></tr>
			  <tr><td>Kode AWB</td> <td> : $r[kode_awb]</td></tr>
			  <tr><td>Bukti File AWB</td> <td> : <a href='../downlot.php?file=$r[file_awb]'>$r[file_awb]</a></td></tr>
			  <tr><td>Status Order      </td><td >: <select name=status_order readonly=true>$pilihan_order</select> 
			  <input type=button value=Kembali onclick=self.history.back()></td></tr>
			  </table>";
	
	  // tampilkan rincian produk yang di order
	  $sql2=mysql_query("SELECT * FROM orders_detail, produk ,orders
						 WHERE orders_detail.id_produk=produk.id_produk and orders.id_orders=orders_detail.id_orders 
						 AND orders_detail.id_orders='$_GET[id]'");
	  
	  echo "<table border=0 width=500>
			<tr><th>Nama Produk</th><th>Use For</th><th>Berat(kg)</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
	  
	  while($s=mysql_fetch_array($sql2)){
		 // rumus untuk menghitung subtotal dan total		
	   $disc        = ($s[diskon]/100)*$s[harga];
	   $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
	   $subtotal    = ($s[harga]-$disc) * $s[jumlah];
	
		$total       = $total + $subtotal;
		$subtotal_rp = format_rupiah($subtotal);    
		$total_rp    = format_rupiah($total);    
		$harga       = format_rupiah($s[harga]);
		$totalbarang   = $totalbarang + $s[jumlah];
	
	   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
	   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
	
		echo "<tr><td>$s[merk]</td><td>$s[use_for]</td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td>
				  <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";
	  }
	
	  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kustomer,orders 
			  WHERE orders.nik=kustomer.nik AND id_orders='$_GET[id]'"));
	  $ongkoskirim1=$ongkos[ongkos_kirim];
	  $ongkoskirim=$ongkoskirim1 * $totalberat;
	
	  $grandtotal    = $total + $ongkoskirim; 
	  
	  $ongkoskirim_rp = format_rupiah($ongkoskirim);
	  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
	  $grandtotal_rp  = format_rupiah($grandtotal);    
	
	echo "<tr><td colspan=5 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>    
		  <tr><td colspan=5 align=right>Total Barang            : </td><td align=right><b>$totalbarang</b></td></tr>      
		  <tr><td colspan=5 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>       
		  <tr><td colspan=5 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>
		  </table>";
	
	  // tampilkan data kustomer
	  echo "<table border=0 width=500>
			<tr><th colspan=2>Data Kustomer</th></tr>
			<tr><td>Nama Kustomer</td><td> : $r[nama_lengkap]</td></tr>
			<tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
			<tr><td>Email</td><td> : $r[email]</td></tr>
			</table>";
	 break;
	 
}
}
?>
