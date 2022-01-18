<?php
require_once('db/MysqliDb.php');
$db = new MysqliDb('localhost', 'root', '', 'testscriptsdb');

$experiment = $db->get("experiment", null);

if ($db->count > 0)
    foreach (json_decode(json_encode($experiment)) as $ex) {
        echo '<br />';
        echo $ex->id;
        echo '<br />';
        $jsonObject = json_decode($ex->json_text);
        foreach ($jsonObject as $key => $value) {
            echo $jsonObject->$key;
        }
    }
