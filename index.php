<?php
require("./src/Route.php");
require("./src/Router.php");

try {

    $router = new Router\Router($_GET["url"]);

    $router->get("product/", function () {
        echo "product page";
    });
    $router->get("product/", function () {
        echo "product page";
    });
    $router->get("users/", function () {
        echo "users page";
    });
    $router->post("product/", function () {
        echo "post product";
    });

    $router->parse();

} catch (Exception $e) {

    die($e->getMessage());

}



