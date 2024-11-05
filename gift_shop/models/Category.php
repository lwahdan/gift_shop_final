<?php
require_once 'BaseModel.php';

class Category extends BaseModel {
    public function __construct() {
        parent::__construct('categories');
    }

}

