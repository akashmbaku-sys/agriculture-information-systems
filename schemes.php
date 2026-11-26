<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Government schemes';
$schemes = $pdo->query('SELECT * FROM government_schemes ORDER BY name')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">Public support</div><h1 class="h2 fw-bold mt-2">Agricultural schemes</h1><p class="text-secondary mb-0">Review the listed eligibility and application information; confirm details on the official portal.</p></div></section>
<section class="section-space"><div class="container"><div class="row g-3">
<?php foreach ($schemes as $scheme): ?><div class="col-md-6"><article class="feature-card"><h2 class="h5 fw-bold"><?= e($scheme['name']) ?></h2><p class="content-copy"><?= e($scheme['description']) ?></p><p class="small mb-2"><strong>Eligibility:</strong> <?= e($scheme['eligibility']) ?></p><p class="small mb-3"><strong>Documents:</strong> <?= e($scheme['required_documents']) ?></p><p class="small text-secondary content-copy"><?= e($scheme['application_procedure']) ?></p><?php if ($scheme['official_url']): ?><a href="<?= e($scheme['official_url']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-sm">Official application/details</a><?php endif; ?></article></div><?php endforeach; ?>
<?php if (!$schemes): ?><div class="col-12"><p class="text-secondary">Scheme information will appear here when it is added.</p></div><?php endif; ?>
</div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
