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
$aksi="modul/mod_sub_kategori/aksi_sub_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2>Sub Kategori</h2>
			<form method=POST action=media.php?module=subkategori>
					<div>Pencarian : <input type=text name=cari id=txtcari value='".$cari."'  size=40 />
					<input type=submit value=Cari ></div><hr>
		    </form>
          <input type=button value='Tambah Sub Kategori' 
          onclick=\"window.location.href='?module=subkategori&act=tambahsubkategori';\">
          <table>
          <tr><th>no</th><th>nama kategori</th><th>nama sub kategori</th><th>aksi</th></tr>"; 
	$p      = new Paging;
    $batas  = 12;
    $posisi = $p->cariPosisi($batas);	
		  
    $tampil=mysql_query("SELECT * FROM sub_kategori RIGHT JOIN kategori on kategori.id_kategori=sub_kategori.id_kategori
						where kategori.nama_kategori LIKE '%$cari%' OR sub_kategori.nama_sub_kategori LIKE '%$cari%'  
						ORDER BY id_sub_kategori DESC LIMIT $posisi,$batas");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
	   		 <td>$r[nama_kategori]</td>
             <td>$r[nama_sub_kategori]</td>
             <td><a href=?module=subkategori&act=editsubkategori&id=$r[id_sub_kategori]>Edit</a> | 
	               <a href=$aksi?module=subkategori&act=hapus&id=$r[id_sub_kategori]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
	 	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM sub_kategori RIGHT JOIN kategori on kategori.id_kategori=sub_kategori.id_kategori
										where kategori.nama_kategori LIKE '%$cari%' OR sub_kategori.nama_sub_kategori LIKE '%$cari%' "));
		$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		$linkHalaman = $p->navHalamanProdukKategori($_GET[halaman], $jmlhalaman,$cari);
	
		echo "<div id=paging>Hal: $linkHalaman</div><br>";	
    break;
  
  // Form Tambah Kategori
  case "tambahsubkategori":
    echo "<h2>Tambah Sub Kategori</h2>
          <form method=POST action='$aksi?module=subkategori&act=input'>
          <table>
          <tr><td>Nama Sub Kategori</td><td> : <input type=text name='nama_sub_kategori'></td></tr>
		  <tr><td> Kategori </td><td> : 
		  <select name='kategori'>
            <option value=0 selected>- Pilih Kategori -</option>";
			$tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
			
         echo "</select></td></tr> <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "editsubkategori":
    $edit=mysql_query("SELECT * FROM sub_kategori WHERE id_sub_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Sub Kategori</h2>
          <form method=POST action=$aksi?module=subkategori&act=update>
          <input type=hidden name=id value='$r[id_sub_kategori]'>
          <table>
          <tr><td>Nama Sub Kategori</td><td> : <input type=text name='nama_sub_kategori' value='$r[nama_sub_kategori]'></td></tr>
		  <tr><td>Kategori</td>  <td> : <select name='kategori'>";
		  $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
		  
          echo "</select></td></tr><tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
