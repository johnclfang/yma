<?php
  $path="../images/{$_GET['cate']}/{$_GET['artist']}";
  $d=dir($path);
  $p=0;
  $about='';
  $list='';
  $about="<div class=\"col-lg-6\"><center><img width=\"100%\" src=\"images/{$path}/簡介1.jpg\" onerror=\"this.src='images/簡介1.jpg'\"></center></div>";
  $about.="<div class=\"col-lg-6\"><center><img width=\"100%\" src=\"images/{$path}/簡介2.jpg\" onerror=\"this.src='images/簡介2.jpg'\"></center></div>";
  while (false !== ($entry = $d->read())) {
	if($entry != '.' && $entry != '..'){
		$txt=substr($entry,0,-4);
		if(substr(mb_strtolower($entry),-5)=='1.jpg'||substr(mb_strtolower($entry),-5)=='2.jpg')
			continue;
		//echo $entry,mb_substr($entry,0,3),"\n";
		//continue;
		if(substr($entry,-5)!='1.jpg'&&substr($entry,-5)!='2.jpg' && mb_substr($entry,0,2)!='簡介'){
			if($p%3==0){
				$list.='<div class="row" style="position:bottom:1;">';
			}
			$thisEntry="<div class=\"col-lg-4 vbottom\" style=\"font-size: 140%; margin-top:35px;\"><center><img width=\"90%\" src=\"images/{$path}/{$txt}.1.jpg\" onClick=\"changePainting(this.src)\"><BR>{$txt}</center></div>";
			$entries[]=$txt;
			$list.=$thisEntry;
			$p++;
			$text=substr($txt,0,-10);
			$out['entries'][]=$thisEntry;
			if($p%3==0){
				$list.="</div>";
			}
			if(!file_exists("{$path}/{$txt}.1.jpg")){
				system("/usr/bin/convert -thumbnail 400 \"{$path}/{$entry}\" \"{$path}/{$txt}.1.jpg\"");
				system("/usr/bin/convert -thumbnail 900 \"{$path}/{$entry}\" \"{$path}/{$txt}.2.jpg\"");
				$out['converted'][]="/usr/bin/convert -thumbnail 400 \"{$path}/{$txt}.jpg\" \"{$path}/{$txt}.1.jpg\"";
				continue; 
			}
		}
	}
  }
  if($p==0){
	  $list.='<div class="row profile-header">';
	  $thisEntry="<div class=\"col-lg-4\" style=\"font-size: 140%\"><center><img width=\"90%\" src=\"images/標題 年份 號數 定價.jpg\"><BR>標題 2099 100P NTD99,999</center></div>";
	  $list.=$thisEntry;
	  $list.=$thisEntry;
	  $list.=$thisEntry;
	  $list.="</div>";
  }else{
	  $p=0;
	  $html="";
	  sort($entries);
	  foreach($entries as $entry){
		if($p%3==0)
			$html.='<div class="row" style="position:bottom:1;">';
		$html.="<div class=\"col-lg-4 vbottom\" style=\"font-size: 140%; margin-top:35px;\"><center><img width=\"90%\" src=\"images/{$path}/{$entry}.1.jpg\" painting=\"images/{$_GET['cate']}/{$_GET['artist']}/{$entry}\" onClick=\"changePainting(this.src)\"><BR>{$entry}</center></div>";
		$p++;
		if($p%3==0){
			$html.="</div>";
		}
	  }
  }
  $out['about']=$about;
  $out['list']=$html;
  echo json_encode($out);
  $d->close();
?>