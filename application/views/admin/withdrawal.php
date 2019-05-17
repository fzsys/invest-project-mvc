<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Requests for invest payouts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($listTariffs)): ?>
                            <p>Invest withdrawals list is empty</p>
                        <?php else: ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Deposit #</th>
                                        <th>Finish date</th>
                                        <th>Amount</th>
                                        <th>login</th>
                                        <th>Wallet</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listTariffs as $val): ?>
                                        <tr>
                                            <td># <?php echo $val['id']; ?></td>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTimeFinish']); ?></td>
                                            <td><?php echo $val['sumOut']; ?> $</td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['wallet']; ?></td>
                                            <td>
                                                <form action="/admin/withdrawal" method="post">
                                                    <input type="hidden" name="type" value="invest">
                                                    <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                    <button type="submit" class="btn btn-success">Accept</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Requests for referrals payouts</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($listRef)): ?>
                            <p>Referral withdrawals list is empty</p>
                        <?php else: ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Login</th>
                                        <th>Wallet</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listRef as $val): ?>
                                        <tr>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTime']); ?></td>
                                            <td><?php echo $val['amount']; ?> $</td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['wallet']; ?></td>
                                            <td>
                                                <form action="/admin/withdrawal" method="post">
                                                    <input type="hidden" name="type" value="ref">
                                                    <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                    <button type="submit" class="btn btn-success">Accept</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>