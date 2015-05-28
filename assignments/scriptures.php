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
function insertScripture() {
  // 1. Create XHR instance - Start
    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    }
    else {
        throw new Error("Ajax is not supported by this browser");
    }
    // 1. Create XHR instance - End
    
    // 2. Define what to do when XHR feed you the response from the server - Start
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status == 200 && xhr.status < 300) {
                document.getElementById('scriptures').innerHTML = xhr.responseText;
            }
        }
    }
    // 2. Define what to do when XHR feed you the response from the server - Start
    sendStr = $(document.getElementById('new_scripture')).serialize();
    
//    var book = document.getElementById("book").value;
//    var chapter = document.getElementById("chapter").value;
//    var verse = document.getElementById("verse").value;
//    var content = document.getElementById("content").value;

    // 3. Specify your action, location and Send to the server - Start 
    xhr.open('POST', 'database/scriptures/insert_scripture.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//    xhr.send("book=" +book +"&chapter=" +chapter +"&verse=" +verse +"&content=" +content);
    xhr.send(sendStr);
    // 3. Specify your action, location and Send to the server - End
//  alert(sendStr);
}
</script>

<!--Scripture Entry-->
<br><hr>
<h2>New Scripture Entry</h2>
<form id="new_scripture" method="post">
    Book: <input type="text" id="book" name="book" />&nbsp;&nbsp;&nbsp;&nbsp;
    Chapter or Section: <select id="chapter" name="chapter">
        <?php 
            for ($i = 1; $i <= 150; $i++) {     //the longest book in the scriptures has 150 chapters
                echo "<option value='$i'>$i</option>";
            }
        ?>
    </select>&nbsp;&nbsp;&nbsp;&nbsp;
    Verse: <select id="verse" name="verse">
        <?php 
            for ($i = 1; $i <= 176; $i++) {     //the longest chapter in the scriptures has 176 chapters
                echo "<option value='$i'>$i</option>";
            }
        ?>
    </select><br><br>
    <textarea id="content" name="content" placeholder="Enter the scripture content here."></textarea><br>
    Topics:&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
            $topic_list = getAllTopics();
            foreach ($topic_list as $topic) {
                $id = $topic->getId();
                $name = $topic->getName();
                
                echo "<input type='checkbox' name='$name' value='$id'>$name&nbsp;&nbsp;&nbsp;&nbsp;";
            }
        ?>
        <!--option to create a new topic-->
        <input type='checkbox' name='new_topic' value='new_topic'>
            <input type="text" name="new_topic_name" placeholder="New Topic"/>
    <br><br>
    <input type="submit" value="Save" onclick="insertScripture()">
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