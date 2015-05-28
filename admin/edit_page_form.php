<br>
<a href='admin/edit_page.php'>Create a new page</a>

<form action="admin/edit_page.php" method="GET" id="edit_page"><br>
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
</form>

<form method="POST" id="delete_page"><br>
    Delete a page:<br>
    <select name="delete_page_id">
        <?php
        $nav = getCMSNav();
        foreach ($nav as $row) { 
            $page_id = $row->getPage_id();
            $title = $row->getTitle();
            $category_id = $row->getCategory_id();

            echo "<option value='$page_id'>$title</option>";
        }
        ?>
    <input type="submit" value="Delete"/>
</form>