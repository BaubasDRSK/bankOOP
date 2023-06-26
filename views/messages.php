<?php use Bank\Messages; ?>

<?php if (Messages::ifMessages()) : ?>
    <div class="alert-container">
        <?php foreach (Messages::getMessages() as $message) : ?>
            <div class="alert alert-<?= $message['type'] ?>" role="alert">
                <?= $message['message'] ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>