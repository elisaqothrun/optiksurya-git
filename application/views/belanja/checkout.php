<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">
<?php if($this->session->flashdata('sukses')) {
		    echo '<div class="alert alert-success">';
		    echo $this->session->flashdata('sukses');
		    echo '</div>';
		}
		?>
	<!-- Cart item -->
	<div class="container-table-cart pos-relative">
		<div class="wrap-table-shopping-cart bgwhite">
		<h2><?php echo $title ?></h2><hr>
		
		<br>
			<table class="table-shopping-cart">
				<tr class="table-head">
					<th class="column-1">GAMBAR</th>
					<th class="column-2">PRODUK</th>
					<th class="column-3">HARGA</th>
					<th class="column-4 p-l-70">Quantity</th>
					<th class="column-5">SUBTOTAL</th>
				</tr>

				<?php 

				foreach ($keranjang as $keranjang) { 
					//ambil data produk
            	$id_produk 	= $keranjang['id'];
            	$produk 	= $this->produk_model->detail($id_produk);
                 //form update
                echo form_open(base_url('belanja/update_cart/'.$keranjang['rowid']));

				?>
				<tr class="table-row">
					<td class="column-1">
						<div class="cart-img-product b-rad-4 o-f-hidden">
							<img src="<?php echo base_url('assets/upload/images/thumbs/'.$produk->gambar)?>" alt="IMG-PRODUCT">
						</div>
					</td>
					<td class="column-2"><?php echo $keranjang['name'] ?></td>
					<td class="column-3">Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?></td>
					<td class="column-4">
						<div class="flex-w bo5 of-hidden w-size17">
							<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
							</button>

							<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?php echo $keranjang['qty'] ?>">

							<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
								<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
							</button>
						</div>
					</td>
					<td class="column-5">Rp.
                    	<?php
                    	$subtotal= $keranjang['price'] * $keranjang['qty'];
                    	echo number_format($subtotal,'0',',','.' );
                    	?>		
                    </td>
				</tr>
				<?php 
				//form close
                echo form_close();
                 // end looping keranjang belanja
           		 }
				 ?>
				 <tr class="table-row alert alert-info">
				 	<td colspan="4" class="column-1">Total Belanja</td>
				 	<td colspan= "2" class="column-2">Rp. <?php echo number_format($this->uri->segment(4), '0',',','.' ) ?></td>
				 </tr>
			</table>
			<br>
			 <?php echo form_open(base_url('belanja/checkout/'.$this->uri->segment(3)."/".$this->uri->segment(4))); 
			 $kode_transaksi = date('dmY').strtoupper(random_string('alnum', 8));
			 ?>
			<table class="table">
	           <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan ?>">
	           <input type="hidden" name="jumlah_transaksi" value="<?php echo number_format($this->uri->segment(4), '0',',','.' ) ?>">
	           <input type="hidden" name="tgl_transaksi" value="<?php echo date('Y-m-d'); ?>">
	            <table class="table">
		            <thead>
		                <tr>
		                    <th width="25%">Kode Transaksi </th>
		                    <th><input type="text" name="kd_transaksi" class="form-control" placeholder="kd_transaksi" value="<?php echo $kode_transaksi ?>" readonly required></th>
		                </tr>
		                <tr>
		                    <th>Nama Penerima </th>
		                    <th><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required></th>
		                </tr>
		            </thead>
		            <tbody>
		                <tr>
		                    <td>Email Penerima</td>
		                    <td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $pelanggan->email ?>" required></td>
		                </tr>
		                <tr>
		                    <td>No.Telepon Penerima </td>
		                    <td><input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $pelanggan->telepon ?>" required></td>
		                </tr>
		                <tr>
		                    <td>Alamat Pengiriman </td>
		                    <td><textarea name="alamat" class="form-control" placeholder="Alamat" required><?php echo $pelanggan->alamat ?></textarea> 
		                </tr> 
		                <tr>
		                    <td>Detail Pesanan </td>
		                    <td><textarea class="form-control" name="detail_pesanan" style="margin-bottom: 50px;" placeholder="masukan detail pesanan misal : ukuran lensa minum/plus/cylinder"></textarea></td>
		                </tr>  
		                
		            </tbody>
		                    <td><button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">Buat Pesanan</button></td>
		        </table>
			  <?php echo form_close(); ?>
		</div>
	</div>

	<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
	<div class="flex-w flex-m w-full-sm">
	</div>
		<div class="size11 trans-0-4 m-t-10 m-b-10">
			<!-- Button -->	 
		</div>
	</div>	
	</div>
</div>
<script src="<?php echo base_url() ?>assets/template/js/jquery.min.js"></script>

</section>
