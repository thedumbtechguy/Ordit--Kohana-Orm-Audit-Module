<?php
	$mode = isset($_GET['mode']) ? $_GET['mode'] : 'raw';
?>
<ul class="pills">
    <?php foreach($months as $month): ?>
    <li class="<?php if($active_month == $month) echo "active" ?>">
        <?php echo HTML::anchor("ordit/$month/01/$log_action", $month); ?></a>
    </li>
    <?php endforeach;?>
</ul>

 
