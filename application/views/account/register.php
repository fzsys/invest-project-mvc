<div class="container">
    <h1 class="mt-4 mb-3">Registration</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/register" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Login:</label>
                        <input type="text" class="form-control" name="login">
                    </div>
                </div>
                <?php //if (isset($this->route['ref'])): ?>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Invited by:</label>
                            <input type="text" class="form-control" name="ref" value="<?php //echo $this->route['ref']; ?>" readonly>
                        </div>
                    </div>
                <?php //else: ?>
                    <input type="hidden" class="form-control" name="ref" value="none">
                <?php //endif; ?>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Wallet number:</label>
                        <input type="text" class="form-control" name="wallet">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registration</button>
            </form>
        </div>
    </div>
</div>