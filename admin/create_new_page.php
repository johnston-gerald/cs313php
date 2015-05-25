<!DOCTYPE html>
<html>
<head>
    <title>Gerald's CMS - Content Editor</title>
    <?php
        include '../database/cms/cms.php';
        include '../database/database.php';
        include '../database/cms/cms_model.php';
        
        if (isset($_POST['page_id'])) {
            $page_id = $_POST['page_id'];
        } else if (isset($_GET['page_id'])) {
            $page_id = $_GET['page_id'];
        }
        
        $edit_category = '';
        if (isset($page_id)) {
            $page = getPage($page_id);
            foreach ($page as $row) {
                $title = $row->getTitle();
                $content = $row->getContent();
    //            $date_created = $row->getDate_created();
    //            $date_last_modified = $row->getDate_last_modified();
                $username = $row->getUsername();
                $edit_category = $row->getCategory_name();
            }
        }
    ?>
    <script src="ckeditor/ckeditor.js"></script>
</head>
<body>
    <form method="post">
        Page name: <input type="text" name="new_page" <?php if(isset($title)){echo "value='$title'";} ?> /><br><br>
        <script type="text/javascript">
            function showfield(name){
                if(name=='new')document.getElementById('new_cat').innerHTML='<br>Category name: <input type="text" name="new_category" />';
                else document.getElementById('new_cat').innerHTML='';
            }
        </script>
        Category: 
        <select name="category" id="category" onchange="showfield(this.options[this.selectedIndex].value)">
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
            <?php
                if(isset($content)){
                    echo $content;
                }
            ?>
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
    
    <?php
    if(isset($_POST['new_page'])){
        if($_POST['new_page'] == ''){
            $page_title = 'New Page';
        } else {
            $page_title = $_POST[ 'new_page' ];
        }
    }
    
    $editor_data = '';
    $admin_id = '1';    //set to 1 for testing purposes

    if(isset($_POST['editor1'])){
        $editor_data = $_POST[ 'editor1' ];
        
        if(isset($_POST['new_category'])){
            if($_POST['new_category'] == ''){
                $new_category = 'New Category';
            } else {
                $new_category = $_POST[ 'new_category' ];
            }
            saveCategory($new_category);
            
            $category = getCategory();
                foreach ($category as $row) {
                    $cat_id = $row->getCategory_id();
                }
            $c_id = $cat_id;
        } else {
            $c_id = $_POST['category'];
        }
        
        savePage($page_title, $editor_data, $admin_id, $c_id);
        echo "<script>window.close();</script>";
    }
    ?>
    
</body>
</html>