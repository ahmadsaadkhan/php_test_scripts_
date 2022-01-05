<?php
require_once ('db/MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', '', 'testscriptsdb');

$users = $db->get ("users", null);
if ($db->count > 0)
    foreach (json_decode(json_encode($users)) as $user) { 
        echo '<br />';
        echo $user->id;
        echo '<br />';
        echo $user->image;

        if($user->image) {
            $filename = "images/".$user->image;
            if (file_exists($filename)){
                echo '<br />';
                echo "File exist.";
            }else{
                echo '<br />';
                echo "File does not exist.";
                copy('images/download.png', 'images/'.$user->image);
                copy('images/download.png', 'images/thumb_'.$user->image);

            }
        }   
    }


// $dir = 'images/';
// $files = scandir($dir, 0);
// for ($i = 2; $i < count($files); $i++) {

//     $image = (explode('.', $files[$i]));
//     $image_name = $image[0];
//     $image_ext = $image[1];

//     echo '<br>';
//     echo 'image name = ' . $image_name;
//     echo '<br>';
//     echo 'image ext = ' . $image_ext;
//     echo '<br>';
    
//     copy('images/'.$image_name.'.'.$image_ext, 'images/thumb_'.$image_name.'.'.$image_ext);
// }