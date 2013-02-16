

<script type="text/javascript">

ddaccordion.init({
	headerclass: "headerbar", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>

<style type="text/css">

.urbangreymenu{
width: 194px; /*width of menu*/
}

.urbangreymenu .headerbar{
font:  12px "Lucida Grande", "Trebuchet MS", Verdana, Helvetica, sans-serif;
color: white;
display: block;
background: #F9A406 url(arrowstop.gif) no-repeat 8px 6px; /*last 2 values are the x and y coordinates of bullet image*/
margin-bottom: 0; /*bottom spacing between header and rest of content*/
padding: 7px 0 7px 31px; /*31px is left indentation of header text*/
width: auto;
text-decoration: none;
position: relative; /*To help in the anchoring of the ".statusicon" icon image*/
border:1;

}



.urbangreymenu .headerbar a{
text-decoration: none;
color: white;
display: block;
}

.urbangreymenu ul{
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 0; /*bottom spacing between each UL and rest of content*/
}

.urbangreymenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.urbangreymenu ul li a{
font: normal 12px Arial;
color: black;
background: #E9E9E9;
display: block;
padding: 5px 0;
line-height: 17px;
padding-left: 8px; /*link text is indented 8px*/
text-decoration: none;
}

.urbangreymenu ul li a:visited{
color: black;
}

.urbangreymenu ul li a:hover{ /*hover state CSS*/
color: white;
background: #CC9900;
}

</style>
	
	<div class="title_box">Kategori</div>
	<div class="border_box_kategori">
	<div class="urbangreymenu">
	<?php
		
            $kategori=mysql_query("select nama_kategori, kategori.id_kategori, kategori_seo,  
                                  count(produk.id_produk) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
            $no=1;
            while($k=mysql_fetch_array($kategori)){
				echo("<div class=headerbar ><a href='kategori-$k[id_kategori]-$k[kategori_seo].html'>$k[nama_kategori]</a></div>");
				$subkategori=mysql_query("select sub_kategori.id_sub_kategori,sub_kategori.nama_sub_kategori, 
                                 count(produk.id_produk) as jumlah 
                                 from sub_kategori left join produk 
                                 on produk.id_kategori=sub_kategori.id_sub_kategori											  
                                 where sub_kategori.id_kategori=$k[id_kategori]									  
                                 		 group by sub_kategori.nama_sub_kategori");
					echo("<ul class=submenu>");
					while($skk=mysql_fetch_array($subkategori)){
						echo("
								<li><a href='subkategori-$skk[id_sub_kategori]-$skk[nama_sub_kategori].html'>$skk[nama_sub_kategori]</a></li>");
						}
						echo("</ul>");
			}
	?>		
	 </div>
     </div>      
		   
    <div class="title_box">Perangkat Fast Moving</div>  
     <div class="border_box">
      <?php
      $best=mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 5");
      while($a=mysql_fetch_array($best)){
        $harga = format_rupiah($a[harga]);
		    echo "<div class='product_title'><a href='produk-$a[id_produk]-$a[produk_seo].html'>$a[nama_produk]</a></div>
         <div class='product_img'>
             <a href='produk-$a[id_produk]-$a[produk_seo].html'>
                <img src='foto_produk/small_$a[gambar]' border='0' height='110'>
             </a>
         </div>";
      }

        ?>
       </div>

     <div class="banner_adds"></div>    
