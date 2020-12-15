<!-- Shopping Cart Section Begin --> 
<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">
<h2><?php echo $title ?></h2>
<br>
<?php if($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-warning">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>
<p class="alert alert-success">Terimakasih, produk yang Anda beli akan segera kami proses <a href="<?php echo base_url('dasbor') ?>" class="btn btn-info"> Silahkan lakukan pembayaran </a></p>
<div class="col-md-12">
</div>

<div class="col-lg-12">
</div>
</div>
</section>
<!-- Shopping Cart Section End