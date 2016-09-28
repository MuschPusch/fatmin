<div class="wrapSidebar">
  <div class="Sidebar clearfix" role="navigation">
    <div class="Sidebar-wrapBrand clearfix">
      <?php $logo = 'http://ci.factorial.io/logo/1/random/color/0/logo.svg'; ?>
      <?php if ($logo): ?>
        <a class="Sidebar-logo Logo" href="/" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>
      <a class="Sidebar-name" href="/" title="<?php print t('Home'); ?>">Factorial.io</a>
    </div>
    <div class="Sidebar-navigation clearfix">
      <div id="sidebar-toggle-button" class="Sidebar-toggleButton clearfix">
        <i class="fa fa-chevron-left"></i>
      </div>

      <ul class="Navigation Navigation--sidebar">
        <?php
        array_unshift($links, array('href' => '/', 'title' => 'Home'));

        $links['reporting']['badge_count'] = 3;

        foreach ($links as $link) { ?>
          <li role='presentation'>
            <a href="<?php echo $link['href']; ?>" class="Navigation-link">
              <i class="Navigation-icon fa <?php echo $link['icon']; ?>"></i>
              <span class="Navigation-linkTitle">
                <?php echo $link['title']; ?>
              </span>
              <?php if (!empty($link['badge_count'])) : ?>
                <span class="Navigation-wrapBadge">
                  <span class="Badge Badge-projects"><?php echo $link['badge_count']; ?></span>
                </span>
              <?php endif; ?>
            </a>
          </li>
        <?php
        } ?>
      </ul>
    </div>
  </div>
</div>
