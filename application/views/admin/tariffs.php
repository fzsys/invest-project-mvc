<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($list)): ?>
                            <p>Investment list is empty</p>
                        <?php else: ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Deposit number</th>
                                        <th>Start date</th>
                                        <th>Finish date</th>
                                        <th>Value</th>
                                        <th>For withdrawal</th>
                                        <th>Percent</th>
                                        <th>Login</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $val): ?>
                                        <tr>
                                            <td><?php echo $val['id']; ?></td>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTimeStart']); ?></td>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTimeFinish']); ?></td>
                                            <td><?php echo $val['sumIn']; ?> $</td>
                                            <td><?php echo round($val['sumIn'] + ($val['sumIn'] * $val['percent']) / 100, 2); ?> $</td>
                                            <td><?php echo $val['percent']; ?> %</td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td>
                                                <?php if (time() >= $val['unixTimeFinish']): ?>
                                                    <?php if ($val['sumOut']): ?>
                                                        Wait for withdrawal
                                                    <?php else: ?>
                                                        Closed
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    Active
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php echo $pagination; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>