<?php include 'header.php'; ?>
    <main class="main-content">
        <div class="login-wrapp">
                <div class="main-form">
                    <form action="<?= '/account/update/'.$id?>" method="post" class="login-form">
                        <h1 class="main-h">You can edit account balance</h1>
                        <p class="info">ID: <?=$id?></p>
                        <p class="info">User: <?=$fname." ".$lname?></p>
                        <p class="info">IBAN: <?=$iban?></p>
                        <p class="info">Actual balance: <?=$balance_curency?></p>
                        <div class="input">
                            <label for="amount">Amount:</label>
                            <input id="input" type="text" name="amount" id="amount"  placeholder="Enter amount" required>
                        </div>
                        <button class="btn-green" type="submit" name="add" value=<?=1?>>Add</button>
                        <button class="btn-red" type="submit" name="minus" value=<?=1?>>Minus</button>

                        <a href="/accounts" class="btn-blue" >DONE / CANCEL</a>

                    </form>
                </div>
            </div>
    </main>
    <script>
        const input = 'input';
        const options = {
            currency: 'EUR',
            locale: 'de',
            min: 0
            }
        const cinput = new CurrencyInput(input, options);
    </script>