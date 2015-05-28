<?php
if (isset($_POST['page_id'])) {
    $page_id = $_POST['page_id'];
} else if (isset($_GET['page_id'])) {
    $page_id = $_GET['page_id'];
}

$page = getPage($page_id);
foreach ($page as $row) {
    $title = $row->getTitle();
    $content = $row->getContent();
    $date_created = $row->getDate_created();
    $date_last_modified = $row->getDate_last_modified();
    $username = $row->getUsername();
    $category_name = $row->getCategory_name();
}

if(isset($content)){
    
    $heading = $title;
    echo "<h1>$heading</h1>";
    
    if ($date_last_modified > $date_created){
        $modified = "· Edited $date_last_modified";
    } else {
        $modified = "";
    }

    echo "<br><span id='published'>$date_created · by $username · in $category_name $modified</span><br><br>"
        . $content;
} else {
    $heading = "Error";
    echo "<h1>$heading</h1>";
    
    echo "<p>The page does not exist.</p>";
}