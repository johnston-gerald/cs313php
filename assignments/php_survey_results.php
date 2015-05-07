<?php
$heading = 'PHP Survey Results';
    echo "<h1>$heading</h1>";

function yesNoMaybe($contents, $yes, $no, $maybe){
    $count = array("Yes"=>"0", "No"=>"0", "Maybe"=>"0");
    foreach ($contents as $line) {
    $line = str_replace(array("\r", "\n"), "", $line);
        switch ($line) {
            case $yes:
                $count['Yes']++;
                break;
            case $no:
                $count['No']++;
                break;
            case $maybe:
                $count['Maybe']++;
                break;
        }
    }
    return $count;
}

function oneToTen($contents, $one, $two, $three, $four, $five, $six, $seven, $eight, $nine, $ten){
    $count = array("1"=>"0", "2"=>"0", "3"=>"0", "4"=>"0", "5"=>"0", "6"=>"0", "7"=>"0", "8"=>"0", "9"=>"0", "10"=>"0");
    foreach ($contents as $line) {
    $line = str_replace(array("\r", "\n"), "", $line);
        switch ($line) {
            case $one:
                $count['1']++;
                break;
            case $two:
                $count['2']++;
                break;
            case $three:
                $count['3']++;
                break;
            case $four:
                $count['4']++;
                break;
            case $five:
                $count['5']++;
                break;
            case $six:
                $count['6']++;
                break;
            case $seven:
                $count['7']++;
                break;
            case $eight:
                $count['8']++;
                break;
            case $nine:
                $count['9']++;
                break;
            case $ten:
                $count['10']++;
                break;
        }
    }
    return $count;
}

function percentage($val1, $val2, $precision) {
    $division = $val1 / $val2;
    $res = $division * 100;
    $res = round($res, $precision);
    return $res;
}

function tally($array){
    $total = array_sum($array);
    foreach($array as $x => $x_value) {
         echo $x . " = " . percentage($x_value, $total, 1) . "%";
         echo "<br>";
    }
}

$aliens = "";
$surveys = "";
$time = "";
$warming = "";

//collect survey data
if (isset($_POST['aliens'])){
    $aliens = $_POST['aliens'] . "\r\n";
}
if (isset($_POST['surveys'])){
    $surveys = $_POST['surveys'] . "\r\n";
}
if (isset($_POST['time'])){
    $time = $_POST['time'] . "\r\n";
}
if (isset($_POST['warming'])){
    $warming = $_POST['warming'] . "\r\n";
}

//open file
$filename = "assignments/survey.txt";
$file = fopen( $filename, "a+" );
if( $file == false ){
   echo ( "Error in opening new file" );
   exit();
}

//write survey data to file
fwrite( $file, $aliens
             . $surveys
             . $time
             . $warming );

$contents = file($filename);
fclose( $file );

echo "<br><span class='bold'>Do you believe that extraterrestrial life exists?</span><br>";
tally(yesNoMaybe($contents, 'a_yes', 'a_no', 'a_maybe'));

echo "<br><span class='bold'>How much do you hate online surveys?</span><br>";
tally(oneToTen($contents, 's_1', 's_2', 's_3', 's_4', 's_5', 's_6', 's_7', 's_8', 's_9', 's_10'));

echo "<br><span class='bold'>Is time travel possible?</span><br>";
tally(yesNoMaybe($contents, 't_yes', 't_no', 't_maybe'));

echo "<br><span class='bold'>How concerned are you about global warming?</span><br>";
tally(oneToTen($contents, 'g_1', 'g_2', 'g_3', 'g_4', 'g_5', 'g_6', 'g_7', 'g_8', 'g_9', 'g_10'));