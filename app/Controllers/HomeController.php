<?php
namespace Bank\Controllers;
use Bank\App;

class HomeController
{
    public function index()
    {
        return App::view('home/index', [
            'pageTitle' => 'BankASS',
        ]);
    }


}