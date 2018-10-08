<body class="hold-transition skin-green sidebar-mini fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= enlace ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>RM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Cotizador RM <b>(C-RM)</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <?php if (isset($_SESSION['foto']) && $_SESSION['foto']!="sin foto"): ?>
                <img src="<?=link?>images/avatars/<?=$_SESSION['foto']?>" class="user-image" alt="User Image">
              <?php else: ?>
                <i class="fa fa-user-circle"></i>
              <?php endif ?>
              <span class="hidden-xs"><?=$_SESSION['user'];?></span>
            </a>
            <ul class="dropdown-menu animated flipInY">
              <!-- User image -->
              <li>
                <div class="dw-user-box">            
                  <div class="u-img">
                    <?php if (isset($_SESSION['foto']) && $_SESSION['foto']!="sin foto"): ?>
                      <img src="<?=link?>images/avatars/<?=$_SESSION['foto']?>" alt="User Image">
                    <?php else: ?>
                      <i class="fa fa-user-circle"></i>
                    <?php endif ?>
                  </div>
                  <div class="u-text">
                      <h4><?=$_SESSION['name'];?></h4>
                      <p class="text-muted"><?=$_SESSION['rol'];?></p>
                      <a href="<?= enlace ?>profile/view.php" class="btn-profile btn-rounded">Ver Perfil</a>
                  </div>
                </div>
              </li>
              <li class="divider" role="separator"></li>         
              <li><a href="<?=enlace?>profile/edit.php"><i class="fa fa-cog"></i> Mi Cuenta </a></li> 
              <li><a href="?logout"><i class="fa fa-power-off"></i> Salir </a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
