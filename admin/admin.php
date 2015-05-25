<?php
$heading = 'Admin';
    echo "<h1>$heading</h1>";
?>

<form method="post" id="styles"><br>
    Select a color scheme:<br>
    <select name="styles">
        <?php
            $styles = getStyles();
            foreach ($styles as $row) {
                $style_id = $row->getStyle_id();
                $style_name = $row->getStyle_name();
                echo "<option value='$style_id'>$style_name</option>";
            }
        ?>
    <input type="submit" value="Save"/>
</form>

<?php
if(isset($_POST["styles"])) {
    setStyle($_POST["styles"]);
    header("Location: ". $_SERVER['REQUEST_URI']);  //refresh page
    exit;
}
?>

<!--<br>
<a href='admin/create_new_page.php' target='_blank'>Create a new page</a>

<form action="admin/create_new_page.php" method="GET" target="_blank" id="edit_page"><br>
    Edit a page:<br>
    <select name="page_id">
        <?php
        $nav = getCMSNav();
        foreach ($nav as $row) { 
            $page_id = $row->getPage_id();
            $title = $row->getTitle();
            $category_id = $row->getCategory_id();

            echo "<option value='$page_id'>$title</option>";
        }
        ?>
    <input type="submit" value="Edit"/>
</form>-->