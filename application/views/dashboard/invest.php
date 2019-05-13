<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <form action="https://perfectmoney.is/api/step1.asp" method="post" target="_blank" id="no_ajax">				
				<div class="control-group form-group">
                    <div class="controls">
                        <label>Tariff name:</label>
                        <input type="text" class="form-control" value="<?php echo $tariffs['title']; ?>" disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Investment period:</label>
                        <input type="text" class="form-control" value="<?php echo $tariffs['hour']; ?> hours" disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Interest rate:</label>
                        <input type="text" class="form-control" value="<?php echo $tariffs['percent']; ?> %" disabled>
                    </div>
                </div>
				<div class="control-group form-group">
                    <div class="controls">
                        <label>Amount:</label>
                        <input type="number" min="<?php echo $tariffs['min']; ?>" max="<?php echo $tariffs['max']; ?>" class="form-control" value="<?php echo $tariffs['min']; ?>" name="PAYMENT_AMOUNT">
                    </div>
                </div>
                <input type="hidden" name="PAYEE_ACCOUNT" class="form-control" value="<?php echo $_SESSION['account']['wallet']; ?>" disabled>
                <input type="hidden" name="PAYEE_NAME" value="Tariff payment # <?php echo $this->route['id']; ?>">
				<input type="hidden" name="PAYMENT_UNITS" value="USD">
				<input type="hidden" name="PAYMENT_ID" value="<?php echo $this->route['id'].'-'.$_SESSION['account']['id']; ?>">
				<input type="hidden" name="STATUS_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/merchant/perfectmoney">
				<input type="hidden" name="PAYMENT_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/account/profile">
				<input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
				<input type="hidden" name="NOPAYMENT_URL" value="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']; ?>/account/profile">
				<input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">
				<button type="submit" class="btn btn-primary">Go to the payment</button>
			</form>
        </div>
    </div>
</div>