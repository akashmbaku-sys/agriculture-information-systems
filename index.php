<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Grow with better information';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="container"><div class="hero-content">
        <div class="eyebrow mb-3">Better information. Better harvests.</div>
        <h1 class="display-4 fw-bold">Your farm deserves a stronger growing season.</h1>
        <p class="lead my-4">Find practical crop guidance, local market prices, weather updates and useful agricultural schemes in one place.</p>
        <a href="register.php" class="btn btn-lime btn-lg me-2">Create farmer account</a>
        <a href="crops.php" class="btn btn-outline-light btn-lg">Explore information</a>
    </div></div>
</section>
<section class="section-space">
    <div class="container">
        <div class="row align-items-end mb-4"><div class="col-md-8"><div class="eyebrow text-success">One helpful platform</div><h2 class="fw-bold mt-2">Make informed decisions at every step</h2></div><div class="col-md-4 text-md-end"><a href="dashboard.php" class="link-success">Farmer dashboard →</a></div></div>
        <div class="row g-3">
            <?php foreach ([['🌱','Crop guidance','Cultivation, soil, seed and plant health information.','crops.php'],['₹','Market intelligence','Compare available crop prices and MSP references.','prices.php'],['☁','Weather updates','Review local forecasts and practical field suggestions.','weather.php'],['✓','Schemes & resources','Browse scheme information and agricultural resources.','schemes.php']] as [$icon,$title,$text,$link]): ?>
                <div class="col-sm-6 col-lg-3"><a class="text-decoration-none text-reset" href="<?= e($link) ?>"><div class="feature-card"><span class="feature-icon"><?= e($icon) ?></span><h3 class="h5 mt-3"><?= e($title) ?></h3><p class="text-secondary mb-0"><?= e($text) ?></p></div></a></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="soft-bg section-space"><div class="container"><div class="row g-4 align-items-center">
    <div class="col-lg-7"><div class="eyebrow text-success">About AgriConnect</div><h2 class="fw-bold mt-2">Agriculture information, made easier to access.</h2><p class="text-secondary">AgriConnect brings together practical farming information and local updates. Farmers can save an account, send a question and return to the dashboard for the latest information entered by the administrator.</p><a href="contact.php" class="btn btn-success">Ask an expert</a></div>
    <div class="col-lg-5"><div class="form-panel"><h3 class="h5">Need a hand?</h3><p class="text-secondary mb-2">Send a question through our contact form. An administrator can review it in the local demo panel.</p><a href="contact.php">Contact the team →</a><hr><p class="small text-secondary mb-0">For urgent agronomic or government services, contact your local agriculture office.</p></div></div>
</div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
