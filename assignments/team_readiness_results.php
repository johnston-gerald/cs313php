<?php
$heading = 'Team Readiness Results';
    echo "<h1>$heading</h1>";
?>

<br>
<span class="bold">Name: </span><?php echo $_POST["name"]; ?><br><br>

<span class="bold">Email: </span><a href="mailto:<?php echo $_POST["email"]; ?>" target="_top">
    <?php echo $_POST["email"]; ?></a><br><br>

<span class="bold">Major:</span>
    <?php
    if (isset($_POST['major'])){
        echo $_POST["major"];
    }
    ?><br><br>

<span class="bold">Places Visited: </span>

<?php
    if (isset($_POST['places'])){
        $places = $_POST['places'];
        
        foreach ($places as $place) {
            echo "$place <br>";
        }
    }
    else {
        echo "<br>";
    }
?>
<br>

<span class="bold">Comments: </span><?php echo $_POST["comment"]; 