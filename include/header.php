<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>%TITLE%</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
    <link href="css/menu_style.css" rel="stylesheet" type="text/css" media="screen">
    <link href='css/style.php' rel='stylesheet' type='text/css' media="screen">
<!--    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>-->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="author" content="Gerald Johnston">
    <?php
        include 'database/cms/cms.php';
        include 'database/database.php';
        include 'database/cms/cms_model.php';
    ?>
</head>

<body>
    <header><h1>Gerald's CMS</h1></header>

    <nav>
        <ul id="top_menu">
            <li><a href='index.php'>home</a></li>
            <li><a href='#'>assignments</a>
                <ul>
                    <li><a href='index.php?action=assignments/spiritual_thought1.php'>Spiritual Thought 1</a></li>
                    <li><a href='index.php?action=assignments/spiritual_thought2.php'>Spiritual Thought 2</a></li>
                    <li><a href='index.php?action=assignments/team_readiness.php'>Team Readiness</a></li>
                    <li><a href='index.php?action=assignments/php_survey.php'>PHP Survey</a></li>
                    <li><a href='index.php?action=assignments/scriptures.php'>Scriptures</a></li>
                </ul>
            </li>
            <?php
                $category = getCategory();
                $nav = getCMSNav();
                foreach ($category as $row) {
                    $cat_id = $row->getCategory_id();
                    $name = $row->getName();
                    echo "<li><a href='#'>$name</a>"
                       . "<ul>";
                    
                    foreach ($nav as $row) { 
                        $page_id = $row->getPage_id();
                        $title = $row->getTitle();
                        $content = $row->getContent();
                        $date_created = $row->getDate_created();
                        $date_last_modified = $row->getDate_last_modified();
                        $category_id = $row->getCategory_id();

                        if ($cat_id == $category_id){
                            echo "<li><a href='index.php?action=cms/cms_view.php&page_id=$page_id'>$title</a></li>";
                        }
                    }
                    echo "</ul>"
                    . "</li>";
                }
            ?>
        </ul>
    </nav>
    <div id="wrapper">
    <main>