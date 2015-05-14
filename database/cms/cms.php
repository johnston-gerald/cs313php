<?php
class CMS {
    private $page_id, $title, $content, $date_created, $date_last_modified, $category_id;

    public function __construct($page_id, $title, $content, $date_created, $date_last_modified, $category_id) {
        $this->page_id = $page_id;
        $this->title = $title;
        $this->content = $content;
        $this->date_created = $date_created;
        $this->date_last_modified = $date_last_modified;
        $this->category_id = $category_id;
    }
    
    public function getPage_id() {
        return $this->page_id;
    }

    public function setPage_id($page_id) {
        $this->page_id = $page_id;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getDate_created() {
        return $this->date_created;
    }

    public function setDate_created($date_created) {
        $this->date_created = $date_created;
    }

    public function getDate_last_modified() {
        return $this->date_last_modified;
    }

    public function setDate_last_modified($date_last_modified) {
        $this->date_last_modified = $date_last_modified;
    }

    public function getCategory_id() {
        return $this->category_id;
    }

    public function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }
    
}

class Category {
    private $category_id, $name;

    public function __construct($category_id, $name) {
        $this->category_id = $category_id;
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getCategory_id() {
        return $this->category_id;
    }

    public function setCategory_id($category_id) {
        $this->name = $category_id;
    }
}