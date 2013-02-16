<?php 
  error_reporting(0);
  session_start();	
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php include "dina_titel.php"; ?></title>
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php include "dina_meta1.php"; ?>">
<meta name="keywords" content="<?php include "dina_meta2.php"; ?>">
<meta http-equiv="Copyright" content="inventory">
<meta name="author" content="Nur Iskandar">
<meta http-equiv="imagetoolbar" content="no">
<meta name="language" content="Indonesia">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="rating" content="general">
<meta name="spiders" content="all">

<link rel="shortcut icon" href="favicon.ico" />

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="lightbox/themes/default/jquery.lightbox.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jquery-1.4.js"></script>
<script type="text/javascript" src="lightbox/jquery.lightbox.min.js"></script>
<script type="text/javascript" src="ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.lightbox').lightbox();		    
		});
  </script>


</head>

<body>
<div id="main_container">
	<div class="top_bar">
    	<div class="top_search">
        	<div class="search_text">Cari Perangkat</div>
        	<form method="POST" action="hasil-pencarian.html">
            <input class="search_input" name="kata" type="text">
            <input src="images/search.gif" class="search_bt" type="image">
          </form>
      </div>            
  </div>
  
	<div id="header"></div>

  <div id="main_content"> 
       <div id="menu_tab">
            <div class="left_menu_corner"></div>
              <ul class="menu">
		           <li><a href="index.php" class="nav1">Home</a></li>
                <li class="divider"></li>
		            <li><a href="profil-kami.html" class="nav2">Profil</a></li>
                <li class="divider"></li>
		            <li><a href="cara-order.html" class="nav3">Cara Order</a></li>
                <li class="divider"></li>
		            <li><a href="semua-produk.html" class="nav4">Semua Perangkat</a></li>
                <li class="divider"></li>
		            <li><a href="proses-order.html" class="nav5">Keranjang Order Perangkat</a></li>                
				<li class="divider"></li>
		            <li><a href="download-katalog.html" class="nav4">Download Katalog</a></li>
                <li class="divider"></li>
				<?php 
					if(isset($_SESSION['nik']) && !empty($_SESSION['nik'])){
				?>
					
		            <li><a href="logout.php" class="nav7">Log Out</a></li>
                	<li class="divider"></li>
				<?php } ?>
		          <!--  <li><a href="hubungi-kami.html" class="nav6">Hubungi Kami</a></li>        
                <li class="divider"></li>-->
              </ul>
            <div class="right_menu_corner"></div>
          </div><!-- end of menu tab -->

  <div class="crumb_navigation">
    Anda sedang berada di: <?php include "breadcrumb.php";?>
  </div> 
         
        
  <div class="left_content"> 
      <?php include "kiri.php";?>         
  </div>
   
   <div class="center_content">
      <?php include "tengah.php";?>           
   </div>
   
   <div class="right_content">
      <?php include "kanan.php";?>                
   </div><!-- end of right content -->   
            
   </div><!-- end of main content -->
   
   <div class="footer">
        <div class="left_footer">
        <img src="images/banner2.jpg" alt="" title="" width="100" height="49">
        </div>
        
        <div class="center_footer">
        Copyright &copy; 2013. All Rights Reserved.<br />
        <a href="http://www.katalaya.sytes.net/" target="blank" title="webmaster">inventory</a><br />
        </div>
        
        <div class="right_footer">
        <a href="index.php">home</a>
        <a href="profil-kami.html">about</a>
        <a href="cara-order.html">cara order</a>
        <a href="semua-produk.html">semua perangkat</a>
        <!--<a href="hubungi-kami.html">hubungi kami</a>-->
        </div>   
   </div>                 

</div>
<!-- end of main_container -->
<div style="visibility: hidden; position: absolute;"><div></div></div>
</body>
</html>
