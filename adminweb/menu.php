<script type="text/javascript">



ddsmoothmenu.init({
	mainmenuid: "smoothmenu3", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<?php
include "../config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}
else{
  $sql=mysql_query("select * from modul where status='user' and aktif='Y' order by urutan"); 
} 
while ($m=mysql_fetch_array($sql)){  
  if($m[id_modul]==18){
  		echo('
		<li><a href="#">&#187;'.$m[nama_modul].'</a><ul>');
		  $sql2=mysql_query("select * from kategori");
		  while ($m2=mysql_fetch_array($sql2)){
		  		echo('<li><a href=?module=produk&id='.$m2[id_kategori].'>&#187;'.$m2[nama_kategori].'</a>
					<ul>');
						$sqlsub=mysql_query("select * from sub_kategori where sub_kategori.id_kategori='".$m2[id_kategori]."'");
		  				while ($msub=mysql_fetch_array($sqlsub)){			
					  		echo('<li><a href=?module=produk&idsub='.$msub[id_sub_kategori].'>'.$msub[nama_sub_kategori].'</a></li>');	
					  	}	
					echo('</ul>');
		  }
		   echo('</li>
		  </ul>
		</li> '); 	
  }	else if($m[id_modul]==52){
  		echo('
		<li><a href='.$m[link].'>&#187;'.$m[nama_modul].'</a><ul>');
  
  		echo('
				<li><a href=?module=laporanstokbarang>&#187; Laporan Stok Total Barang</a></a></li>
				<li><a href=?module=laporanbarangmasuk>&#187; Laporan barang Masuk</a></a></li>
				<li><a href=?module=laporanbarangkeluar>&#187; Laporan barang Keluar</a></a></li>
				<li><a href=?module=laporanbarangreturn>&#187; Laporan barang Return</a></a></li>
			 </ul></li>');
  }else{  	
  		echo '<li><a href='.$m[link].'>&#187;'.$m[nama_modul].'</a></li>'; 
  }
}
?>
