<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Market prices';
$prices = $pdo->query('SELECT * FROM market_prices ORDER BY price_date DESC, crop_name, price_per_quintal DESC')->fetchAll();
$history = $pdo->query('SELECT crop_name, price_date, MIN(price_per_quintal) AS low_price, MAX(price_per_quintal) AS high_price, AVG(price_per_quintal) AS average_price FROM market_prices GROUP BY crop_name, price_date ORDER BY price_date DESC, crop_name LIMIT 30')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">Market intelligence</div><h1 class="h2 fw-bold mt-2">Compare crop prices</h1><p class="text-secondary mb-0">Demonstration prices are maintained by the administrator. Check your local mandi before trading.</p></div></section>
<section class="section-space"><div class="container"><div class="form-panel mb-4"><h2 class="h5 fw-bold">Available prices</h2><div class="table-responsive"><table class="table table-hover align-middle"><thead><tr><th>Crop</th><th>Market</th><th>Location</th><th>Price / quintal</th><th>MSP / quintal</th><th>Date</th></tr></thead><tbody>
<?php foreach ($prices as $price): ?><tr><td><?= e($price['crop_name']) ?></td><td><?= e($price['market_name']) ?></td><td><?= e($price['location']) ?></td><td class="fw-semibold">₹<?= number_format((float)$price['price_per_quintal'],2) ?></td><td><?= $price['msp_per_quintal'] !== null ? '₹'.number_format((float)$price['msp_per_quintal'],2) : '—' ?></td><td><?= e($price['price_date']) ?></td></tr><?php endforeach; ?>
<?php if (!$prices): ?><tr><td colspan="6" class="text-secondary">No prices are available yet.</td></tr><?php endif; ?>
</tbody></table></div></div>
<div class="form-panel"><h2 class="h5 fw-bold">Price history by crop and date</h2><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Crop</th><th>Date</th><th>Low</th><th>Average</th><th>High</th></tr></thead><tbody>
<?php foreach ($history as $item): ?><tr><td><?= e($item['crop_name']) ?></td><td><?= e($item['price_date']) ?></td><td>₹<?= number_format((float)$item['low_price'],2) ?></td><td>₹<?= number_format((float)$item['average_price'],2) ?></td><td>₹<?= number_format((float)$item['high_price'],2) ?></td></tr><?php endforeach; ?>
</tbody></table></div></div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
