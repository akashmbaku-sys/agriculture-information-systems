<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Weather information';
$weather = $pdo->query('SELECT * FROM weather ORDER BY recorded_at DESC, id DESC')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">Weather desk</div><h1 class="h2 fw-bold mt-2">Plan around the weather</h1><p class="text-secondary mb-0">Forecast information and suggestions supplied by the administrator.</p></div></section>
<section class="section-space"><div class="container"><div class="row g-3">
<?php foreach ($weather as $item): ?><div class="col-md-6 col-lg-4"><article class="feature-card"><div class="d-flex justify-content-between"><span class="feature-icon">☁</span><span class="small text-secondary"><?= e($item['recorded_at']) ?></span></div><h2 class="h5 mt-3"><?= e($item['location']) ?></h2><p class="mb-1"><strong><?= e($item['temperature']) ?> °C</strong> · Humidity <?= e($item['humidity']) ?>%</p><p class="mb-2">Rainfall: <?= e($item['rainfall']) ?> mm · <?= e($item['forecast']) ?></p><p class="text-secondary mb-0"><?= e($item['advice']) ?></p></article></div><?php endforeach; ?>
<?php if (!$weather): ?><div class="col-12"><p class="text-secondary">Weather information has not been added yet.</p></div><?php endif; ?>
</div><p class="small text-secondary mt-4">Use official meteorological services for time-critical forecasts and warnings.</p></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
