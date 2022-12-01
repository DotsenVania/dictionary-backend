<?php
header('Access-Control-Allow-Origin: *');
$link = mysqli_connect("s15.link-host.net", "dotse210_ivan", "dtsIvan_95", "dotse210_ivan");
$link->set_charset("utf8");


function insertUpdateUrlAudio ($arr, $name) {
    [
        'id' => $id
] = $arr; 
return "UPDATE `dotse210_ivan`.`words` SET `url_audio` = 'http://php.dotsenvania.com/audio-words/$name' WHERE `words`.`id` = $id";
}



if($_POST["action"] == 'file') {
    print_r($_FILES) ;
    move_uploaded_file($_FILES['fileName']['tmp_name'], 'audio-words/' . $_FILES['fileName']['name']);

    $req = mysqli_query($link, insertUpdateUrlAudio($_POST, $_FILES['fileName']['name']));
};
