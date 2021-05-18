<?php

/*
|--------------------------------------------------------------------------
| Author
|--------------------------------------------------------------------------
|
| Name: Ryo ID
| Repo: https://github.com/ryodevz/mystore-simple-crud
|
*/

use Illuminate\Support\Auth;
use Illuminate\Support\Database;

require_once '../../bootstrap/core.php';

Auth::start();

if (Auth::check()) {
    return redirect('/');
}

allowedMethods(['GET', 'POST'], true);

if (isset($_POST['btn-submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = Database::query("SELECT * FROM users WHERE `email` = '$email'");

    if ($user->num_rows >= 1) {

        $user = $user->fetch_object();

        if (password_verify($password, $user->password)) {

            $_SESSION['user'] = [
                'id' => $user->id,
                'role_id' => $user->role_id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
            ];

            return redirect('/');
        } else {
            $error = 'Password salah!';
        }
    } else {
        $error = 'User tidak di temukan!';
    }
}

?>

<?php component('auth/header') ?>
<div class="content wrapping">
    <h3 class="content-title" style="padding-top: 20px;"><?= ___('Login page') ?></h3>
    <?php if (isset($error)) : ?>
        <div style="margin-top: 20px;">
            <p class="text-red"><?= ___($error) ?></p>
        </div>
    <?php endif ?>
    <form action="" method="POST" class="content-body">
        <table class="table">
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="email" name="email" value="<?= old('email') ?>" class="form-control" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" class="form-control" /></td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="btn-submit" value="true" class="btn bg-blue">Login</button>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php component('footer') ?>