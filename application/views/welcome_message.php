<section class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h1 class="h3 mb-3">Witaj w aplikacji CodeIgniter 3!</h1>
                <p class="text-muted">To lekka baza projektu gotowa do wdrażania funkcji Voicebota.</p>
                <ul class="list-group list-group-flush mb-3">
                    <?php foreach ($features as $feature): ?>
                        <li class="list-group-item"><?= html_escape($feature) ?></li>
                    <?php endforeach; ?>
                </ul>
                <a class="btn btn-primary" href="<?= site_url('contact') ?>">Skontaktuj się z nami</a>
            </div>
        </div>
    </div>
</section>
