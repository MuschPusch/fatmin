<div id="sidebar-wrapper" class="sidebar-wrapper col-md-2 ">
  <div class="navbar-inverse sidebar clearfix" role="navigation">
    <div class="sidebar-nav clearfix">
      <button id="sidebar-toggle-button" class="btn"><i class="fa fa-chevron-left pull-right"></i></button>
      <ul class="nav nav-pills nav-stacked fa-ul">
        <li role="presentation"><i class='fa fa-li fa-home icon-main'></i><a href="/">Home</a></li>
        <?php
        foreach ($links as $link) {
          echo "<li role='presentation'><i class='fa fa-li fa-camera-retro icon-main'></i> " . l($link['title'], $link['href']) . "</a></li>";
        }
        ?>
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
