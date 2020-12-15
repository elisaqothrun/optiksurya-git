 
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="row">
	<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
		<div class="leftbar p-r-20 p-r-0-sm">
			<!--  -->
		<?php include ('menu.php') ?>
	</div>
	</div>

	<div class="col-sm-6 col-md-9 col-lg-9 p-b-50">
	<!-- product -->
	
	<!-- <div class="alert alert-success"> -->
	<h2><?php echo $title ?></h2>
	<hr>
	<p>Berikut adalah riwayat belanja anda</p>

	<?php 
//juka ada transaksi, tampilkan tabel
	if($detail_transaksi) {
		?>

		<table class="table table-bordered" width="100%">
			<thead>
				<tr class="bg-info">
					<th>NO</th>
					<th>KODE</th>
					<th>TANGGAL</th>
					<th>JUMLAH TOTAL</th>
					<th>JUMLAH ITEM</th>
					<th>STATUS PEMBAYARAN</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; foreach ($detail_transaksi as $detail_transaksi) { ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $detail_transaksi->kd_transaksi ?></td>
					<td><?php echo date('d-m-Y',strtotime($detail_transaksi->tgl_transaksi)) ?></td>
					<td><?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>
					<td><?php echo $detail_transaksi->total_item ?></td>
					<td><?php echo $detail_transaksi->status_bayar ?></td>
					<td>
					<div class="btn-group">
						<a href="<?php echo base_url('dasbor/detail/'.$detail_transaksi->kd_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
						<a href="<?php echo base_url('dasbor/konfirmasi/'.$detail_transaksi->kd_transaksi) ?>" class="btn btn-info btn-xs"><i class="fa fa-upload"></i> Konfirmasi Bayar</a>
					</div>
					</td>
				</tr>	
					<?php $i++; } ?>
				</tr>
			</tbody>
		</table>

	<?php 
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