<?php

$dir = 'images/';
$files = scandir($dir, 0);
for ($i = 2; $i < count($files); $i++) {

    $image = (explode('.', $files[$i]));
    $image_name = $image[0];
    $image_ext = $image[1];

    echo '<br>';
    echo 'image name = ' . $image_name;
    echo '<br>';
    echo 'image ext = ' . $image_ext;
    echo '<br>';
    
    copy('images/'.$image_name.'.'.$image_ext, 'images/thumb_'.$image_name.'.'.$image_ext);
}

   