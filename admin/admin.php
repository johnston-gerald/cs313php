<?php
$heading = 'Admin';
    echo "<h1>$heading</h1>";

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

if(isset($_POST['logout'])){
    $_SESSION = array();   // Clear all session data from memory
    session_destroy();     // Clean up the session ID
    $login_message = 'You have been logged out.';
}

include 'login.php';

if (!isset($_SESSION['is_valid_user'])) {
    include 'login_form.php';
} else  {

    include 'logout_form.php';
    
    if(isset($_POST['new_page'])){
        if($_POST['new_page'] == ''){
            $page_title = 'New Page';
        } else {
            $page_title = $_POST[ 'new_page' ];
        }
    }

    $editor_data = '';

    //save page
    if(isset($_POST['editor1'])){
        $editor_data = $_POST['editor1'];

        if(isset($_POST['category'])){
            if($_POST['category'] == 'new'){
                if(isset($_POST['new_category'])){
                    if($_POST['new_category'] == ''){
                        $new_category = 'New Category';
                    }
                    else {
                        $new_category = $_POST['new_category'];
                    }
                } else {
                    $new_category = 'New Category';
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
        }

        if (isset($_POST['page_id'])) {
            $p_id = $_POST['page_id'];
        } else if (isset($_GET['page_id'])) {
            $p_id = $_GET['page_id'];
        }

        $admin_id = $_SESSION['admin_id'];
        if(isset($p_id)){
            editPage($p_id, $page_title, $editor_data, $admin_id, $c_id);
            deleteCategory();
        } else {
            savePage($page_title, $editor_data, $admin_id, $c_id);
        }
        header("Location: index.php?action=admin/admin.php");  //refresh page
        exit;
    }

    //delete page check
    if (isset($_POST['delete_page_id'])) {
            $delete_page_id = $_POST['delete_page_id'];
        } else if (isset($_GET['delete_page_id'])) {
            $delete_page_id = $_GET['delete_page_id'];
    }
    if (isset($delete_page_id)){
        deletePage($delete_page_id);
        deleteCategory();
        header("Location: ". $_SERVER['REQUEST_URI']);  //refresh page
        exit;
    }

    include 'style_form.php';

    if(isset($_POST["styles"])) {
        setStyle($_POST["styles"]);
        header("Location: ". $_SERVER['REQUEST_URI']);  //refresh page
        exit;
    }

    include 'edit_page_form.php';
}