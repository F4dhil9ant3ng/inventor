<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_user/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
      $tampil = mysql_query("SELECT * FROM kustomer");
      echo "<h2>User</h2>
          <input type=button value='Tambah User' onclick=\"window.location.href='?module=user&act=tambahuser';\">";
   
    echo "<table>
          <tr><th>no</th><th>NIK</th><th>nama lengkap</th><th>email</th><th>No.Telp/HP</th><th>Divisi</th><th>Unit Kerja</th><th>Lokasi Kerja</th><th>aksi</th></tr>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nik]</td>
             <td>$r[nama_lengkap]</td>
		     <td><a href=mailto:$r[email]>$r[email]</a></td>
		     <td>$r[telpon]</td>
		     <td align=center>$r[divisi]</td>
			 <td>$r[unit_kerja_lantai]</td>
			 <td>$r[lokasi_kerja]</td>
             <td><a href=?module=user&act=edituser&id=$r[nik]>Edit</a>
			 	| <a href=$aksi?module=user&act=hapususer&id=$r[nik]>Hapus</a>
			 </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  case "tambahuser":
    if ($_SESSION[leveluser]=='admin'){
    echo "<h2>Tambah User</h2>
          <form method=POST action='$aksi?module=user&act=input'>
          <table>
		  <tr><td>NIK</td>     <td> : <input type=text name='nik'></td></tr>	  
          <tr><td>Password</td>     <td> : <input type=text name='password'></td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30></td></tr>
		  <tr><td>Divisi</td> <td> : <input type=text name='divisi' size=30></td></tr>  
		  <tr><td>Unit Kerja</td> <td> : <input type=text name='unit_kerja_lantai' size=30></td></tr>
		  <tr><td>Lokasi Kerja</td> <td> : <input type=text name='lokasi_kerja' size=30></td></tr>
		  <tr><td>No.Telp/HP</td>   <td> : <input type=text name='telpon' size=20></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30></td></tr> 
		  <tr><td>Nama Manajer</td>       <td> : <input type=text name='nama_manajer' size=30></td></tr>         
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    }   
     break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM kustomer WHERE nik='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "<h2>Edit User</h2>
          <form method=POST action=$aksi?module=user&act=update>
          <input type=hidden name=id value='$r[nik]'>
          <table>		  
		  <tr><td>NIK</td>     <td> : <input type=text name='nik' value='$r[nik]' disabled> **)></td></tr>	  
          <tr><td>Password</td>     <td> : <input type=text name='password'> *)></td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
		  <tr><td>Divisi</td> <td> : <input type=text name='divisi' value='$r[divisi]' size=30></td></tr>  
		  <tr><td>Unit Kerja</td> <td> : <input type=text name='unit_kerja_lantai' size=30  value='$r[unit_kerja_lantai]' size=30></td></tr>
		  <tr><td>Lokasi Kerja</td> <td> : <input type=text name='lokasi_kerja' size=30  value='$r[lokasi_kerja]' size=30></td></tr>
		  <tr><td>No.Telp/HP</td>   <td> : <input type=text name='telpon' value='$r[telpon]' size=20></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' value='$r[email]' size=30></td></tr> 
		  <tr><td>Nama Manajer</td> <td> : <input type=text name='nama_manajer' value='$r[nama_manajer]'size=30></td></tr>         
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>";    
    echo "<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";     
   
    break;  
}
}
?>
