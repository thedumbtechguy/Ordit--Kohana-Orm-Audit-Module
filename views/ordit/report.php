<?php
function get_log_class($act)
{
	switch($act)
	{
		case 'create':
			return 'success';
			break;
		case 'update':
			return 'warning';
			break;
		case 'delete':
			return 'error';
			break;
	}
}
?>

<h2><?php echo $header ?></h2>

    <p>&nbsp;</p>

    <div class="row filter-form">
        <form name="mapping-filter" action="" class="pull-right">

            Action
            <select class="input-small" name="actions" onchange="location='<?php echo URL::site("ordit/$active_month/$active_day")?>/' + options[selectedIndex].value">
                <option value="">--All--</option>
                <?php 
                foreach (Ordit::$Types as $type):
                    $select = ($log_action == $type) ? 'selected' : '';
                    echo "<option $select value=\"" . $type . '">' . strtoupper($type) . '</option>';
                endforeach;
                ?>
            </select>&nbsp;
            
        </form>
    </div>
    <table class="zebra-striped" width="100%">
       
        <thead>
            <tr>
                <th>Action</th>
                <th>Time</th>
                <th>Model</th>
                <th>Values</th>
                <th>User</th>
            </tr>

        </thead>
		
		<tbody>
            <?php foreach ($logs as $log):?>
            <tr>
                <td>
                    <span class="label <?php echo get_log_class($log->action) ?>"> <?php echo $log->action ?> </span>
                </td>
                <td>
					<?php echo date('H:i:s', strtotime($log->timestamp_created)) ?>
				</td>
                <td>
					<?php echo $log->model ?>
				</td>
                <td>
					<?php if($log->action == 'update'): ?>
						<table>
							<th>Column</th>
							<th>Original</th>
							<th>Current</th>
							<?php foreach(json_decode($log->values) as $k => $value): ?>
								<tr>
									<td><?php echo $k ?></td>
									<td><?php echo $value->original ?></td>
									<td><?php echo $value->updated ?></td>
								</tr>
							<?php endforeach?>
						</table>
					<?php else: ?>
						<table>
							<th>Column</th>
							<th>Value</th>
							<?php foreach(json_decode($log->values) as $k => $value): ?>
								<tr>
									<td><?php echo $k ?></td>
									<td><?php echo $value ?></td>
								</tr>
							<?php endforeach?>
						</table>
					<?php endif ?>
				</td>
                <td>
					<?php echo $log->user ?>
				</td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

