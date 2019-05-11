<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/profile" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Login:</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['account']['login']; ?>" disabled>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="text" class="form-control"  value="<?php echo $_SESSION['account']['email']; ?>" name="email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Wallet number:</label>
                        <input type="text" class="form-control"  value="<?php echo $_SESSION['account']['wallet']; ?>" name="wallet">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>New password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>