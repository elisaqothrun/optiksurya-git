<p class="pull-right">
	<div class="btn-group pull-right">
		<a href="<?php echo base_url('admin/transaksi/cetak/'.$detail_transaksi->kd_transaksi )?>" target="_blank" title="Cetak" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print </a>
	</div>
</p>
<div class="clearfix"></div><hr>
<table class="table table-bordered">
<thead>
	<tr>
        <th width="20%">Nama Pelanggan</th>
        <th>: <?php echo $detail_transaksi->nama_pelanggan ?></th>
    </tr>
    <tr>
        <th width="20%">Kode Transaksi</th>
        <th>: <?php echo $detail_transaksi->kd_transaksi ?></th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Tanggal Transaksi</td>
        <td>: <?php echo date('d-m-Y', strtotime($detail_transaksi->tgl_transaksi))  ?></td>
    </tr>
     <tr>
        <td>Jumlah Total</td>
        <td>: Rp. <?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>
    </tr>
     <tr>
        <td>Status Bayar</td>
        <td>: <?php echo $detail_transaksi->status_bayar ?></td>
    </tr>
    <tr>
        <td>Bukti Bayar</td>
        <td>: <?php if($detail_transaksi->bukti_pembayaran ==""){echo 'Belum Ada'; }else{ ?> 
        <img src="<?php echo base_url('assets/upload/images/'.$detail_transaksi->bukti_pembayaran)?>" class="img img-thumbnail" width="200">
        </td>
        <?php } ?>
    </tr>
    <tr>
        <td>Tanggal Bayar</td>
        <td>: <?php echo date('d-m-Y', strtotime($detail_transaksi->tgl_bayar))  ?></td>
    </tr>
    <tr>
        <td>Jumlah Bayar</td>
        <td>: Rp. <?php echo number_format($detail_transaksi->jumlah_bayar, '0',',','.')  ?></td>
    </tr>
    <tr>
        <td>Pembayaran Dari</td>
        <td>: <?php echo $detail_transaksi->nama_bank ?> No. Rekening <?php echo $detail_transaksi->rekening_pembayaran ?> a.n <?php echo $detail_transaksi->rekening_pelanggan ?></td>
    </tr>
    <tr>
        <td>Pembayaran ke Rekening</td>
        <td>: <?php echo $detail_transaksi->bank ?> No. Rekening <?php echo $detail_transaksi->no_rekening ?> a.n <?php echo $detail_transaksi->nama_pemilik ?></td>
    </tr>
</tbody>
</table>

<hr>

<table class="table table-bordered" width="100%">
 <thead>
     <tr class="bg-secondary">
         <th>No</th>
         <th>Kode</th>
         <th>Nama Produk</th>
         <th>Jumlah</th>
         <th>Harga</th>
         <th>Total Harga</th>
     </tr>
 </thead>
 <tbody>
 <?php $i=1; foreach ($transaksi as $transaksi) { ?>
     <tr>
         <td><?php echo $i ?></td>
         <td><?php echo $transaksi->kd_produk ?></td>
         <td><?php echo $transaksi->nama_produk ?></td>
         <td><?php echo $transaksi->jumlah ?></td>
         <td>Rp. <?php echo number_format($transaksi->harga) ?></td>
         <td>Rp. <?php echo number_format($transaksi->total_harga) ?></td>

     </tr>
<?php $i++; } ?>
 </tbody>
</table>