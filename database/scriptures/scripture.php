<?php
class Scripture {
    private $id, $book, $chapter, $verse, $content;

    public function __construct($id, $book, $chapter, $verse, $content) {
        $this->id = $id;
        $this->book = $book;
        $this->chapter = $chapter;
        $this->verse = $verse;
        $this->content = $content;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

class Topic {
    private $scripture_id, $name;

    public function __construct($scripture_id, $name) {
        $this->scripture_id = $scripture_id;
        $this->name = $name;
    }
    
    public function getScripture_id() {
        return $this->scripture_id;
    }

    public function setScripture_id($scripture_id) {
        $this->scripture_id = $scripture_id;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}