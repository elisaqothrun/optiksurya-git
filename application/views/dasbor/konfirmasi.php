 
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="row">
	<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
		<div class="leftbar p-r-20 p-r-0-sm">
			<!--  -->
		<?php include ('menu.php') ?>
	</div>
	</div>

	<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
	<!-- product -->
	
	<!-- <div class="alert alert-success"> -->
	<h2><?php echo $title ?></h2>
	<hr>
	<p>Berikut adalah riwayat belanja anda</p>

	<?php 
//juka ada transaksi, tampilkan tabel
	if($detail_transaksi) {
		?>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="20%">KODE TRANSAKSI</th>
					<th>: <?php echo $detail_transaksi->kd_transaksi ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Tanggal</td>
					<td>: <?php echo date('d-m-Y',strtotime($detail_transaksi->tgl_transaksi)) ?></td>
				</tr>
				<tr>
					<td>Jumlah Total</td>
					<td>: <?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>
				</tr>
				<tr>
					<td>Status Bayar</td>
					<td>: <?php echo $detail_transaksi->status_bayar ?></td>
				</tr>
				<tr>
					<td>Bukti Pembayaran</td>
					<td>: <?php if($detail_transaksi->bukti_pembayaran !="") { ?><img src="<?php echo base_url('/assets/upload/images/'.$detail_transaksi->bukti_pembayaran) ?>" class="img img-thumbnail" >
					<?php }else{ echo 'Belum Ada Bukti Pembayaran'; } ?>
					</td>
				</tr>
			</tbody>
		</table>

		<?php
		//error upload
		if(isset($error)){
			echo '<p class="alert alert-warning">' .$error. '</p>';
		}

		//notif error
		echo validation_errors('<p class="alert alert-warning">','</p>');

		//form open
		echo form_open_multipart(base_url('dasbor/konfirmasi/'.$detail_transaksi->kd_transaksi));
		?>

		<table class="table">
			<tbody>
				<tr>
					<td width="30%">Pembayaran Ke Rekening</td>
					<td>
						<select name="id_rekening" class="form-control">
						<?php foreach($rekening as $rekening) { ?>
							<option value="<?php echo $rekening->id_rekening ?>" <?php if($detail_transaksi->id_rekening==$rekening->id_rekening) { echo "selected"; } ?>>
								<?php echo $rekening->nama_bank ?> (No. Rekening: <?php echo $rekening->nomor_rekening ?> a.n <?php echo $rekening->nama_pemilik ?>)
							</option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
				<td>Tanggal Pembayaran
					<td>
						<input type="text" name="tgl_bayar" class="form-control-lg" placeholder="dd-mm-yyy" value="<?php if(isset($_POST['tgl_bayar'])) { echo set_value('tgl_bayar'); }elseif($detail_transaksi->tgl_bayar!="") {echo $detail_transaksi->tgl_bayar; }else{echo date('d-m-Y'); } ?>">
					</td> 
				<tr>
					

					<td>Jumlah Pembayaran</td>
					<td>
						<input type="number" name="jumlah_bayar" class="form-control-lg" placeholder="Jumlah Pembayaran" value="<?php  if(isset($_POST['jumlah_bayar'])) {echo set_value ('jumlah_bayar'); }elseif($detail_transaksi->jumlah_bayar!="") {echo $detail_transaksi->jumlah_bayar; }else{ echo $detail_transaksi->jumlah_transaksi; } ?>">
					</td> 
				</tr>
				</tr>
				<tr>
					<td>Bank</td>
					<td>
						<input type="text" name="nama_bank" class="form-control" value="<?php echo $detail_transaksi->nama_bank ?>" placeholder="Nama Bank">
						<small>Misal: Bank BRI</small>
					</td>
				</tr>
				<tr>
					<td>No. Rekening</td>
					<td>
						<input type="text" name="rekening_pembayaran" class="form-control" value="<?php echo $detail_transaksi->rekening_pembayaran ?>" placeholder="Nomor Rekening">
						<small>Misal: 27390723</small>
					</td>
				</tr>
				<tr>
					<td>Nama Pemilik</td>
					<td>
						<input type="text" name="rekening_pelanggan" class="form-control" value="<?php echo $detail_transaksi->rekening_pelanggan ?>" placeholder="Nama">
					</td>
				</tr>
				<tr>
					<td>Upload Bukti Pembayaran</td>
					<td>
						<input type="file" name="bukti_pembayaran" class="form-control" " placeholder="Upload Bukti Pembayaran">
					</td>
				</tr>
				<tr>
					<td>
						<div class="btn-group">
						<button class="btn btn-success btn-lg" type="submit" name="submit"><i class="fa fa-upload"></i> Submit</button>
						<button class="btn btn-info btn-lg" type="reset" name="reset"><i class="fa fa-times"></i> Reset</button>
						</div>
					</td>
				</tr>
				
				</tbody>
			</tbody>
		</table>

	<?php 
	//form close
	echo form_close();
//jika tidak, tampilkan notifikasi
	}else{ ?>

	<p class="alert alert-success">
		<i class="fa fa-warning"></i> Belum ada data transaksi
	</p>
	<?php } ?>	
	</div>
		
	</div>
			

</div>
</div>
</div>
</section>