
<?php
header('Access-Control-Allow-Origin: *');

$link = mysqli_connect("s15.link-host.net", "dotse210_ivan", "dtsIvan_95", "dotse210_ivan");

$link->set_charset("utf8");

$sql = 'SELECT * FROM `words`';  
$sql_delete = 'SELECT * FROM `words`';  


function insertString ($name) {
    [   'name_eng' => $name_eng,
        'example_eng1' => $example_eng1,
        'example_eng2' => $example_eng2,
        'example_eng3' => $example_eng3,
        'example_ukr1' => $example_ukr1,
        'example_ukr2' => $example_ukr2,
        'example_ukr3' => $example_ukr3,
        'transcription' => $transcription,
        'translate' => $translate,
        'url_img' => $url_img,
        'category' => $category
    ] = $name; 
    print 'add'; 
    return "INSERT INTO `dotse210_ivan`.`words` (`name_eng`, `transcription`, `translate`,  `url_img`, `example_eng1`, `example_eng2`, `example_eng3`, `example_ukr1`, `example_ukr2`, `example_ukr3`, `category`)
    VALUES ('$name_eng', '$transcription', '$translate', '$url_img', '$example_eng1', '$example_eng2', '$example_eng3', '$example_ukr1', '$example_ukr2', '$example_ukr3', '$category');";
}; 

function insertUpdateString ($arr) {
    ['name_eng' => $name_eng,
    'example_eng1' => $example_eng1,
    'example_eng2' => $example_eng2,
    'example_eng3' => $example_eng3,
    'example_ukr1' => $example_ukr1,
    'example_ukr2' => $example_ukr2,
    'example_ukr3' => $example_ukr3,
    'transcription' => $transcription,
    'translate' => $translate,
    'url_img' => $url_img,
    'category' => $category,
    'id' => $id
] = $arr; 
print 'update'; 
return "UPDATE `dotse210_ivan`.`words` SET `name_eng` = '$name_eng', `transcription` = '$transcription', `translate` = '$translate', `url_img` = '$url_img', `example_eng1` = '$example_eng1', `example_eng2` = '$example_eng2', `example_eng3` = '$example_eng3', `example_ukr1` = '$example_ukr1', `example_ukr2` = '$example_ukr2', `example_ukr3` = '$example_ukr3', `category` = '$category' WHERE `words`.`id` = $id";
}

$result = mysqli_query($link, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$_POST = json_decode(file_get_contents("php://input"), true);
    
if($_POST["action"] == 'setData') {
    print (json_encode($rows, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
};

if($_POST["action"] == 'delete') {
    $id = $_POST["id"];
    $result3 = mysqli_query($link," DELETE FROM `dotse210_ivan`.`words` WHERE `words`.`id` = $id");
};

if($_POST["action"] == 'add-word') {
    $result2 = mysqli_query($link, insertString($_POST));
    print (json_encode($result2, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE));
};

if($_POST["action"] == 'update') {
    $result2 = mysqli_query($link, insertUpdateString($_POST));
};
