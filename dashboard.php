<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
farmer_only();
$pageTitle = 'Farmer dashboard';
$counts = [];
foreach (['crops'=>'crops', 'market prices'=>'market_prices', 'schemes'=>'government_schemes'] as $label=>$table) {
    $counts[$label] = (int) $pdo->query("SELECT COUNT(*) FROM {$table}")->fetchColumn();
}
$prices = $pdo->query('SELECT crop_name, market_name, location, price_per_quintal, price_date FROM market_prices ORDER BY price_date DESC, id DESC LIMIT 4')->fetchAll();
$weather = $pdo->query('SELECT location, temperature, rainfall, humidity, forecast, advice, recorded_at FROM weather ORDER BY recorded_at DESC, id DESC LIMIT 1')->fetch();
$schemes = $pdo->query('SELECT name, description, official_url FROM government_schemes ORDER BY id DESC LIMIT 3')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">Farmer dashboard</div><h1 class="h2 fw-bold mt-2">Welcome, <?= e($_SESSION['user_name'] ?? 'Farmer') ?>.</h1><p class="text-secondary mb-0">Your agriculture information, all in one place.</p></div></section>
<section class="section-space"><div class="container">
    <div class="row g-3 mb-4"><?php foreach ($counts as $label=>$count): ?><div class="col-6 col-lg-4"><div class="stat-card"><div class="text-secondary text-capitalize"><?= e($label) ?></div><div class="stat-number"><?= e($count) ?></div></div></div><?php endforeach; ?></div>
    <div class="row g-4">
        <div class="col-lg-7"><div class="form-panel"><div class="d-flex justify-content-between align-items-center"><h2 class="h5 fw-bold">Latest market prices</h2><a href="prices.php">View all</a></div>
            <?php if (!$prices): ?><p class="text-secondary">No market prices have been added yet.</p><?php else: ?><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Crop</th><th>Market</th><th>Price / quintal</th></tr></thead><tbody><?php foreach ($prices as $price): ?><tr><td><?= e($price['crop_name']) ?></td><td><?= e($price['market_name']) ?></td><td>₹<?= number_format((float)$price['price_per_quintal'], 2) ?></td></tr><?php endforeach; ?></tbody></table></div><?php endif; ?>
        </div></div>
        <div class="col-lg-5"><div class="form-panel h-100"><h2 class="h5 fw-bold">Weather snapshot</h2>
            <?php if ($weather): ?><p class="mb-1"><strong><?= e($weather['location']) ?></strong> · <?= e($weather['recorded_at']) ?></p><p class="mb-1">Temperature: <?= e($weather['temperature']) ?> °C · Rainfall: <?= e($weather['rainfall']) ?> mm</p><p>Humidity: <?= e($weather['humidity']) ?>% · <?= e($weather['forecast']) ?></p><p class="text-secondary mb-0"><?= e($weather['advice']) ?></p><?php else: ?><p class="text-secondary">No weather updates have been added yet.</p><?php endif; ?>
            <a href="weather.php" class="d-inline-block mt-3">Weather details →</a>
        </div></div>
        <div class="col-12"><div class="form-panel"><h2 class="h5 fw-bold">Scheme highlights</h2><div class="row g-3"><?php foreach ($schemes as $scheme): ?><div class="col-md-4"><h3 class="h6"><?= e($scheme['name']) ?></h3><p class="small text-secondary"><?= e(mb_strimwidth($scheme['description'], 0, 150, '…')) ?></p><?php if ($scheme['official_url']): ?><a href="<?= e($scheme['official_url']) ?>" target="_blank" rel="noopener noreferrer">Official details →</a><?php endif; ?></div><?php endforeach; ?><?php if (!$schemes): ?><p class="text-secondary">No schemes have been added yet.</p><?php endif; ?></div></div></div>
    </div>
</div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
