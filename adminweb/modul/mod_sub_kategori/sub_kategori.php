<?php
$aksi="modul/mod_sub_kategori/aksi_sub_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2>Sub Kategori</h2>
          <input type=button value='Tambah Sub Kategori' 
          onclick=\"window.location.href='?module=subkategori&act=tambahsubkategori';\">
          <table>
          <tr><th>no</th><th>nama kategori</th><th>nama sub kategori</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM sub_kategori,kategori where sub_kategori.id_kategori=kategori.id_kategori ORDER BY id_sub_kategori DESC");
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
?>
