<div class="container">
    <h1 class="mt-4 mb-3">Login</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/account/login" method="post">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Login:</label>
                        <input type="text" class="form-control" name="login">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <a href="/account/recovery">forgot your password?</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>