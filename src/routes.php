<?php
return function (\Slim\Slim $app) {
    $app->get('/', function () use ($app) {
        $app->render('home.twig', ['page' => 'home']);
    })->name('home');
};
