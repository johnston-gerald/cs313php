<?php
$heading = 'Admin';
    echo "<h1>$heading</h1>";

//echo error_reporting(22527);
//echo (error_get_last());
    
$error_number = 22527;
    $error_description = array( );
    $error_codes = array(
        E_ERROR              => "E_ERROR",
        E_WARNING            => "E_WARNING",
        E_PARSE              => "E_PARSE",
        E_NOTICE             => "E_NOTICE",
        E_CORE_ERROR         => "E_CORE_ERROR",
        E_CORE_WARNING       => "E_CORE_WARNING",
        E_COMPILE_ERROR      => "E_COMPILE_ERROR",
        E_COMPILE_WARNING    => "E_COMPILE_WARNING",
        E_USER_ERROR         => "E_USER_ERROR",
        E_USER_WARNING       => "E_USER_WARNING",
        E_USER_NOTICE        => "E_USER_NOTICE",
        E_STRICT             => "E_STRICT",
        E_RECOVERABLE_ERROR  => "E_RECOVERABLE_ERROR",
        E_DEPRECATED         => "E_DEPRECATED",
        E_USER_DEPRECATED    => "E_USER_DEPRECATED",
        E_ALL                => "E_ALL"
    );
    foreach( $error_codes as $number => $description )
    {
        if ( ( $number & $error_number ) == $number )
        {
            $error_description[ ] = $description;
        }
    }
    echo sprintf(
        "error number %d corresponds to:\n%s",
        $error_number,
        implode( " | ", $error_description )
    );
    
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

        if(isset($p_id)){
            editPage($p_id, $page_title, $editor_data, $admin_id, $c_id);
            deleteCategory();
        } else {
            $admin_id = $_SESSION['admin_id'];
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