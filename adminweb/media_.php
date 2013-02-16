<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<html>
<head>
<title>Administrator CMS Lokomedia</title>
  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
  <script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>
  <script type="text/javascript" src="JS/jquery-1.4.js"></script>
	<script type="text/javascript" src="JS/jquery.fusioncharts.js"></script>

<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
	<div id="menu">
      <ul>
        <li><a href=?module=home>&#187; Home</a></li>
        <?php include "menu.php"; ?>
        <li><a href=logout.php>&#187; Logout</a></li>
      </ul>
	    <p>&nbsp;</p>
 	</div>

  <div id="content">
		<?php include "content.php"; ?>
  </div>
  
		<div id="footer">
			Copyright &copy; 2009 by CMS Lokomedia. All rights reserved.
		</div>
</div>
</body>
</html>
<?php
}
}
?>
