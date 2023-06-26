<?php include 'header.php'; ?>
    <main class="main-content">
        <div class="login-wrapp">
                <div class="main-form">
                    
                    <form action="/account/store" method="post" class="login-form">
                    <h1 class="main-h">Please enter new account details</h1>
                        <p class="info">Please enter all essential fields</p>
                        <p class="info"><?= $id?></p>
                        <div style="display:none;">
                            <input type="text" name="id" id="id" value=<?= $id ?> required>
                        </div>

                        <div class="input">
                            <label for="fname">First name</label>
                            <img src="/img/person.svg" alt="fname">
                            <input type="text" name="fname" id="fname"  placeholder="Enter your first name" value="<?=$fname?>" required>
                        </div>
                        
                        <div class="input">
                            <label for="lname">Last name</label>
                            <img src="/img/person.svg" alt="lname">
                            <input type="text" name="lname" id="lname" placeholder="Enter your last name" value="<?=$lname?>" required>
                        </div>
                        
                        <div class="input">
                            <label for="pid">Personal ID</label>
                            <img src="/img/pid.svg" alt="pid">
                            <input type="number" name="pid" id="pid" placeholder="Enter your PID"  value="<?=$pid?>" required>
                        </div>

                        <div class="input">
                            <label for="iban">IBAN Account</label>
                            <img src="/img/iban.svg" alt="iban">
                            <input type="text" name="iban" id="iban"   value=<?=$iban?> readonly >
                        </div>
                        
                        
                        <button class="btn-blue" type="submit">Create new account</button>
                        <a href="/accounts" class="btn-red" >Cancel</a>

                    </form>
                </div>
            </div>
    </main>