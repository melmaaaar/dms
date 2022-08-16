<?php
    $sidebar_modules = $this->M_system_web_module->get_all_active();
    $can_access_modules = $this->M_system_user_role_module_access->get_by_role_id($_SESSION['role_id']);
    $can_access_sections = $this->M_system_user_role_section_access->get_by_role_id($_SESSION['role_id']);
?>
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>/Dashboard" class="brand-link">
      <img src="<?php echo base_url();?>assets/img/logo.png" alt="CICC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CICC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?><?php echo $_SESSION['img_path'];?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo base_url();?>/Dashboard" class="d-block"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php foreach ($sidebar_modules as $key => $value): ?>
            <?php 
              $sidebar_sections = $this->M_system_web_section->get_by_module_id($value->id);
              $section_array = array();
              foreach ($sidebar_sections as $s => $val) {
                if (in_array($val->id, $can_access_sections)) {
                  array_push($section_array, $val->id);
                }
              }
            ?>
            <?php if (empty($sidebar_sections)): ?>
              <?php if (in_array($value->id, $can_access_modules)): ?>
                <li class="nav-item">
                  <a href="<?php echo (!empty($value->link)) ? base_url().$value->link : '#'; ?>" class="nav-link <?php echo ($value->name === $_SESSION['system_web_module']) ? 'active' : ''; ?>">
                    <?php echo $value->icon;?>
                    <p><?php echo $value->name;?></p>
                  </a>
                </li>
              <?php endif; ?>
            <?php else: ?>
              <li class="nav-item <?php echo ($value->name === $_SESSION['system_web_module']) ? 'menu-open' : ''; ?>">
                <a href="<?php echo (!empty($value->link)) ? base_url().$value->link : '#'; ?>" class="nav-link <?php echo ($value->name === $_SESSION['system_web_module']) ? 'active' : ''; ?>">
                  <?php echo $value->icon;?>
                  <p><?php echo $value->name;?>
                  <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="../tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p><?php echo json_encode($section_array); ?></p>
                      </a>
                    </li>
                </ul>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->