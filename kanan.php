	   <div class="shopping_cart">
        <div class="cart_title">Keranjang Order Perangkat</div>
        <div class="cart_details">
           <?php require_once "item.php";?>
        </div>    
        <div class="cart_icon"><img src="images/shoppingcart.png" alt="" title="" width="48" border="0" height="48">
        </div>        
      </div>	
	<?php 
		if(isset($_SESSION['nik']) && !empty($_SESSION['nik'])){
	?>
	 <div class="title_box">Selamat datang </div>
	 	<div class="border_box"><marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="2" direction="left" align="center">
		
		Anda Login Sebagai : <?php echo $_SESSION['nama_lengkap'];?></marquee>
			<a href='history-transaksi-member.html'><h3>History Order</h3></a>
		</div>
	  <?php } else{ ?>
	 <div class="title_box">Login Member</div>  
      <div class="border_box_login">
	  		<?php
				echo "<form name=form2 action=login.html method=POST onSubmit=\"return validasi2(this)\">
			  <table>
			  <tr><td>Nik</td>
			  	<td>:</td>
				<td><input type=text name=nik size=17></td>
			  </tr>
			  <tr>
			  	<td>Password</td>
				<td>:</td>
				<td><input type=password name=password size=17></td>
			 </tr>			  
			 <tr>
			   <td colspan=2><input type='submit' class='button' value='Login'></td>
			   <td align=right><a href='lupa-password.html'>Lupa Password?</a></td>
			 </tr>
			  </table>
			  </form>";
			?>
	  </div>	
	  <?php }?>
	  
      <div class="title_box">Admin Gudang</div>  
      <div class="border_box">

      <?php 
      //ym
      $ym=mysql_query("select * from mod_ym order by id desc");
      while($t=mysql_fetch_array($ym)){
        echo "<br /><p>&bull; $t[nama] 
              <a href='ymsgr:sendIM?$t[username]'>
              <img src='http://opi.yahoo.com/online?u=$t[username]&amp;m=g&amp;t=1' border='0' height='16' width='64'></a>
              </p><br />";
      }
      ?>
      </div>  	 
	 
	  <!--<div class="title_box">Statistik Kunjungan</div>  
     <div class="border_box">-->
<?php /*?><?php
  // Statistik user
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  // Kalau belum ada, simpan data user tersebut ke database
  if(mysql_num_rows($s) == 0){
    mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
  } 
  else{
    mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
  }

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));

  $path = "counter/";
  $ext = ".png";

  $tothitsgbr = sprintf("%06d", $tothitsgbr);
  for ( $i = 0; $i <= 9; $i++ ){
	   $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
  }

  echo "<br /><p align='left'>
      <img src='counter/hariini.png'> Pengunjung hari ini : $pengunjung <br />
      <img src='counter/total.png'> Total pengunjung    : $totalpengunjung <br /><br />
      <img src='counter/hariini.png'> Hits hari ini    : $hits[hitstoday] <br />
      <img src='counter/total.png'> Total Hits       : $totalhits <br /><br />
      <img src='counter/online.png'> Pengunjung Online: $pengunjungonline<br /><br /></p>
      <p align='center'>$tothitsgbr </p><br />";
?><?php */?>


	 <!--</div> -->	     
     
     <div class="banner_adds">

<?php
$banner=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 4");
while($b=mysql_fetch_array($banner)){
  echo "<p align='center'><a href='$b[url]'' target='_blank' title='$b[judul]'><img src='foto_banner/$b[gambar]' border=0></a></p>";
}

?>
     </div>        
