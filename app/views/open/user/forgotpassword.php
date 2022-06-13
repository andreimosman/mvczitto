
<div class="container text-center" id="login-container">
    <form class="form-login" id="formForgotPassword" method="POST" action="<?= BASE_URL; ?>/user/forgotpassword">
        <img class="mb-4" src="<?= BASE_URL; ?>/assets/images/logo-mvczitto.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Password Recovery</h1>
        <div class="form-group mt-3 mb-3">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
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

        <button id="recoverButton" class="btn btn-lg btn-primary btn-block" type="submit" role="submit">Recover Password</button>
        <a class="btn text-right" href="<?= BASE_URL; ?>/user/login"><small>Back to Login &nbsp; </small></a>
    </form>
</div>
