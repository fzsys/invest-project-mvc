<div class="container">
    <h1 class="mt-4 mb-3"><?php echo $title; ?></h1>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <?php if (empty($list)): ?>
            	<p>You have no investments yet</p>
            <?php else: ?>
            	<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>Start date</th>
            				<th>Finish date</th>
            				<th>Deposit</th>
            				<th>Withdrawal</th>
            				<th>Profit</th>
            				<th>Percent</th>
                            <th>Status</th>
            			</tr>
            		</thead>
            		<tbody>
		            	<?php foreach ($list as $val): ?>
		            		<tr>
		            			<td><?php echo date('d.m.Y в H:i', $val['unixTimeStart']); ?></td>
		            			<td><?php echo date('d.m.Y в H:i', $val['unixTimeFinish']); ?></td>
		            			<td><?php echo $in = $val['sumIn']; ?> $</td>
		            			<td><?php echo $out = round($val['sumIn'] + ($val['sumIn'] * $val['percent']) / 100, 2); ?> $</td>
                                <td><?php echo $out - $in ?> $</td>
		            			<td><?php echo $val['percent']; ?> %</td>
                                <td>
                                    <?php if (time() >= $val['unixTimeFinish']): ?>
                                        <?php if ($val['sumOut']): ?>
                                            wait for withdrawal
                                        <?php else: ?>
                                            is closed
                                        <?php endif; ?>
                                    <?php else: ?>
                                        is active
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