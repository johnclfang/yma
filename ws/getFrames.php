<?php
  $path="../images/frames/";
  $d=dir($path);
  $p=0;
  while (false !== ($entry = $d->read())) {
	if($entry != '.' && $entry != '..' && is_dir($path.$entry)){
		$entries[]=$entry;
		$p++;  
	}
  }
  sort($entries);
  echo json_encode($entries);
  $d->close();
?>