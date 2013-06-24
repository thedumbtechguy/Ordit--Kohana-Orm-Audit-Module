<?php
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'raw';
?>
<ul class="pills">
    <?php foreach($days as $day): ?>
    <li class="<?php if($active_report == $day) echo "active" ?>">
        <?php echo HTML::anchor("ordit/$active_month/" . $day . "/$log_action", $day); ?>
    </li>
    <?php endforeach;?>
</ul>
