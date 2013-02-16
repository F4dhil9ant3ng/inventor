<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_stat/aksi_stat.php";
switch($_GET[act]){
  // Tampil Tag
  default:
    echo "<h2>Web Statistik</h2>	 
          <table id='tabelku'><tr><th>Tanggal</th> ";
	$tgl1=date("Y-m-d");
	$tgl_bawah = strtotime("-1 week +1 day",strtotime($tgl1));
	$hasil_tgl_bawah = date('Y-m-d', $tgl_bawah); 
    for ($i2=0; $i2 <= 6; $i2++){
      $urutan = strtotime("+$i2 day",strtotime($hasil_tgl_bawah));
      $hasil_urutan = date('Y-m-d', $urutan);      
      echo"<th>$hasil_urutan</th>";
      
    }

    echo "</tr><tr><td>Visitor</td>";
	$tgl2=date("Y-m-d");
	$tgl_bawah2 = strtotime("-1 week +1 day",strtotime($tgl2));
	$hasil_tgl_bawah2 = date('Y-m-d', $tgl_bawah2);
    for ($i=0; $i <= 6; $i++){
      $tgl_pengujung = strtotime("+$i day",strtotime($hasil_tgl_bawah2));
      $hasil_tgl_pengujung = date('Y-m-d', $tgl_pengujung);
      $sql_tgl_pengujung=mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$hasil_tgl_pengujung' GROUP BY ip"));
      echo"<td align='center'><font color='#afd8f8'><b>$sql_tgl_pengujung</td>";
      
    }
	echo "</tr><tr><td>Hits</td>";
	$tgl3=date("Y-m-d");
	$tgl_bawah3 = strtotime("-1 week +1 day",strtotime($tgl3));
	$hasil_tgl_bawah3 = date('Y-m-d', $tgl_bawah3);
    for ($i3=0; $i3 <= 6; $i3++){
      $tgl_hits = strtotime("+$i3 day",strtotime($hasil_tgl_bawah3));
      $hasil_tgl_hits = date('Y-m-d', $tgl_hits);
      $sql_hits=mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$hasil_tgl_hits' GROUP BY tanggal"));
      echo"<td align='center'><font color='#f6bd0f'><b>$sql_hits[hitstoday]</td>";
      
    }
	echo"</tr></table>";
	
	$pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tgl1' GROUP BY ip"));
  	$totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
    $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tgl1' GROUP BY tanggal")); 
    $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
    $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
    $bataswaktu       = time() - 300;

              echo "<br /><table>
			  		<tr><th colspan=2>Rangkuman Statistik</th></tr>
                    <tr><td class='news-title'> Pengunjung hari ini </td><td class='news-title'> : $pengunjung </td></tr>
                    <tr><td class='news-title'> Total pengunjung </td><td class='news-title'> : $totalpengunjung </td></tr>
                    <tr><td class='news-title'>Hits hari ini </td><td class='news-title'> : $hits[hitstoday] </td></tr>
                    <tr><td class='news-title'> Total Hits </td><td class='news-title'> : $totalhits </td></tr>
                    </table>"; 
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
	
<?php
    break;
  }
}
?>
