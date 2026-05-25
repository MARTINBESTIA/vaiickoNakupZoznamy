<?php
/** @var string[] $errors; */
/** @var string|null $message */
/** @var \Framework\Support\LinkGenerator $link */
/** @var \Framework\Support\View $view */

$view->setLayout('auth');
?>

<div class="container">
    <div class="row">
        <div class="text-center mx-auto mt-2">
            <a href="<?= $link->url("auth.login") ?>">Back to login</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Registration</h5>
                    <div>
                        <?php if (count($errors) > 0): ?>
                            <?php foreach ($errors as $error): ?>
                                 <p><?= $error ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="text-center text-danger mb-3">
                        <?= @$message ?>
                    </div>
                    <form class="form-signin" method="post" action="<?= $link->url("auth.register") ?>">
                        <div class="form-label-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input name="username" type="text" id="username" class="form-control" placeholder="Username"
                                   required autofocus minlength="3" maxlength="15">
                        </div>

                        <div class="form-label-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" required minlength="6" maxlength="15">
                        </div>

                        <div class="form-label-group mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input name="confirmPassword" type="password" id="confirmPassword" class="form-control"
                                   placeholder="Password" required minlength="6" maxlength="15">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
