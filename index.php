<?php 
session_start();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home_view.php';
}

//dynamic <title> tags
$title = 'Gerald\'s CMS';
ob_start();
    include 'include/header.php';
    include $action;
    $buffer=ob_get_contents();
ob_end_clean();
if(isset($heading)){
    $title .=  " - $heading";
}
$buffer=str_replace('%TITLE%',$title,$buffer);
echo $buffer;

include 'include/footer.php';