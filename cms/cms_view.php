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

$heading = $title;
    echo "<h1>$heading</h1>";

echo "<br><span id='published'>$date_created · by $username · in $category_name</span><br><br>"
    . nl2br($content);