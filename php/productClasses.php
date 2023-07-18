<?php
require_once 'connect.php';

class Product{
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($params) {
        $this->sku = $params['sku'];
        $this->name = $params['name'];
        $this->price = $params['price'];
    }

    public function selfDis(){}

    public static function displayAllProduct(){
        $pdo = DB::connectDB(); 
        $sql ='SELECT * FROM product 
               LEFT JOIN book ON book.product_sku = product.sku
               LEFT JOIN dvd ON dvd.product_sku = product.sku
               LEFT JOIN furniture ON furniture.product_sku = product.sku;';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $products = $stmt->fetchAll();

        foreach($products as $val){
            $dis ='';
            if(isset($val['book_weight'])){
                $dis = 'weight:'.$val['book_weight'] . ' KG';
            } else if(isset($val['dvd_size'])){
                $dis = 'size:'.$val['dvd_size'] . ' MB';
            } else if(isset($val['width'])){
                $dis = 'Dimension: ' . $val['width']  . 'X' . $val['length'] . 'X' . $val['height'] ;
            }
            echo      '<div class="item">'
                    . '<input form ="formdel" value=' . $val['sku'] . ' type="checkbox" name="product[]" class="delete-checkbox"> '
                    . '<div class="item__wraper">'
                    . '<div>' . $val['sku'] . '</div>'
                    . '<div>' . $val['name'] . '</div>'
                    . '<div>' . $val['price'] . '$</div>'
                    . '<div>' . $dis . '</div>'
                    . '</div>'
                    . '</div>';
        }
    }
    public static function deleteSelectedBySku($val){        
        $pdo =DB::connectDB();
        $val = is_array($val) ? $val : [$val];
        foreach($val as $sku){
            $query = "DELETE FROM product WHERE sku = :sku";
            $stmt =$pdo->prepare($query);
            $stmt->bindParam(':sku', $sku);
            $stmt->execute();
        }
    }
    public static function addNewProduct($arr){ 
        $pdo =DB::connectDB();
        $sql = 'SELECT sku FROM product where product.sku = "' . $arr['sku'] .'";';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();

        if(!isset($products[0]['sku'])){
            if($arr['size']!==''){
                $prod = new DVD($arr);
            }else if($arr['weight']!==''){
                $prod = new Book($arr);
            }else if($arr['width']){
                $prod = new Furniture($arr);
            }
            $prod->insertSelfIntoDB();
        }
    }

    protected function insertSelfIntoDB(){
        $pdo =DB::connectDB();
        $query ="INSERT INTO product (sku, name, price) VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->sku,$this->name,$this->price]);
    }
}

class DVD extends Product{
    private $size;

    public function __construct($params) {
        parent::__construct($params);
        $this->size = $params['size'];
    }
    public function insertSelfIntoDB(){
        parent::insertSelfIntoDB();
        $pdo =DB::connectDB();
        $query ="INSERT INTO dvd (dvd_size, product_sku) VALUES (?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->size, $this->sku]);
    }
}
class Book extends Product{
    private $weight;

    public function __construct($params) {
        parent::__construct($params);
        $this->weight = $params['weight'];
    }
    public function insertSelfIntoDB(){
        parent::insertSelfIntoDB();
        $pdo =DB::connectDB();
        $query ="INSERT INTO book (book_weight, product_sku) VALUES (?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->weight, $this->sku]);
    }
}
class Furniture extends Product{
    private $width;
    private $length;
    private $height;

    public function __construct($params) {
        parent::__construct($params);
        $this->width =$params['width'];
        $this->length =$params['length'];
        $this->height =$params['height'];
    }
    public function insertSelfIntoDB(){
        parent::insertSelfIntoDB();
        $pdo =DB::connectDB();
        $query ="INSERT INTO furniture (width, length, height, product_sku) VALUES (?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->width, $this->length, $this->height, $this->sku]);
    }
}