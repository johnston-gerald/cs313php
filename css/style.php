<?php
    header("Content-type: text/css; charset: UTF-8");
    
    $body_color = '#187E74'; //teal
    $main_h1_color = '#A21034'; //red
    $h2_color = '#333333';  //grey
    $menu_text_color = '#fff';   //white
    $menu_background_color = '#000'; //black
    $menu_hover_color = '#870000';  //dark red
?>

body, header {
    color: <?php echo $body_color ?>;
}

main h1 {
    color: <?php echo $main_h1_color ?>;
}

h2 {
    color: <?php echo $h2_color ?>;
}

/*menu text color*/
nav ul li:hover a, nav ul li a, nav ul ul li a {
    color: <?php echo $menu_text_color ?>;
}

/*menu background color*/
nav ul ul {
    background: <?php echo $menu_background_color ?>;
}

/*menu hover color*/
nav ul li:hover, nav ul ul li a:hover {
    background: <?php echo $menu_hover_color ?>;
}