<?php
  $path="../images/carousel/";
  $d=dir($path);
  $p=0;
  $indicators="";
  $contents="";
  while (false !== ($entry = $d->read())) {
	if($entry != '.' && $entry != '..'){
		$active=($p==0?"active":"");  
		$indicators.="<li data-target=\"#carousel1\" data-slide-to=\"{$p}\" ".($p==0?"class=\"$active\"":"")."></li>";
		$contents.="<div class=\"item {$p} {$active}\"><img src=\"images/carousel/{$entry}\" alt=\"{$entry}\" class=\"center-block\"> </div>";
		$p++;  
	}
  }
  $out['ind']=$indicators;
  $out['cont']=$contents;
  echo json_encode($out);
  $d->close();
?>