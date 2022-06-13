
<div class="container text-center" id="login-container">
    <form class="form-login" id="formLogin" method="POST" action="<?= BASE_URL; ?>/user/signup">
        <img class="mb-4" src="<?= BASE_URL; ?>/assets/images/logo-mvczitto.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Free sign up</h1>

        <div class="form-group mt-3 mb-0">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="form-group mb-0">
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="inputConfirmPassword" class="sr-only">Retype Password</label>
            <input name="confirm_password" type="password" id="inputConfirmPassword" class="form-control" placeholder="Retype Password" required>
        </div>

        <?php if( @$notification_type && @$notification_message ): ?>
            <?php
                // This is an exemple of a view responsability (select correct css class based on a internal classification)
                $alertClass = $notification_type == 'error' ? 'alert-danger' : 'alert-info';
            ?>
            <div class="mt-4 alert <?= $alertClass; ?> alert-dimissable fade show" role="alert">
                <?= $notification_message; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="submit" role="submit">Create Account</button>
        <a href="<?= BASE_URL; ?>/user/login" class="btn btn-outline-secondary btn-block" type="button" role="button">I already have an account</a>
    </form>
</div>
