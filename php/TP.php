
<?php 
require_once 'config.php';

$class = Config::getPageTPClass(CURRENT_PAGE);
if(!$class){
    die('something went wrong. try again later');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo __BASE__ . "/css/stylesheet.css"?>>
    <title>scandiweb</title>
</head>
<body class="body">
    <?php $class::loadEssential();?>
    <div class="body__wraper">
        <header class="header">
            <div class="header__wraper content-width">
                <?php $class::loadHeader();?>
            </div>
        </header>
        <main class="main">
            <div class="main__wraper content-width">
                <?php $class::loadMain();?>
            </div>
        </main>
        <footer class="footer">
            <div class="footer__wraper content-width">
                <h2>Scandiwer Test assigment</h2>
            </div>
        </footer>
    </div>
</body>
</html>