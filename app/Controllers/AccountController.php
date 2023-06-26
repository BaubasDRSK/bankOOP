<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\FileWriter;
use Bank\IbanId;
use Bank\OldData;
use Bank\Messages;


class AccountController
{
    public function index()
    {
            $data = new FileWriter('accounts');
            
            return App::view('bank/index', [
                'pageTitle' => 'List of bank accounts',
                'accounts' => $data->showAll(),
            ]);
    }

    public function create()
    {   
        $old = OldData::getFlashData() ?? [];

        $fname = $old['fname'] ?? '';
        $lname = $old['lname'] ?? '';
        $id = $old['id'] ?? IbanId::newId();
        $iban = $old['iban'] ?? IbanId::generateLithuanianIBAN();
        $pid = $old['pid'] ?? null;
        
        return App::view('bank/create', [
            'pageTitle' => 'Create new account',
            'id' => $id,
            'iban' => $iban,
            'fname' => $fname,
            'lname' => $lname,
            'pid' => $pid
        ]);
    }

    public function store(array $request)
    {   
        extract($request);
        $error1 = 0;
        $error2 = 0;
        $error3 = 0;
        $error4 = 0;

        $fname = trim($fname," ");
        $lname = trim($lname," ");

        if (!preg_match('/^[A-Z,Ą,Č,Ę,Ė,Į,Š,Ų,Ū,Ž][a-z,ą,č,ę,ė,į,š,ų,ū,ž]{2,}$/', $fname)){
            Messages::addMessage('danger', 'Firs name is incorrect');
            $error1 = 1;
        }   
    
        if (!preg_match('/^[A-Z,Ą,Č,Ę,Ė,Į,Š,Ų,Ū,Ž][a-z,ą,č,ę,ė,į,š,ų,ū,ž]{2,}$/', $lname)){
            Messages::addMessage('danger', 'Last name is incorrect');
            $error2 = 1;
        }
    
        if (!preg_match('/^(3[0-9]{2}|4[0-9]{2}|6[0-9]{2}|5[0-9]{2})(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])\d{4}$/', $pid)){
            Messages::addMessage('danger', 'Personal code is incorrect');
            $error3 = 1;
        } else {
            foreach ($accounts as $account){
                if ($account['pid'] == $pid){
                    Messages::addMessage('danger', 'Personal code already exists');
                    $error4 = 1;
                    break;
                }
            }
        }

        if ($error1 || $error2 || $error3 || $error4) {
            OldData::flashData($request);
            header("Location: /account/create");
            die;
        }

       
        $data = new FileWriter('accounts');
        $newAccount = ['id'=>$id, 'fname'=>$fname, 'lname'=>$lname, 'pid'=>$pid, 'iban'=>$iban, 'balance'=>0];
        $data->create($newAccount);

        header('Location: /accounts');
    }

    public function edit(int $id)
    {
        $data = new FileWriter('accounts');
        $account = $data->show($id);

        
        $id = $account['id'];
        $fname = $account['fname'];
        $lname = $account['lname'];
        $pid = $account['pid'];
        $iban = $account['iban'];
        $balance = $account['balance'];
        $balance_curency = $account['balance'] / 100;
        $regex = "/(\d)(?=(\d{8})+(?!\d))/";
        $balance_curency = preg_replace($regex, ",", $balance_curency)." €";

        return App::view('bank/edit', [
            'pageTitle' => 'Edit account',
            'id' => $id,
            'fname' => $fname,
            'lname' => $lname,
            'pid' => $pid,
            'iban' => $iban,
            'balance' => $balance,
            'balance_curency' => $balance_curency
        ]);
    }

    public function update(int $id, array $request, int $delete = 0) 
    {   

        $data = new FileWriter('accounts');
        $account = $data->show($id);

        $amount = $request['amount'];

        if (str_contains($amount, "€")){
        $number = str_replace(".", "", $amount);
        $number = str_replace(",", ".", $number);
        } else {
            $number = $amount;
        }
        $value100 = ((float) $number)*100;

        
        if (isset($request['add'])){

            if ($value100 <=0 ){
                Messages::addMessage('danger', 'Amount is less than 0');
                header('Location: /account/edit/'.$id);
                die;
            }
            $account['balance'] += $value100;
            
            $data->update($id, $account);
            Messages::addMessage('success', 'Balance was updated');
            header('Location: /account/edit/'.$id);
        }
        

        if (isset($_POST['minus'])){
            if ($value100 <=0 ){
                Messages::addMessage('danger', 'Amount is less than 0 '.$value100." ".$request['amount']);
                header('Location: /account/edit/'.$id);
                die;
            }

            if ($account['balance'] < $value100){
                Messages::addMessage('danger', 'Insufficient balance');
                header('Location: /account/edit/'.$id);;
                die;
            }

            $account['balance'] -= $value100;
            
            $data->update($id, $account);
            Messages::addMessage('success', 'Balance was updated');

            if ($delete == 0){
            header('Location: /account/edit/'.$id);
            } else {
                header('Location: /account/delete/'.$id);
            }   
            
        }
    }   

    public function delete(int $id)
    {
        $account = (new FileWriter('accounts'))->show($id);

        $id = $account['id'];
        $fname = $account['fname'];
        $lname = $account['lname'];
        $pid = $account['pid'];
        $iban = $account['iban'];
        $balance = $account['balance'];
        $balance_curency_tmp = $account['balance'] / 100;
        $regex = "/(\d)(?=(\d{8})+(?!\d))/";
        $balance_curency = preg_replace($regex, ",", $balance_curency_tmp)." €";

        return App::view('bank/delete', [
            'pageTitle' => 'Confirm racoon delete',
            'id' => $id,
            'fname' => $fname,
            'lname' => $lname,
            'pid' => $pid,
            'iban' => $iban,
            'balance' => $balance,
            'balance_curency' => $balance_curency
        ]);
    }

    public function destroy(int $id)
    {
        $data = new FileWriter('accounts');
        $account = $data->show($id);
        if ($account['balance']== 0){
        $data->delete($id);
        header('Location: /accounts');
        }else {
        Messages::addMessage('danger', 'Balance is not 0');
        header('Location: /account/delete/'.$id);
        }
    }


}