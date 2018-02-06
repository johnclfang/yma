<?php
  $path="../images/{$_GET['cate']}/{$_GET['artist']}";
  $d=dir($path);
  $p=0;
  while (false !== ($entry = $d->read())) {
	if($entry != '.' && $entry != '..'){
		$txt=substr($entry,0,-4);
		if(substr($txt,-9)!='thumbnail' && !file_exists("{$path}/{$txt}-thumbnail.jpg")){
			system("/usr/bin/convert -thumbnail 400 {$path}/{$txt}.jpg {$path}/{$txt}-thumbnail.jpg");
			continue;
		}
		if($p%3==0){
			echo '<div class="row">';
		}
		$p++;
		$text=substr($txt,0,-10);
		echo "<div class=\"col-lg-4\"><center><img width=\"90%\" src=\"images/{$_GET['cate']}/{$_GET['artist']}/{$entry}\" onClick=\"changePainting(this.src)\"><BR>{$text}</center></div>\n";
		if($p%3==0){
			echo "</div>\n";
		}
	}
  }
  $d->close();
?>