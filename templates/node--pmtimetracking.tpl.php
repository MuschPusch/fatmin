<?php
hide($content['body']);
?>
<ul class="list-inline">
  <li><?php echo render($content['pm_date']); ?></li>
  <li><?php echo render($title); ?></li>
  <li><?php echo render($content['pmtimetracking_parent']); ?></li>
  <li><?php echo render($content['pm_duration']) . ' ' . render($content['pm_durationunit']); ?></li>
  <li><?php echo render($content); ?></li>
</ol>
