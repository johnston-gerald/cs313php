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