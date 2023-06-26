<?php include 'header.php'; ?>
    <main class="main-content">
        <div class="login-wrapp">
                <div class="main-form">
                    <?php if($balance) : ?>
                    <form action="<?='/account/withdraw/'.$id?>" method="post" class="login-form">
                        <h1 class="main-h">Are you shure you want to delete curent account</h1>
                        <p class="info">ID: <?=$id?></p>
                        <p class="info">User: <?=$fname." ".$lname?></p>
                        <p class="info">IBAN: <?=$iban?></p>
                        <p class="info">Actual balance: <?=$balance_curency?></p>
                        <?=($balance/100)?>
                        <div class="input" style="display:none;">
                            <input id="nematomas"  type="number" name="amount"  value="<?=($balance/100)?>" >
                        </div>
                        <p class="info note">Balance is not empty, do you want to withdraw all??</p>
                        <button class="btn-red" type="submit" name="minus" value=1>Widthraw all</button>
                        <a href="/accounts" class="btn-blue" >CANCEL</a>
                    </form>
                    <?php else :?>
                    <form action="<?='/account/destroy/'.$id?>" method="post" class="login-form">
                        <h1 class="main-h">Are you shure you want to delete curent account</h1>
                        <p class="info">ID: <?=$id?></p>
                        <p class="info">User: <?=$fname." ".$lname?></p>
                        <p class="info">IBAN: <?=$iban?></p>
                        <p class="info">Actual balance: <?=$balance_curency?></p>
                        <p class="info note">Balance is 0, you can delete account. Are you sure?</p>
                        <button type="submit" class="btn-red" name="id" value=<?=$id?>>OK DELETE</button>
                        <a href="/accounts" class="btn-blue" >CANCEL</a>
                    </form>
                    <?php endif?>
                </div>
            </div>
    </main>
    