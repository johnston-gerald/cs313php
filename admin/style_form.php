<form method='post' id='styles'><br>
    Select a color scheme:<br>
    <select name='styles'>
        <?php
        $styles = getStyles();
        foreach ($styles as $row) {
            $style_id = $row->getStyle_id();
            $style_name = $row->getStyle_name();
            echo "<option value='$style_id'>$style_name</option>";
        }
        ?>
    <input type='submit' value='Save'/>
</form>