<?php  
require_once "productClasses.php";

class BasePage{
    public static function loadEssential(){}
    public static function loadHeader(){}
    public static function loadMain(){
        require __ROOT__ . '/php/mainTP.php';
    }
}

class HomePage extends BasePage{
    public static function loadHeader(){
        echo '<p>Product List</p>';
    }
    public static function loadProductlist__top(){
        require __ROOT__ .'/html/bits/homePage-top.html';
    }
    public static function loadProductlist__bottom() {
        echo '<div class="grid">';
        Product::displayAllProduct();
        echo '</div>';
    }
}

class AddProduct extends BasePage{
    public static function loadEssential(){
        $url = __BASE__ . "/script/addPoduct.js";
        echo "<script defer src=$url></script>";
    }
    public static function loadHeader(){
        echo '<p>Add A Product</p>';
    }
    public static function loadProductlist__top(){
        require __ROOT__ . '/html/bits/addProduct-top.html';
    }
    public static function loadProductlist__bottom() {
        require __ROOT__ . '/html/bits/addProduct-form.html';
    }
}
