<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PD</b>.Sinko Teknik</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="<?php echo site_url('loginControl/logout');?>">
              <span class="hidden-xs">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url ('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo $user->nama;?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo base_url('dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Kelola data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('bbaku'); ?>"><i class="fa fa-angle-right"></i> Bahan Baku</a></li>
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-angle-right"></i> Produk</a></li>
            <li><a href="<?php echo base_url('pekerjaan'); ?>"><i class="fa fa-angle-right"></i> Pekerjaan</a></li>
            <li><a href="<?php echo base_url('coa'); ?>"><i class="fa fa-angle-right"></i> COA</a></li>
            <li><a href="<?php echo base_url('oh'); ?>"><i class="fa fa-angle-right"></i> Biaya OH</a></li>
            <li><a href="<?php echo base_url('customer'); ?>"><i class="fa fa-users"></i> Pelanggan</a></li>
            <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-user"></i> User</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa circle-o"></i> Pembelian BB</a></li>
            <li><a href="<?php echo base_url('kasir'); ?>"><i class="fa circle-o"></i> Pemesanan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Jurnal</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Buku Besar</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Biaya Produksi</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Master Data
        <small>PD. Sinko Teknik</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">