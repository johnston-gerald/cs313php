<?php
$heading = 'Scripture Resources';
    echo "<h1>$heading</h1>";

include 'database/scriptures/scripture.php';
include 'database/scriptures/scripture_model.php';
include 'database/scriptures/scripture_search.php';

$scriptures = getScriptures();
$topics = getTopics();

foreach ($scriptures as $scripture) {   
    $id = $scripture->getId();
    $book = $scripture->getBook();
    $chapter = $scripture->getChapter();
    $verse = $scripture->getVerse();
    $content = $scripture->getContent();

    $output = array();
    foreach ($topics as $topic) {
        $scripture_id = $topic->getScripture_id();
        if($scripture_id == $id){
            $output[] = $topic->getName();
        }
    }
    $topics_string = implode(', ', $output);
    
    echo "<br><span class='bold'>$book $chapter:$verse</span> - \"$content\"<br>"
       . "<span class='scriptureTopic'>Topics: $topics_string</span><br>";
}