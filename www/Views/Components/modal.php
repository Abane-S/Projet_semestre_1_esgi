<?php if (isset($config)): ?>
    <div class="modal" id="modal1" >
        <section>
            <header>
                <h1 class="mb-2 fs-3"><?= $config["title"] ?></h1>
            </header>
            <div class="modal_content">
                <p class="fs-2 mb-2"><?= $config["content"] ?></p>
            </div>
            <footer>
                <a href="<?= $config['redirect']; ?>" class="button button-<?= $config['button-color']??"primary"?> button-md"><?=$config['button-message']??"fermer"?></a>
                <?php if (isset($config['second-button'])): ?>
                    <a href="<?= $config['second-button-redirect']?? "/dasboard" ?>" class="button button-primary button-md ml-2"><?= $config['second-button'] ?></a>
                <?php endif; ?>
            </footer>
        </section>
    </div>
<?php endif; ?>
