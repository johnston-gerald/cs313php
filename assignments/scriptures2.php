<?php
$heading = 'Scripture Resources';
    echo "<h1>$heading</h1>";

include 'database/scriptures/scripture.php';
include 'database/scriptures/scripture_model.php';
?>

<script>
function searchScriptures(book) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("scriptures").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","database/scriptures/scripture_result.php?book="+book,true);
    xmlhttp.send();
}

// Call the insert scripture code, update the scriptures div
function insertScripture(new_book, new_chapter, new_verse, new_content) {
//   Keep page from refreshing.
  document.getElementById("new_scripture");
  sendStr = $("new_scripture").serialize();
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("scriptures").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "database/scriptures/insert_scripture.php?new_book="
          +new_book +"&new_chapter=" +new_chapter +"&new_verse=" +new_verse +"&new_content=" +new_content, true);
    xmlhttp.send(sendStr);
    alert(new_chapter);
}
</script>

<!--Scripture Entry-->
<br><hr>
<h2>New Scripture Entry</h2>
<form id="new_scripture" method="GET" onsubmit="insertScripture(this.new_book, this.new_chapter, this.new_verse, this.new_content)">
    Book: <input type="text" id="new_book" name="new_book" />&nbsp;&nbsp;&nbsp;&nbsp;
    Chapter or Section: <select id="new_chapter" name="new_chapter">
        <?php 
            for ($i = 1; $i <= 150; $i++) {     //the longest book in the scriptures has 150 chapters
                echo "<option value='$i'>$i</option>";
            }
        ?>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;
    Verse: <select id="new_verse" name="new_verse">
        <?php 
            for ($i = 1; $i <= 176; $i++) {     //the longest chapter in the scriptures has 176 chapters
                echo "<option value='$i'>$i</option>";
            }
        ?>
    </select><br><br>
    <textarea id="new_content" name="new_content" placeholder="Enter the scripture content here."></textarea><br>
    Topics:&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
            $topic_list = getAllTopics();
            foreach ($topic_list as $topic) {
                $id = $topic->getId();
                $name = $topic->getName();
                
                echo "<input type='checkbox' id='$name' name='$name' value='$id'>$name&nbsp;&nbsp;&nbsp;&nbsp;";
            }
        ?>
        <!--option to create a new topic-->
        <input type='checkbox' id='new_topic' name='new_topic' value='new_topic'>
            <input type="text" id="new_topic_name" name="new_topic_name" placeholder="New Topic"/>
    <br><br>
    <input type="submit" value="Save">
</form>
<br><hr>
<!--end of Scripture Entry-->

<!--scripture search-->
<?php
    $books = getBooks();
?>

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
<!--end of scripture search-->

<div id="scriptures">
    <?php include 'database/scriptures/scripture_result.php'; ?>
</div>