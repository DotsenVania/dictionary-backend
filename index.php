
<?php
header('Access-Control-Allow-Origin: *');

$link = mysqli_connect("s15.link-host.net", "dotse210_ivan", "dtsIvan_95", "dotse210_ivan");

$link->set_charset("utf8");

$sql = 'SELECT * FROM `words`';  
$sql_delete = 'SELECT * FROM `words`';  


function insertString ($name) {
    ['id' => $id, 
    'nameEng' => $nameEng
    ] = $name; 
    
    return "INSERT INTO `dotse210_ivan`.`words` (`id`, `name_eng`, `transcription`, `translate`, `url_audio`, `url_img`, `top_100`, `top_it`, `top_gold`, `example_eng1`, `example_eng2`, `example_eng3`, `example_ukr1`, `example_ukr2`, `example_ukr3`) VALUES ('$id', '$nameEng', '', '', '', '', '', '', '', '', '', '', '', '', '');";
}; 

$result = mysqli_query($link, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$_POST = json_decode(file_get_contents("php://input"), true);
    
if($_POST["action"] == 'setData') {
    print (json_encode($rows, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
};

if($_POST["action"] == 'postForm') {
    $result2 = mysqli_query($link, insertString($_POST));
    print_r($_POST); 
};

if($_POST["action"] == 'delete') {
    $id = $_POST["id"];
    $result3 = mysqli_query($link," DELETE FROM `dotse210_ivan`.`words` WHERE `words`.`id` = $id");
};
