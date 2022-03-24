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
    "contacts" => "site/contact",
    "cart/add/([0-9]+)" => "cart/add/$1",
    "cart" => "cart/index",
    'cart/checkout' => 'cart/checkout',

    '' => 'site/index', // actionIndex в siteController
);
