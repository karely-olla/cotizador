<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
          <?php if (isset($_SESSION['foto']) && $_SESSION['foto']!="sin foto"): ?>
            <img src="<?=link?>images/avatars/<?=$_SESSION['foto']?>" class="img-circle" alt="User Image">
          <?php else: ?>
            <i class="fa fa-user-circle"></i>
          <?php endif ?>
        </div>
        <div class="pull-left info">
          <p><?=$_SESSION['name']?></p>
<!--           <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu de Administración</li>
      <li>
        <a href="<?= enlace ?>"><i class="fa fa-tasks"></i> <span>Estadisticas</span></a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-copy"></i> <span>Generar Cotizacion</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= enlace ?>cotizaciones/generate.php"><i class="fa fa-bar-chart"></i> Completa</a></li>
          <li><a href="<?= enlace ?>cotizaciones/hosting.php"><i class="fa fa-hotel"></i> Hospedaje</a></li>
          <li><a href="<?= enlace ?>cotizaciones/service.php"><i class="fa fa-coffee"></i> Servicios</a></li>
          <li><a href="<?= enlace ?>cotizaciones/special.php"><i class="fa fa-paper-plane"></i> Especiales</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-list-ul"></i> <span>Cotizaciones</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= enlace ?>cotizaciones/list.php"><i class="fa fa-bar-chart"></i> Completa</a></li>
          <li><a href="<?= enlace ?>cotizaciones/list-hosting.php"><i class="fa fa-hotel"></i> Hospedaje</a></li>
          <li><a href="<?= enlace ?>cotizaciones/list-service.php"><i class="fa fa-coffee"></i> Servicios</a></li>
          <li><a href="<?= enlace ?>cotizaciones/list-special.php"><i class="fa fa-paper-plane"></i> Especiales</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= enlace ?>groups/list.php"><i class="fa fa-users"></i> <span>Grupos</span></a>
      </li>
      <?php if ($_SESSION['rol']=="admin" || $_SESSION['rol']=="vendedor"): ?>
      <li>
        <a href="<?= enlace ?>cotizaciones/list-all.php"><i class="fa fa-list"></i> <span>Lista de Cotizaciones</span></a>
      </li>
      <?php endif ?>
      <?php if ($_SESSION['rol']=="admin"): ?>
      <li>
        <a href="<?= enlace ?>servicios/add.php"><i class="fa fa-plus-square"></i> <span>Servicios</span></a>
      </li>
      <?php endif ?>
      <?php if ($_SESSION['rol']=="admin"): ?>
      <li>
        <a href="<?= enlace ?>users/list.php"><i class="fa fa-user-circle"></i> <span>Usuarios</span></a>
      </li>
      <?php endif ?>
      
      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-dollar"></i> <span>Precios Generales</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="create_stall.php"><i class="fa fa-plus-square"></i> Agregar</a></li>
          <li><a href="edit_stall.php"><i class="fa fa-pencil-square"></i> Editar</a></li>
        </ul>
      </li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>