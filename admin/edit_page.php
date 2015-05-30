<!DOCTYPE html>
<html>
<head>
    <title>Gerald's CMS - Content Editor</title>
    <?php
        session_start();
    
        include '../database/cms/cms.php';
        include '../database/database.php';
        include '../database/cms/cms_model.php';
        
        if (isset($_POST['page_id'])) {
            $p_id = $_POST['page_id'];
        } else if (isset($_GET['page_id'])) {
            $p_id = $_GET['page_id'];
        }
        
        $edit_category = '';
        $edit_content = '';
        
        if (isset($p_id)) {
            $page = getPage($p_id);
            foreach ($page as $row) {
                $title = $row->getTitle();
                $edit_content = $row->getContent();
                $username = $row->getUsername();
                $edit_category = $row->getCategory_name();
            }
        }
    ?>
    <script src="ckeditor/ckeditor.js"></script>
</head>
<body>
    <form action="../index.php?action=admin/admin.php<?php if(isset($p_id)){echo "&page_id=$p_id";} ?>" method="post">
        Page name: <input type="text" name="new_page" <?php if(isset($title)){echo "value='$title'";} ?> /><br><br>
        <script type="text/javascript">
            function showfield(name){
                if(name=='new')document.getElementById('new_cat').innerHTML='<br>Category name: <input type="text" name="new_category" />';
                else document.getElementById('new_cat').innerHTML='';
            }
        </script>
        Category:
        <select name="category" id="category" onchange="showfield(this.options[this.selectedIndex].value)">
            <option value="new">Select a Category</option>
            <?php
                $category = getCategory();
                foreach ($category as $row) {
                    $cat_id = $row->getCategory_id();
                    $category_name = $row->getName();
                    if($category_name == $edit_category){
                        $selected = "selected='selected'";
                    } else {
                        $selected = '';
                    }
                    echo "<option $selected value='$cat_id'>$category_name</option>";
                }
            ?>
            <option value="new">New Category</option>
        </select>
        <div id="new_cat"></div><br>
        
        <textarea name="editor1" id="editor1">
            <?php echo $edit_content; ?>
        </textarea>
        <script>
            CKEDITOR.replace( 'editor1',
            {
                    filebrowserBrowseUrl : '../admin/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl : '../admin/ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl : '../admin/ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl : 
                       '../admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&currentFolder=images/',
                    filebrowserImageUploadUrl : 
                       '../admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&currentFolder=images/',
                    filebrowserFlashUploadUrl : '../admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });
        </script>
        <input type="submit" value="Save">
    </form>
    
</body>
</html>