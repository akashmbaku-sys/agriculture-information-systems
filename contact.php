<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Contact and feedback';
$errors = [];
$name = $email = $subject = $message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $subject = trim((string) ($_POST['subject'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));
    if ($name === '' || mb_strlen($name) > 120) $errors[] = 'Enter your name (up to 120 characters).';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) $errors[] = 'Enter a valid email address.';
    if (!in_array($subject, ['query','feedback'], true)) $errors[] = 'Select query or feedback.';
    if ($message === '' || mb_strlen($message) > 5000) $errors[] = 'Enter a message (up to 5000 characters).';
    if (!$errors) {
        if ($subject === 'feedback') {
            $statement = $pdo->prepare('INSERT INTO feedback (user_id, name, email, message) VALUES (:user_id, :name, :email, :message)');
        } else {
            $statement = $pdo->prepare('INSERT INTO farmer_queries (user_id, name, email, subject, message) VALUES (:user_id, :name, :email, :subject, :message)');
        }
        $statement->execute(['user_id'=>$_SESSION['user_id'] ?? null, 'name'=>$name, 'email'=>$email, 'subject'=>$subject, 'message'=>$message]);
        flash('Thank you. Your message has been received.');
        header('Location: contact.php');
        exit;
    }
}
require __DIR__ . '/includes/header.php';
?>
<section class="page-heading"><div class="container"><div class="eyebrow text-success">We are here to help</div><h1 class="h2 fw-bold mt-2">Contact & feedback</h1><p class="text-secondary mb-0">Share a question or tell us how we can improve AgriConnect.</p></div></section>
<section class="section-space"><div class="container"><div class="row g-4">
    <div class="col-lg-7"><div class="form-panel"><h2 class="h5 fw-bold">Send a message</h2>
        <?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
        <form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <div class="mb-3"><label class="form-label" for="name">Name</label><input id="name" name="name" class="form-control" maxlength="120" required value="<?= e($name ?: ($_SESSION['user_name'] ?? '')) ?>"></div>
            <div class="mb-3"><label class="form-label" for="email">Email</label><input id="email" name="email" type="email" class="form-control" maxlength="190" required value="<?= e($email) ?>"></div>
            <div class="mb-3"><label class="form-label" for="subject">Message type</label><select id="subject" name="subject" class="form-select" required><option value="">Choose one</option><option value="query" <?= $subject === 'query' ? 'selected' : '' ?>>Ask a farming question</option><option value="feedback" <?= $subject === 'feedback' ? 'selected' : '' ?>>Share feedback</option></select></div>
            <div class="mb-3"><label class="form-label" for="message">Message</label><textarea id="message" name="message" class="form-control" rows="5" maxlength="5000" required><?= e($message) ?></textarea></div>
            <button class="btn btn-success">Send message</button>
        </form>
    </div></div>
    <div class="col-lg-5"><div class="feature-card"><span class="feature-icon">☎</span><h2 class="h5 mt-3">Expert assistance</h2><p class="text-secondary">Your message is saved for the administrator to review. For field-specific recommendations, include your crop, village, and a clear description of the issue.</p><hr><h3 class="h6">Need immediate help?</h3><p class="small mb-0">Contact your local agriculture extension office. For official scheme support, use the relevant government portal.</p></div></div>
</div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
