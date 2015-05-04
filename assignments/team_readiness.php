<?php
$heading = 'Team Readiness Activity';
    echo "<h1>$heading</h1>";
?>

<br>
<form action="index.php?action=assignments/team_readiness_results.php" method="post">
    <span class="bold">Name: </span><input type="text" name="name"><br><br>
    <span class="bold">E-mail: </span><input type="text" name="email"><br><br>
    <span class="bold">Major:</span><br>
        <input type="radio" name="major" value="Computer Science">Computer Science
        <input type="radio" name="major" value="Web Design and Development">Web Design and Development
        <input type="radio" name="major" value="Computer Information Technology">Computer Information Technology
        <input type="radio" name="major" value="Computer Engineering">Computer Engineering
        <br><br>
    <span class="bold">Places you have visited:</span><br>
        <input type="checkbox" name="places[]" value="North America">North America
        <input type="checkbox" name="places[]" value="South America">South America
        <input type="checkbox" name="places[]" value="Europe">Europe
        <input type="checkbox" name="places[]" value="Asia">Asia
        <input type="checkbox" name="places[]" value="Australia">Australia
        <input type="checkbox" name="places[]" value="Africa">Africa
        <input type="checkbox" name="places[]" value="Antarctica">Antarctica
        <br><br>
    <span class="bold">Comments:</span><br>
    <textarea name="comment" rows="5" cols="40"></textarea><br><br>
    <input type="submit">
</form>