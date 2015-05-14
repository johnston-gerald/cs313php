<?php
class Scripture {
    private $book, $chapter, $verse, $content;

    public function __construct($book, $chapter, $verse, $content) {
        $this->book = $book;
        $this->chapter = $chapter;
        $this->verse = $verse;
        $this->content = $content;
    }
    
    public function getBook() {
        return $this->book;
    }

    public function setBook($value) {
        $this->book = $value;
    }
    
    public function getChapter() {
        return $this->chapter;
    }

    public function setChapter($value) {
        $this->chapter = $value;
    }
    
    public function getVerse() {
        return $this->verse;
    }

    public function setVerse($value) {
        $this->verse = $value;
    }
    
    public function getContent() {
        return $this->content;
    }

    public function setContent($value) {
        $this->content = $value;
    }
}