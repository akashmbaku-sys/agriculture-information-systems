<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/database.php';
$pageTitle = 'Farmer registration';
$errors = [];
$name = $mobile = $email = $address = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string) ($_POST['name'] ?? ''));
    $mobile = trim((string) ($_POST['mobile'] ?? ''));
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $address = trim((string) ($_POST['address'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    if ($name === '' || mb_strlen($name) > 120) $errors[] = 'Enter your name (up to 120 characters).';
    if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $mobile)) $errors[] = 'Enter a valid mobile number.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) $errors[] = 'Enter a valid email address.';
    if ($address === '' || mb_strlen($address) > 500) $errors[] = 'Enter your address (up to 500 characters).';
    if (strlen($password) < 8) $errors[] = 'Password must be at least 8 characters.';
    if (!$errors) {
        try {
            $statement = $pdo->prepare('INSERT INTO users (name, mobile, email, address, password) VALUES (:name, :mobile, :email, :address, :password)');
            $statement->execute(['name'=>$name, 'mobile'=>$mobile, 'email'=>$email, 'address'=>$address, 'password'=>password_hash($password, PASSWORD_DEFAULT)]);
            flash('Your account is ready. Please sign in.');
            header('Location: login.php');
            exit;
        } catch (PDOException $exception) {
            if ($exception->getCode() === '23000') $errors[] = 'That email address is already registered.';
            else throw $exception;
        }
    }
}
require __DIR__ . '/includes/header.php';
?>
<section class="section-space"><div class="container"><div class="row justify-content-center"><div class="col-lg-7"><div class="form-panel">
    <h1 class="h2 fw-bold">Join AgriConnect</h1><p class="text-secondary">Create a farmer account to access your personalized dashboard.</p>
    <?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
    <form method="post" novalidate>
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <div class="mb-3"><label class="form-label" for="name">Full name</label><input class="form-control" id="name" name="name" required maxlength="120" value="<?= e($name) ?>"></div>
        <div class="row"><div class="col-md-6 mb-3"><label class="form-label" for="mobile">Mobile number</label><input class="form-control" id="mobile" name="mobile" required maxlength="20" value="<?= e($mobile) ?>"></div>
        <div class="col-md-6 mb-3"><label class="form-label" for="email">Email</label><input class="form-control" id="email" name="email" type="email" required maxlength="190" value="<?= e($email) ?>"></div></div>
        <div class="mb-3"><label class="form-label" for="address">Address / village</label><textarea class="form-control" id="address" name="address" rows="2" required maxlength="500"><?= e($address) ?></textarea></div>
        <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" id="password" name="password" type="password" minlength="8" required autocomplete="new-password"></div>
        <button class="btn btn-success">Create account</button> <a class="btn btn-link" href="login.php">Already registered?</a>
    </form>
</div></div></div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
