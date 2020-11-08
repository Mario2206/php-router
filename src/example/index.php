<?php
require ("../../vendor/autoload.php");


try {


    $router = new \Router\Router($_GET["url"]);

    $router->get("/test/:id/:test/:fkdql", function ($id, $test) {
        echo $id . " " . $test;
    });

    $router->parse();

} catch (Exception $e) {
    echo "<strong>ERROR : </strong>";
    die($e->getMessage());

}



