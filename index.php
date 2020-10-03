<?php
require ("./vendor/autoload.php");
require("./src/example/UserRoute.php");
require("./src/example/ProductRoute.php");

try {

    global $userRouter;
    global $productRouter;

    $routerManager = new \Router\RouteManager($_GET["url"]);
    $routerManager->use("user/", $userRouter);
    $routerManager->use("product/", $productRouter);
    $routerManager->parse();

} catch (Exception $e) {
    echo "<strong>ERROR : </strong>";
    die($e->getMessage());

}



