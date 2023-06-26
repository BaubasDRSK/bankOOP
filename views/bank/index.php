<?php include 'header.php'; ?>
<main class="main-content list">
        <div class="main-content-wrapp">         
            <ul class="list-header">
                <li class="user-item">
                            <p>ID </p>
                            <p>First Name</p>
                            <p>Last Name</p>
                            <p>Personal ID</p>
                            <p>IBAN</p>
                            <p>Balance</p>
                            <p>Actions</p>
                </li>
            </ul>   
            <ul class="user-list">
                <?php foreach ($accounts as $a) :?>
                    <?php 
                        $balance = $a['balance'] / 100;
                        $regex = "/(\d)(?=(\d{8})+(?!\d))/";
                        $balance = preg_replace($regex, ",", $balance)." €";
                    ?>
                    <li class="user-item">
                        <p><?= $a['id']?></p>
                        <p><?= $a['fname']?></p>
                        <p><?= $a['lname']?></p>
                        <p><?= $a['pid']?></p>
                        <p><?= $a['iban']?></p>
                        <p><?= $balance?></p>
                        <p> 
                            <a href=<?= "/account/edit/".$a['id']?> class="acction">
                                <img src="./img/money.svg" alt="money" width="30px">                            
                            </a>
                            <span>   </span>  
                            <a href=<?= "/account/delete/".$a['id']?> class="acction">
                                <img src="./img/delete.svg" alt="delete" width="30px">
                            </a>
                        </p>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        
    </main>