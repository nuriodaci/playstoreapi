<?php
//NURİ ODACI - nuriodaci.com.tr
header('Content-Type: text/html; charset=utf-8');
$play_url=$_GET['url']."&hl=en_US";
$play_id=substr($play_url, strpos($play_url,"id=")+3);

$res = file_get_contents($play_url);


preg_match('@<title id="main-title">(.*?)</title>@si',$res,$t);
$title=str_replace("- Apps on Google Play","", $t[1]);
preg_match('@<meta name="description" property="og:description" content="(.*?)">@si',$res,$d);
$description=$d[1];
preg_match('@<meta name="appstore:developer_url" content="(.*?)">@si',$res,$w);
$website=$w[1];
preg_match_all('@class="hrTbp R8zArc">(.*?)</a></span>@si',$res,$c);
$developer=$c[1][0];
if (count($c[1])>2) {
for ($i=1; $i <count($c1[1]) ; $i++) { 
array_push($category, $c1[1][$i]);
}//for
}else{
$category[0]=$c[1][1];
}//İF
preg_match('@<div class="BHMmbe"(.*?)</div>@si',$res,$r);
$rate=substr($r[1],-3);
preg_match('@<span class="O3QoBc hzfjkd"></span>(.*?)</span>@si',$res,$cm);
$comment=substr($cm[1],strpos($cm[1], ">")+1);
preg_match_all('@<span jsslot>(.*?)</span>@si',$res,$n);
$new=$n[1][1]; //it can be null.
preg_match('@Downloaded (.*?) times.@si',$res,$dw);
$download=$dw[1];
$images=[]; 
preg_match_all('@data-screenshot-item-index="(.*?)"><img src="(.*?)"@si',$res,$im);
preg_match_all('@data-screenshot-item-index="(.*?)"><img data-src="(.*?)"@si',$res,$im2);

for ($i=0; $i <count($im[2]) ; $i++) { 
array_push($images, $im[2][$i]);
}
for ($i=0; $i <count($im2[2]) ; $i++) { 
array_push($images, $im2[2][$i]);
}
preg_match('@<meta itemprop="price" content="(.*?)"></span></span>@si',$res,$p);
if ($p[1] == 0) {
	$price="0";
	$currency="USD";
}else{
$price=substr($p[1],5);
$currency=substr($p[1],0,3);
}

$output = array(
	'title' =>$title , 
	'description' =>$description ,
	'website' =>$website ,
	'developer' =>$developer ,
	'category' =>$category,
	'rate' =>$rate ,
	'comment' =>$comment ,
	'new' =>$new ,
	'download' =>$download ,
	'images' =>$images, 
	'price' =>$price, 
	'currency' =>$currency
);


print_r(json_encode($output));
?>
