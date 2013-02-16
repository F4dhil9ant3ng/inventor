<?php
$aksi="modul/mod_ym/aksi_ym.php";
switch($_GET[act]){
  // Tampil YM
  default:
    echo "<h2>YM Status Module</h2>
          <input type=button value='Tambah YM' 
          onclick=\"window.location.href='?module=ym&act=tambahym';\">
          <table>
          <tr><th>no</th><th>nama</th><th>Username</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM mod_ym ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama]</td>
			 <td>$r[username]</td>
             <td><a href=?module=ym&act=editym&id=$r[id]>Edit</a> | 
	               <a href=$aksi?module=ym&act=hapus&id=$r[id]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
	
    break;
  
  // Form Tambah YM
  case "tambahym":
    echo "<h2>Tambah YM</h2>
          <form method=POST action='$aksi?module=ym&act=input'>
          <table>
          <tr><td>Nama</td><td> : <input type=text name='nama'></td></tr>
		  <tr><td>Username</td><td> : <input type=text name='username'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit YM  
  case "editym":
    $edit=mysql_query("SELECT * FROM mod_ym WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit YM</h2>
          <form method=POST action=$aksi?module=ym&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table>
          <tr><td>Nama</td><td> : <input type=text name='nama' value='$r[nama]'></td></tr>
		  <tr><td>Username</td><td> : <input type=text name='username' value='$r[username]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
