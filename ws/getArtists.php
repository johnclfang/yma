<?php
  $path="../images/{$_GET['cat']}/";
  $d=dir($path);
  $p=0;
  while (false !== ($entry = $d->read())) {
	if($entry != '.' && $entry != '..' && is_dir($path.$entry)){
		$artists[]=$entry;
		$p++;  
	}
  }
  echo json_encode($artists);
  $d->close();
?>