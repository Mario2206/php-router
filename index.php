<?php
require ("./vendor/autoload.php");


try {

    $router = new Router\Router($_GET["url"]);


    $router->get("product/", function () {
        echo "product page";
    });

    $router->get("users/", function () {
        echo "users page";
    });

    $router->post("test/:id", function ($id) {
        echo "test : " . $id;
    });

    $router->update("action/:var/:mix/:thing", function ($var, $mix, $thing) {
        echo "update action " . $var . " " . $mix . " " . $thing;
    });

    $router->delete("articles/:id", function ($id) {
        echo "article id : " . $id . " deleted";
    });

    $router->parse();

} catch (Exception $e) {
    echo "<strong>ERROR : </strong>";
    die($e->getMessage());

}



