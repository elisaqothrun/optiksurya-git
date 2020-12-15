 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <!-- Menu dashboard-->
        <li><a href="<?php echo base_url('admin/dasbor') ?>"><i class="fa fa-dashboard text-aqua"></i><span>DASHBOARD</span></a></li>

         <!-- Menu Transaksi-->
        <li><a href="<?php echo base_url('admin/transaksi') ?>"><i class="fa fa-book text-aqua"></i><span>TRANSAKSI</span></a></li>

        <!-- Menu Rekening-->
        <li><a href="<?php echo base_url('admin/rekening') ?>"><i class="fa fa-dollar text-aqua"></i><span>REKENING</span></a></li>

        <!-- Menu PRODUK-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-sitemap"></i> <span>PRODUK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/produk')?>"><i class="fa fa-table"></i> Data Produk</a></li>
            <li><a href="<?php echo base_url('admin/produk/tambah')?>"><i class="fa fa-plus"></i> Tambah Produk</a></li>
            <li><a href="<?php echo base_url('admin/kategori')?>"><i class="fa fa-tags"></i>Kategori Produk</a></li>
          </ul>
        </li>
        <!-- Menu Artikel-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>ARTIKEL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/berita')?>"><i class="fa fa-table"></i> Data Arikel</a></li>
            <li><a href="<?php echo base_url('admin/berita/tambah')?>"><i class="fa fa-plus"></i> Tambah Data Artikel</a></li>
          </ul>
        </li>
         <!-- Menu user-->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>PENGGUNA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a> -->
          <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/user')?>"><i class="fa fa-table"></i> Data Pengguna</a></li>
            <li><a href="<?php echo base_url('admin/user/tambah')?>"><i class="fa fa-plus"></i> Tambah Pengguna</a></li>
          </ul>
        </li> -->
         <!-- Menu konfigurasi-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>KONFIGURASI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/konfigurasi')?>"><i class="fa fa-home"></i> Kofigurasi Umum</a></li>
            <li><a href="<?php echo base_url('admin/konfigurasi/logo')?>"><i class="fa fa-image"></i> Konfigurasi Logo</a></li>
            <li><a href="<?php echo base_url('admin/konfigurasi/icon')?>"><i class="fa fa-home"></i>Konfigurasi Icon</a></li>
          </ul>
        </li>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $title ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">