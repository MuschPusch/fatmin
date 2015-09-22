<div id="sidebar-wrapper" class="sidebar-wrapper">
    <div class="navbar-inverse sidebar clearfix" role="navigation">
      <div class="navbar-wrapBrand clearfix">
        <?php $logo = 'http://ci.factorial.io/logo-300/1/random/color/logo.svg'; ?>
        <?php if ($logo): ?>
          <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        <?php endif; ?>

        <?php if (!empty($site_name)): ?>
        <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
        <?php endif; ?>
      </div>
      <div class="sidebar-nav clearfix">
        <div class="clearfix">
          <button id="sidebar-toggle-button" class="btn"><i class="fa fa-chevron-left pull-right"></i></button>
        </div>

        <ul class="nav nav--sidebar nav-pills nav-stacked">
          <li role="presentation">
            <a href="/" class="nav-link fa fa-home icon-main">
              <span class="nav-linkTitle">
                Home
              </span>
            </a>
          </li>
          <?php
          foreach ($links as $link) { ?>
            <li role='presentation'>
              <a href="<?php echo $link['href']; ?>" class="nav-link fa fa-camera-retro icon-main">
                <span class="nav-linkTitle">
                  <?php echo $link['title']; ?>
                </span>
              </a>
            </li>
          <?php
          } ?>
          <!--
          <li role="presentation"><i class='fa fa-li fa-soundcloud icon-main' ></i><a href="/pm/projects">Projects<span class="badge badge-projects">1</span></a></li>
          <li role="separator" class="divider"><h6>Some seperator</h6></li>
          <li role="presentation"><i class='fa fa-li fa-home icon-main'></i><a href="/">Home</a></li>
          <li role="presentation"><i class='fa fa-li fa-camera-retro icon-main'></i><a href="/pm/issues">Issues<span class="badge badge-issues">4</span></a></li>
          <li role="presentation"><i class='fa fa-li fa-camera-retro icon-main'></i><a href="/pm/timetracking">Timetracking</a></li>
          <li role="presentation"><i class='fa fa-li fa-camera-retro icon-main'></i><a href="/pm/issues">Issues</a></li>
          <ul class="nav nav-pills nav-stacked fa-ul nav-pills-sub">
            <li role="presentation"><i class='fa fa-li fa-plus icon-sub' ></i><a href="/node/add/pmissue">Add issue</a></li>
            <li role="presentation"><i class='fa fa-li fa-list icon-sub' ></i><a href="/">My issues</a></li>
          </ul>
          -->
        </ul>

      </div>
    </div>
</div>
