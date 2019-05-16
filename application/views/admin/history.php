<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?php //echo $title; ?></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (empty($list)): ?>
                            <p>History is empty</p>
                        <?php else: ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Login</th>
                                        <th>E-mail</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $val): ?>
                                        <tr>
                                            <td><?php echo date('d.m.Y в H:i', $val['unixTime']); ?></td>
                                            <td><?php echo $val['login']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['description']; ?></td>
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