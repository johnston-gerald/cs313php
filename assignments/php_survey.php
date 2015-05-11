<?php
$heading = 'PHP Survey';
    echo "<h1>$heading</h1>";
    
$url = 'index.php?action=assignments/php_survey_results.php';

if(isset($_COOKIE["user"])) {
    header("Location: $url");
    exit;
}
?>

<br>
<form action="index.php?action=assignments/php_survey_results.php" method="post">
    <span class="bold">Do you believe that extraterrestrial life exists?</span><br>
        <input type="radio" name="aliens" value="a_yes">Yes
        <input type="radio" name="aliens" value="a_no">No
        <input type="radio" name="aliens" value="a_maybe">Maybe
    <br><br>

    <span class="bold">How much do you hate online surveys?</span><br>
        Love<input type="radio" name="surveys" value="s_1">1
        <input type="radio" name="surveys" value="s_2">2
        <input type="radio" name="surveys" value="s_3">3
        <input type="radio" name="surveys" value="s_4">4
        <input type="radio" name="surveys" value="s_5">5
        <input type="radio" name="surveys" value="s_6">6
        <input type="radio" name="surveys" value="s_7">7
        <input type="radio" name="surveys" value="s_8">8
        <input type="radio" name="surveys" value="s_9">9
        <input type="radio" name="surveys" value="s_10">10 Hate
    <br><br>        

    <span class="bold">Is time travel possible?</span><br>
        <input type="radio" name="time" value="t_yes">Yes
        <input type="radio" name="time" value="t_no">No
        <input type="radio" name="time" value="t_maybe">Maybe
    <br><br>

    <span class="bold">How concerned are you about global warming?</span><br>
        No Worries<input type="radio" name="surveys" value="g_1">1
        <input type="radio" name="warming" value="g_2">2
        <input type="radio" name="warming" value="g_3">3
        <input type="radio" name="warming" value="g_4">4
        <input type="radio" name="warming" value="g_5">5
        <input type="radio" name="warming" value="g_6">6
        <input type="radio" name="warming" value="g_7">7
        <input type="radio" name="warming" value="g_8">8
        <input type="radio" name="warming" value="g_9">9
        <input type="radio" name="warming" value="g_10">10 It freaks me out
    <br><br>       
    
    <input type="submit"><br><br>
    <a href='index.php?action=assignments/php_survey_results.php'>I just want to see the results</a>
</form>