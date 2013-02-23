<?php
session_start();
   
   $req = $_SERVER['REQUEST_METHOD'];
	if($req=='POST'){
		$cari=$_POST['cari'];
	}else{
		$cari=$_GET['cari'];
	}
	
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
  // Tampil Produk
  
  default:
    $id_kategori=$_GET[id];
	$id_sub_kategori=$_GET[idsub];
	if($id_sub_kategori!=null){
		$produkname = mysql_query("SELECT * FROM sub_kategori where id_sub_kategori='".$id_sub_kategori."'");
	}else{
		$produkname = mysql_query("SELECT * FROM kategori where id_kategori='".$id_kategori."'");
	}
	
  	$name=mysql_fetch_array($produkname);
	
	if($id_kategori!=null || $id_kategori>0){  
    	  echo "<h2>$name[nama_kategori]</h2>";
		  
         /* echo"<input type=button value='Tambah Produk' onclick=\"window.location.href='?module=produk&act=tambahproduk';\">"*/
		  
		  echo("<form method=POST action=media.php?module=produk>
					<div>Pencarian : <input type=text name=cari id=txtcari value='".$cari."'  size=40 />
					<input type=submit value=Cari ></div><hr>
		  		</form>");
          echo "<table>
          <tr><th>no</th><th>nama produk</th><th>Kategori</th><th>Sub Kategori</th><th>Serial Number</th><th>No Po</th><th>stok</th><th>tgl. masuk</th><th>aksi</th></tr>";
	}else if ($id_sub_kategori!=null || $id_sub_kategori>0){
		echo "<h2>$name[nama_sub_kategori]</h2>
				<form method=POST >
					<div>Pencarian : <input type=text name=cari id=txtcari value='".$cari."'  size=40 />
					<input type=submit value=Cari onclick=\"window.location.href='?module=produk&id='".$id_kategori."';\"/></div><hr>
		  		</form>
          <input type=button value='Tambah Produk' onclick=\"window.location.href='?module=produk&act=tambahproduk&id_sub=$id_sub_kategori';\">
          <table>
         <tr><th>no</th><th>nama produk</th><th>Kategori</th><th>Sub Kategori</th><th>Serial Number</th><th>No Po</th><th>stok</th><th>tgl. masuk</th><th>aksi</th></tr>";
	}else{
		 echo "<h2>Perangkat</h2>";
		echo "<form method=POST >
					<div>Pencarian : <input type=text name=cari id=txtcari value='".$cari."'  size=40 />
					<input type=submit value=Cari onclick=\"window.location.href='?module=produk&id='".$id_kategori."';\"/></div><hr>
		  		</form>
          <table>
          <tr><th>no</th><th>nama produk</th><th>Kategori</th><th>Sub Kategori</th><th>Serial Number</th><th>No Po</th><th>stok</th><th>tgl. masuk</th><th>aksi</th></tr>";
	}
	
    $p      = new Paging;
    $batas  = 12;
    $posisi = $p->cariPosisi($batas);	
	
	if($id_kategori!=null || $id_kategori>0){  
	      $tampil=mysql_query("select * from kategori k,sub_kategori sk, produk p where k.id_kategori='".$id_kategori."' 
		  						and  sk.id_sub_kategori=p.id_kategori and sk.id_kategori=k.id_kategori AND 
								 (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
							     OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%') 
								ORDER BY id_produk DESC LIMIT $posisi,$batas");
	}else if ($id_sub_kategori!=null || $id_sub_kategori>0){
		$tampil = mysql_query("SELECT *		                              
								 FROM produk,kategori,sub_kategori
								 where kategori.id_kategori=sub_kategori.id_kategori AND 
								 sub_kategori.id_sub_kategori=produk.id_kategori AND produk.id_kategori='".$id_sub_kategori."' AND 
								 (produk.merk LIKE '%$cari%' OR kategori.nama_kategori LIKE '%$cari%' OR sub_kategori.nama_sub_kategori LIKE '%$cari%'
							     OR produk.serial_number LIKE '%$cari%' OR produk.no_po LIKE '%$cari%' OR produk.stok LIKE '%$cari%')
								 ORDER BY produk.id_produk DESC LIMIT $posisi,$batas");
	}else {
		$tampil = mysql_query("SELECT *		                              
								 FROM produk,kategori,sub_kategori
								 where kategori.id_kategori=sub_kategori.id_kategori AND 
								 sub_kategori.id_sub_kategori=produk.id_kategori AND 
								 (produk.merk LIKE '%$cari%' OR kategori.nama_kategori LIKE '%$cari%' OR sub_kategori.nama_sub_kategori LIKE '%$cari%'
							     OR produk.serial_number LIKE '%$cari%' OR produk.no_po LIKE '%$cari%' OR produk.stok LIKE '%$cari%')
								 ORDER BY produk.id_produk DESC LIMIT $posisi,$batas");
	}	
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_masuk]);
      $harga=format_rupiah($r[harga]);	  
      echo "<tr><td>$no</td>
                <td>$r[merk]</td>
				<td>$r[nama_kategori]</td>
				<td>$r[nama_sub_kategori]</td>
				<td>$r[serial_number]</td>
                <td>$r[no_po]</td>
                <td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=produk&act=editproduk&id=$r[id_produk]>Edit</a> | 
		                <a href='$aksi?module=produk&act=hapus&id=$r[id_produk]&namafile=$r[gambar]'>Hapus</a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM produk"));
	if($id_kategori!=null || $id_kategori>0){  
		//mencari banyaknya data
	       $jmldata = mysql_num_rows(mysql_query("select p.id_produk  
							   from kategori k,sub_kategori sk, produk p 
							   where k.id_kategori='".$id_kategori."' and  sk.id_sub_kategori=p.id_kategori and sk.id_kategori=k.id_kategori
							   AND (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
							     OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%')ORDER BY id_produk DESC"));
		// mennghitung total barang dan stok barang
		$totalinventory=mysql_fetch_array(mysql_query("select sum(p.stok) as stokbarang,count(p.id_produk) as totalbarang from kategori k,sub_kategori sk, produk p
								 where k.id_kategori='".$id_kategori."' and  sk.id_sub_kategori=p.id_kategori and sk.id_kategori=k.id_kategori AND 
								 (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
							     OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%')"));
		
		 $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
   		 $linkHalaman = $p->navHalamanProdukKategori($_GET[halaman], $jmlhalaman,$cari);					   
	}else if ($id_sub_kategori!=null || $id_sub_kategori>0){
		 $jmldata = mysql_num_rows(mysql_query("SELECT p.id_produk                             
								 FROM kategori k,sub_kategori sk, produk p  where p.id_kategori='".$id_sub_kategori."' and 
								 sk.id_sub_kategori=p.id_kategori and sk.id_kategori=k.id_kategori AND 
								 (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
							     OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%') ORDER BY p.id_produk DESC"));
								 
		//menghitung jumlah barang
		$totalinventory=mysql_fetch_array(mysql_query("select sum(p.stok) as stokbarang,count(p.id_produk) as totalbarang
													   FROM kategori k,sub_kategori sk, produk p  where p.id_kategori='".$id_sub_kategori."'  
													   and  sk.id_sub_kategori=p.id_kategori and sk.id_kategori=k.id_kategori AND 
													 (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
													 OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%')"));		
		 $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    	  $linkHalaman = $p->navHalamanProdukSubKategori($_GET[halaman], $jmlhalaman,$cari);										   			   						 
	}	else {
		 $jmldata = mysql_num_rows(mysql_query("SELECT p.id_produk                             
								 FROM produk p,kategori k,sub_kategori sk
													 where k.id_kategori=sk.id_kategori AND 
													 sk.id_sub_kategori=p.id_kategori AND 
													 (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
													 OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%') ORDER BY p.id_produk DESC"));
								 
		//menghitung jumlah barang
		$totalinventory=mysql_fetch_array(mysql_query("select sum(p.stok) as stokbarang,count(p.id_produk) as totalbarang
													  FROM produk p,kategori k,sub_kategori sk
													 where k.id_kategori=sk.id_kategori AND 
													 sk.id_sub_kategori=p.id_kategori AND 
													 (p.merk LIKE '%$cari%' OR k.nama_kategori LIKE '%$cari%' OR sk.nama_sub_kategori LIKE '%$cari%'
													 OR p.serial_number LIKE '%$cari%' OR p.no_po LIKE '%$cari%' OR p.stok LIKE '%$cari%')"));		
		 $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    	 $linkHalaman = $p->navHalamanProdukKategori($_GET[halaman], $jmlhalaman,$cari);											   			   						 
	}	
	
    echo("\nJumlah Total Barang : ".$totalinventory[totalbarang]."<br>");
	echo("\nJumlah Total Stok Barang : ".$totalinventory[stokbarang]);
    echo "<div id=paging>Hal: $linkHalaman</div><br>";
    break;
      
  case "tambahproduk":
  		 $id_sub=$_GET[id_sub];
		 $tampil=mysql_query("SELECT * FROM sub_kategori,kategori where sub_kategori.id_kategori=kategori.id_kategori AND sub_kategori.id_sub_kategori='".$id_sub."'ORDER BY sub_kategori.nama_sub_kategori");
		 $r=mysql_fetch_array($tampil);
		 
    echo "<h2>Tambah Produk $r[nama_kategori]</h2>
          <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <table>
          <tr>
		  	<td width=100>Merk</td>  
			<td> : <input type=text name='merk' size=60></td>
		  </tr>
		  <tr>
		  	<td width=100>Model</td>  
			<td> : <input type=text name='model' size=60></td>
		  </tr>
		  <tr>
		  	<td width=100>Jenis</td>    
			<td> : <input type=text name='jenis' size=60></td>
		  </tr>
		  <tr>
		  	<td width=100>Vendor</td>    
			<td> : <input type=text name='vendor' size=60></td>
		  </tr>
		  <tr>
		  	<td width=100>Lokasi Rak</td>    
			<td> : <input type=text name='warehouse_location' size=60></td>
		  </tr>
		  <tr>
		  	<td width=100>No Po </td>    
			<td> : <input type=text name='no_po' size=60></td>
		  </tr>
		  <tr>
		  	<td width=100>Serial Number</td>    
			<td> : <input type=text name='serial_number' size=60></td>
		  </tr>		   
          <tr>
		  	<td>Sub Kategori</td>  <td> : 
          <select name='kategori'>";
              echo "<option value=$r[id_sub_kategori]>$r[nama_sub_kategori]</option>";
    echo "</select></td></tr>      
		  <tr><td>Berat</td>     <td> : <input type=text name='berat' size=3 value=0> KG</td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' size=10 value=0></td></tr> 
          <tr><td>Stok</td>     <td> : <input type=text name='stok' size=3 value=0></td></tr>
		  <tr><td>Buffer</td>     <td> : <input type=text name='buffer' size=3 value=0> %</td></tr>
          <tr><td>Spesification</td>  <td> <textarea name='spesification' style='width: 580px; height: 350px;'></textarea></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editproduk":
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Produk</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
          <table>
          <tr><td width=70>Merk</td>     <td> : <input type=text name='merk' size=60 value='$r[merk]'></td></tr>
		  <tr><td width=70>Model</td>     <td> : <input type=text name='model' size=60 value='$r[model]'></td></tr>
		  <tr><td width=70>Jenis</td>     <td> : <input type=text name='jenis' size=60 value='$r[jenis]'></td></tr>
		  <tr><td width=70>Vendor</td>     <td> : <input type=text name='vendor' size=60 value='$r[vendor]'></td></tr>
		  <tr><td width=70>Lokasi Rak</td><td> : <input type=text name='warehouse_location' size=60 value='$r[warehouse_location]'></td></tr>
		  <tr><td width=70>No Po</td>     <td> : <input type=text name='no_po' size=60 value='$r[no_po]'></td></tr>
		  <tr><td width=70>Serial Number</td>     <td> : <input type=text name='serial_number' size=60 value='$r[serial_number]'></td></tr>
		  <tr><td>Kategori</td>  <td> : <select name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM sub_kategori ORDER BY nama_sub_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_sub_kategori]){
              echo "<option value=$w[id_sub_kategori] selected>$w[nama_sub_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_sub_kategori]>$w[nama_sub_kategori]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td>Berat</td>     <td> : <input type=text name='berat' value=$r[berat] size=3> KG</td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' value=$r[harga] size=10></td></tr>
          <tr><td>Stok</td>     <td> : <input type=text name='stok' value=$r[stok] size=3></td></tr>
		  <tr><td>Buffer</td>     <td> : <input type=text name='buffer' value=$r[buffer] size=3>%</td></tr>
          <tr><td>Deskripsi</td>   <td> <textarea name='deskripsi' style='width: 600px; height: 350px;'>$r[deskripsi]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  
          <img src='../foto_produk/small_$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}
}
?>
<script type="text/javascript">
	$('#tabelku').convertToFusionCharts({
		swfPath: "Charts/",
		type: "MSColumn3DLineDY",
		data: "#tabelku",
		dataFormat: "HTMLYTable",
		width: "600"
	});
	</script>
