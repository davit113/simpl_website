<?php
require_once '../productClasses.php';
(function(){
    if ($_SERVER["REQUEST_METHOD"] === "POST" ){
        Product::addNewProduct($_POST);
        header("Location: /assigment_scandiweb");
    } else {
        header("Location: /");
    }

})();
