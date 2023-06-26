<?php 

namespace Bank;

use Bank\Controllers\AccountController;
use Bank\Controllers\HomeController;
use Bank\Controllers\LoginController;
use Bank\Messages;


class App {

    static public function start(){
        $url = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($url);
        
        return self::router($url);

    }

    static private function router($url)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == '') {
            return (new HomeController)->index();
        }

        // Login
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'login') {
            return (new LoginController)->index();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 1 && $url[0] == 'login') {
            return (new LoginController)->login($_POST);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'logout') {
            return (new LoginController)->logout();
        }
       
        // Auth middleware
        if (!isset($_SESSION['user_email'])) {
            header('Location: /login');
            die;
        }
        //Auth middleware END

        // Bank
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 1 && $url[0] == 'accounts') {
           return (new AccountController)->index();
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 2 && $url[0] == 'account' && $url[1] == 'create') {
            return (new AccountController)->create();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 2 && $url[0] == 'account' && $url[1] == 'store') {
            return (new AccountController)->store($_POST);
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 3 && $url[0] == 'account' && $url[1] == 'edit') {
            return (new AccountController)->edit($url[2]);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 3 && $url[0] == 'account' && $url[1] == 'update') {
            return (new AccountController)->update($url[2], $_POST,0);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 3 && $url[0] == 'account' && $url[1] == 'withdraw') {
            return (new AccountController)->update($url[2], $_POST, 1);
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 3 && $url[0] == 'account' && $url[1] == 'delete') {
            return (new AccountController)->delete($url[2]);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' && count($url) == 3 && $url[0] == 'account' && $url[1] == 'destroy') {
            return (new AccountController)->destroy($url[2]);
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET' && count($url) == 3 && $url[0] == 'account' && $url[1] == 'destroy') {
            return (new AccountController)->destroy($url[2]);
        }
        // Bank END
        {
            return self::view('404', [
                'pageTitle' => 'Page Not Found 404',
            ]);
        }
    }

    static public function view($path, $data = null)
    {
        if ($data) {
            extract($data);
        }

        ob_start();

        require __DIR__ . '/../views/top.php';
        require __DIR__.'/../views/messages.php';
        require __DIR__ . '/../views/' . $path . '.php';
        require __DIR__ . '/../views/bottom.php';

        return ob_get_clean();
    }



}