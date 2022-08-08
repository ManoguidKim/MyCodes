

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Point of Sale</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

  <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/fullcalendar/main.css') ?>">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="<?php echo base_url('css/style.css') ?>">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container-fluid">
        <a href="" class="navbar-brand">
          <!-- <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
          <span class="brand-text font-weight-light">Point of Sale</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">

            <?php if ($this->session->UserType == 'admin') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('page/admin') ?>" class="nav-link">Dashboard</a>
              </li>
            <?php } ?>

            <?php if ($this->session->UserType == 'admin' || $this->session->UserType == 'user') { ?>
              <li class="nav-item">
                <a href="<?php echo base_url('desk/desk_monitoring') ?>" class="nav-link">Table Monitoring</a>
              </li>
            <?php } ?>
<!-- 
            <li class="nav-item">
              <a href="<?php echo base_url('transaction/set_take_order') ?>" class="nav-link">Take Out</a>
            </li> -->
            <?php if ($this->session->UserType == 'admin') { ?>
              <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Manage</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="<?php echo base_url('page/product') ?>" class="dropdown-item"> Product </a></li>
                  <li><a href="<?php echo base_url('desk/manage_desk') ?>" class="dropdown-item"> Table </a></li>
                  <li><a href="<?php echo base_url('account/manage_account') ?>" class="dropdown-item"> Account </a></li>
                </ul>
              </li>
            <?php } ?>
            <!-- <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Transaction</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="<?php echo base_url('transaction/order_product') ?>" class="dropdown-item"> Point of Sale </a></li>
                <li><a href="#" class="dropdown-item"> Sale </a></li>
              </ul>
            </li> -->
            <?php if ($this->session->UserType == 'admin') { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">Report</a>
              </li>
            <?php } ?>
          </ul>
        </div>


        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a href="<?php echo base_url('account/logout') ?>" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <?php if ($this->session->userdata('Error')) { ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?php echo $this->session->userdata('Error') ?>'
        })
      </script>

    <?php } else { ?>
      <?php if ($this->session->userdata('Success')) { ?>
        <script>
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?php echo $this->session->userdata('Success') ?>'
          })
        </script>
      <?php } ?>
    <?php } ?>

    <?php echo $this->session->unset_userdata('Error'); ?>
    <?php echo $this->session->unset_userdata('Success'); ?>