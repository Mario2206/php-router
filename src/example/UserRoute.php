<?php

$userRouter = new Router\Router($_GET["url"]);

$userRouter->get("", function () {
    echo "null";
});

$userRouter->get("product/", function () {
    echo "product page";
});

$userRouter->get("users/:id", function ($id) {
    echo "users page " . $id;
});

$userRouter->post("test/:id", function ($id) {
    echo "test : " . $id;
});

$userRouter->update("action/:var/:mix/:thing", function ($var, $mix, $thing) {
    echo "update action " . $var . " " . $mix . " " . $thing;
});

$userRouter->delete("articles/:id", function ($id) {
    echo "article id : " . $id . " deleted";
});