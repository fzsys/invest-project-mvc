<div class="container">
    <h1 class="my-4">Rates</h1>
    <div class="row">
        <?php foreach ($tariffs as $key => $value): ?>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h3 class="card-header"><?php echo $value['title']; ?></h3>
                    <div class="card-body">
                        <div class="display-4"><?php echo $value['percent']; ?> %</div>
                        <div class="font-italic"><?php echo $value['description']; ?></div>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Minimum investment: <?php echo $value['min']; ?> $</li>
                        <li class="list-group-item">Maximum investment: <?php echo $value['max']; ?> $</li>
                        <li class="list-group-item">Investment period: <?php echo $value['hour']; ?> hours</li>
                        <li class="list-group-item">
                            <?php if(isset($_SESSION['account']['id'])): ?>
                                <a href="/dashboard/invest/<?php echo $key; ?>" class="btn btn-primary">To invest</a>
                            <?php else: ?>
                                <a href="/account/login" class="btn btn-primary">Login to invest</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>