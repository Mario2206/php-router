<?php
$productRouter = new Router\Router($_GET["url"]);


$productRouter->get("/:id", function (string $id) {
    echo "product page id :" . $id;
});

$productRouter->get("test/:id", function ($id) {
    echo "test page " . $id;
});

