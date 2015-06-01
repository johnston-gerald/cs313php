<?php
//header("Content-type: text/css; charset: UTF-8");

$color_scheme = getStyle();

switch ($color_scheme) {
    case "1":   //Standard
        $header_color = '#187E74'; //teal
        $body_color = '#187E74'; //teal
        $main_h1_color = '#A21034'; //red
        $h2_color = '#333333';  //grey
        $menu_text_color = '#fff';   //white
        $menu_text_hover = '#fff';   //white;
        $menu_background_color = '#000'; //black
        $menu_hover_color = '#870000';  //dark red
        break;
    case "2":   //Black and White
        $header_color = '#fff';
        $body_color = '#000';
        $main_h1_color = '#000';
        $h2_color = '#333333';  //grey
        $menu_text_color = '#fff';
        $menu_text_hover = '#000';
        $menu_background_color = '#000';
        $menu_hover_color = '#fff';
        break;
    case "3":   //Girly
        $header_color = '#AD5784';  //light pink
        $body_color = '#AD5784';    //light pink
        $main_h1_color = '#5A2971'; //purple
        $h2_color = '#68113F';  //light purple
        $menu_text_color = '#FFAEAA';   //white
        $menu_text_hover = '#550400';   //white;
        $menu_background_color = '#000'; //black
        $menu_hover_color = '#AA3F39';  //dark red
        break;
    default:
        $header_color = '#187E74'; //teal
        $body_color = '#187E74'; //teal
        $main_h1_color = '#A21034'; //red
        $h2_color = '#333333';  //grey
        $menu_text_color = '#fff';   //white
        $menu_text_hover = '#fff';   //white;
        $menu_background_color = '#000'; //black
        $menu_hover_color = '#870000';  //dark red
}

echo "<style>

header {
    color: $header_color;
}

body {
    color: $body_color;
}

main h1 {
    color: $main_h1_color;
}

h2 {
    color: $h2_color;
}

nav ul li a, nav ul ul li a, nav ul li:hover a {
    color: $menu_text_color;
}

nav, nav ul li{
    background-color: $menu_background_color;
}

nav ul ul li a:hover, nav ul li a:hover {
    color: $menu_text_hover;
    background: $menu_hover_color;
}

label.error {
    color:#FF0000;
}
</style>";