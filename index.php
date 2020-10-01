<?php
require("./src/Route.php");
require("./src/DynamicRoute.php");
require("./src/Router.php");


try {

    $router = new Router\Router($_GET["url"]);


    $router->get("product/:id/:test", function ($id, $test) {
        echo $id;
        echo $test;
        echo "product page";
    });
    $router->get("users/", function () {
        echo "users page";
    });

    $router->parse();

} catch (Exception $e) {
    echo "<strong>ERROR : </strong>";
    die($e->getMessage());

}



