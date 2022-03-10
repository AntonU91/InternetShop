<?php
return array(
    'product/([0-9]+)' => 'product/view/$1',//actionView  ProductController
    'catalog' => 'catalog/index', //actionIndex в CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory в CatalogController
    'register' => 'user/register',
    'cabinet' => 'cabinet/index', //actionIndex в CabinetController
    'user/login' => "user/login",
    'user/register' => 'user/register',
    'user/logout' => 'user/logout',
    'cabinet/edit' => "user/edit",

    '' => 'site/index', // actionIndex в siteController
);
