<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
if (!empty($_SESSION['user_id'])) { header('Location: dashboard.php'); exit; }
$pageTitle = 'Farmer login';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $statement = $pdo->prepare('SELECT id, name, password FROM users WHERE email = :email LIMIT 1');
    $statement->execute(['email'=>$email]);
    $user = $statement->fetch();
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Email or password is incorrect.';
}
require __DIR__ . '/includes/header.php';
?>
<section class="section-space"><div class="container"><div class="row justify-content-center"><div class="col-md-6 col-lg-5"><div class="form-panel">
    <h1 class="h2 fw-bold">Welcome back</h1><p class="text-secondary">Sign in to your farmer account.</p>
    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" id="email" name="email" type="email" autocomplete="username" required></div>
        <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required></div>
        <button class="btn btn-success w-100">Sign in</button>
    </form><p class="mt-3 mb-0 small">New to AgriConnect? <a href="register.php">Create an account</a></p>
</div></div></div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
