<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Crop information';
$crops = $pdo->query('SELECT * FROM crops ORDER BY name')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">Crop knowledge</div><h1 class="h2 fw-bold mt-2">Grow with confidence</h1><p class="text-secondary mb-0">Cultivation notes and practical crop information from your administrator.</p></div></section>
<section class="section-space"><div class="container"><div class="row g-4">
<?php foreach ($crops as $crop): ?>
    <div class="col-md-6 col-xl-4"><article class="info-card">
        <?php if ($crop['image_url']): ?><img src="<?= e($crop['image_url']) ?>" alt="<?= e($crop['name']) ?>" loading="lazy"><?php else: ?><div class="d-flex align-items-center justify-content-center bg-light" style="height:190px;font-size:3rem" role="img" aria-label="Crop illustration">🌱</div><?php endif; ?>
        <div class="card-body"><h2 class="h5 fw-bold"><?= e($crop['name']) ?></h2>
            <p class="small text-secondary mb-2"><strong>Soil:</strong> <?= e($crop['soil_requirements']) ?></p>
            <p class="small content-copy"><?= e($crop['cultivation_details']) ?></p>
            <details><summary class="text-success">Seeds, fertilizer & irrigation</summary><p class="small mt-2 mb-1"><strong>Seeds:</strong> <?= e($crop['seed_information']) ?></p><p class="small mb-1"><strong>Fertilizer:</strong> <?= e($crop['fertilizer_recommendations']) ?></p><p class="small mb-1"><strong>Irrigation:</strong> <?= e($crop['irrigation_methods']) ?></p><p class="small mb-0"><strong>Pest & disease:</strong> <?= e($crop['pest_management']) ?></p></details>
        </div>
    </article></div>
<?php endforeach; ?>
<?php if (!$crops): ?><div class="col-12"><p class="text-secondary">Crop information will appear here when it is added.</p></div><?php endif; ?>
</div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
