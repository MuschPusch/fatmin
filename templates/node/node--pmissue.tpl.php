<div id="node-<?php print $node->nid; ?>" class="media <?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <div class='media-left'>
    <?php print $user_picture; ?>
  </div>

  <div class="media-body content"<?php print $content_attributes; ?>>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($display_submitted): ?>
      <?php print $submitted; ?>
    <?php endif; ?>


    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php //print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</div>
