<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Agricultural resources';
$resources = $pdo->query('SELECT * FROM agricultural_resources ORDER BY category, name')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">Farm resources</div><h1 class="h2 fw-bold mt-2">Tools and inputs for your farm</h1><p class="text-secondary mb-0">Explore resource information managed by the AgriConnect administrator.</p></div></section>
<section class="section-space"><div class="container"><div class="row g-3">
<?php foreach ($resources as $resource): ?><div class="col-sm-6 col-lg-4"><article class="feature-card"><span class="badge text-bg-success mb-3"><?= e($resource['category']) ?></span><h2 class="h5"><?= e($resource['name']) ?></h2><p class="text-secondary content-copy"><?= e($resource['description']) ?></p><?php if ($resource['contact_info']): ?><p class="small mb-0"><strong>Contact:</strong> <?= e($resource['contact_info']) ?></p><?php endif; ?></article></div><?php endforeach; ?>
<?php if (!$resources): ?><div class="col-12"><p class="text-secondary">Resources will appear here when added.</p></div><?php endif; ?>
</div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
