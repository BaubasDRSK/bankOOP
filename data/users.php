<?php


$users = [
   [
      'id' => 1686153563,
      'fname' => 'Povilas',
      'lname' => 'Grikis',
      'email' => 'povilas@clearbank.com',
      'psw' => '202cb962ac59075b964b07152d234b70'
    ]
   ];


file_put_contents(__DIR__ . '/users.json', json_encode($users));

echo "\n users.json created \n";