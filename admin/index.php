<?php
require "views/header.php" ;


$routes = [
    '/'=> 'views/pages/index.view.php',
    '/users'=>'views/pages/users.view.php',
    '/product'=>'views/pages/product.view.php',
    '/comments'=>'views/pages/comment.view.php',
    '/Coupons'=>'views/pages/coupons.view.php',
    '/Password'=>'views/pages/password.view.php',
    '404'=>'views/pages/404.view.php',
];
if(array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
    require $routes[$_SERVER['REQUEST_URI']];
}else{
    require "views/pages/404.view.php";
}


require "views/footer.php"
?>


