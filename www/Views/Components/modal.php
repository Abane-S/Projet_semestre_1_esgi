

<div class="modal" id="modal1" >
    <section>
        <header>
            <h1 class="mb-4 fs-3"><?= $config["title"] ?></h1>
        </header>
        <div class="modal_content ">
            <p class="fs-2">
                <?= $config["content"] ?>
            </p>
        </div>
        <footer>
            <a  href="<?= $config['redirect']; ?>" class="button button-primary button-md">
                Fermer
            </a>
        </footer>
    </section>
</div>