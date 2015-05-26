<?php
    $books = getBooks();
?>

<script>
function searchScriptures(book) {
//    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.open("GET","database/scriptures/scripture_result?book='"+str+"'.php");
    xmlhttp.send();
//    $("#scriptures").load("/database/scriptures/scripture_result?book='"+str+"'.php");
}
</script>

<form><br>
    <select name="book" onchange="searchScriptures(this.value)">
        <option value='%'>Select a book</option>
        <?php
            // Insert each book into our select box
            foreach ($books as $book) {
                echo "<option value='$book'>$book</option>";
            }
        ?>
    </select>
    <!--<input type="submit" value="Search"/>-->
</form>
