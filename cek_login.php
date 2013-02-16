<?php
include "../config/koneksi.php";
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$username = antiinjection($_POST['nik']);
$pass     = antiinjection(md5($_POST['password']));

$login=mysql_query("SELECT * FROM kustomer WHERE nik='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  session_register("nik");
  session_register("nama_lengkap");
  session_register("password");
  session_register("id");

  $_SESSION[nik]     = $r[nik];
  $_SESSION[nama_lengkap]  = $r[nama_lengkap];
  $_SESSION[password]     = $r[password];
  $_SESSION[leveluser]    = $r[id];
  
  header('location:media.php?module=home');
}
else{
  echo "<link href=../config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center>LOGIN GAGAL! <br> 
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
}
?>
