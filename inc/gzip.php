<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$file = $_SERVER['SCRIPT_FILENAME'];

foreach(array('/home/host/www.fixgov.org','/home/james/websites/fixgov.org') as $dir) {
  if(strpos($file, $dir) !== false ) { $root = $dir; break; }
}
$gzip = (`gzip`) ? 'gzip' : "$root/inc/gzip";

if(strpos($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip') !== false
&& headers_sent() === false)
{
  header("Content-Encoding: gzip");
  $gzip_dir  = "$root/gzipped_files";
  $gzip_file = $gzip_dir.'/' .
               str_replace(array($root,'/'),array('','_'), "$file.gz");

  // file exists and is newer than html file - use existing file
  if(file_exists($gzip_file) && filesize($gzip_file) > 0
  && filemtime($file) < filemtime($gzip_file) )
  {
     echo file_get_contents($gzip_file);
  }
  // no gzip file or its out of date - so create one
  elseif( ( file_exists($gzip_file) && filemtime($file) >= filemtime($gzip_file))
  ||      ( file_exists($gzip_file) && filesize($gzip_file) == 0)
  ||      (!file_exists($gzip_file) && is_writeable($gzip_dir))
  ){
    // write gzip file and remove php tags
    // $buffer = file_get_contents($file);
//    $sed_regexp = 's/<'.'?'.'php.*\?'.'>//g';
//    `cat $file | sed -e '$sed_regexp' | $gzip --best > $gzip_file`;
    `$gzip -c --best $file > $gzip_file`;
    echo file_get_contents($gzip_file);
  }
  else { // can't save output - so just write to screen
    echo `$gzip $file -c`;
  }

  exit;
}

//    $buffer_gzip  = "\x1f\x8b\x08\x00\x00\x00\x00\x00"
//                  . substr(gzcompress($buffer, 9), 0, -4);
?>
