<?php
//  $heading = "Scripture Search";
//  // Display header.
//  echo "<h1>$heading</h1>";
//  
//  // Include database code.
//  include 'database/scriptures/scripture.php';
//  include 'database/scriptures/scripture_model.php';
  
  // Get the different books in the database, 
  // expects a list of strings.
  $books = getBooks();
?>

<!-- 
Outside of php code, because I dont like using echos 
when I don't have to.
-->
<form action="index.php?action=assignments/scripture_result.php" method= "post" id="bookForm"><br>
Book:<br/>
<select name="book">
<?php
  // Insert each book into our select box
  foreach ($books as $book) {
    echo "<option value=\"$book\">$book</option>";
  }
?>
<input type="submit" value="Search"/>
</form>
