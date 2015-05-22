<?php
class CMS {
    private $page_id, $title, $content, $date_created, $date_last_modified, $username, $category_name;

    public function __construct($page_id, $title, $content, $date_created, $date_last_modified, $username, $category_name) {
        $this->page_id = $page_id;
        $this->title = $title;
        $this->content = $content;
        $this->date_created = $date_created;
        $this->date_last_modified = $date_last_modified;
        $this->username = $username;
        $this->category_name = $category_name;
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

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getCategory_name() {
        return $this->category_name;
    }

    public function setCategory_name($category_name) {
        $this->page_id = $category_name;
    }
}

class Nav {
    private $page_id, $title, $category_id;

    public function __construct($page_id, $title, $category_id) {
        $this->page_id = $page_id;
        $this->title = $title;
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

class Style {
    private $style_id, $style_name;

    public function __construct($style_id, $style_name) {
        $this->style_id = $style_id;
        $this->style_name = $style_name;
    }
    
    public function getStyle_id() {
        return $this->style_id;
    }

    public function setStyle_id($style_id) {
        $this->name = $style_id;
    }
    
    public function getStyle_name() {
        return $this->style_name;
    }

    public function setStyle_name($style_name) {
        $this->name = $style_name;
    }
}