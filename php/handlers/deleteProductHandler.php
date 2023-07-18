<?php
require_once '../productClasses.php';
(function(){
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product'])){
        Product::deleteSelectedBySku($_POST['product']);
        header("Location: /assigment_scandiweb");
    } else {
        header("Location: /");
    }
})();