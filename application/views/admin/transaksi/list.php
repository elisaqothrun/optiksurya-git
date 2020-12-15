<!-- <div class="col-md-4">
<form action="<?php //echo base_url('admin/transaksi/'); ?>" method="get" accept-charset="utf-8">
    <input type="date" name="tgl_mulai" class="form-control" placeholder="Tanggal Awal">
    <input type="date" name="tgl_selesai" class="form-control" placeholder="Tanggal Akhir">
    <button type="submit" class="btn btn-success">Tampilkan</button>
</form>
</div> -->

<table class="table table-bordered" id="example1">
     <thead>
         <tr class="bg-secondary">
             <th>No</th>
             <th>Pelanggan</th>
             <th>Kode Transaksi</th>
             <th>Tanggal Transaksi</th>
             <th>Jumlah Total</th>
             <th>Jumlah Item</th>
             <th>Status Bayar</th>
             <th width="25%">Aksi</th>
         </tr>
     </thead>
     <tbody>
     <?php $i=1; foreach ($detail_transaksi as $detail_transaksi) { ?>
         <tr>
             <td><?php echo $i ?></td>
             <td><?php echo $detail_transaksi->nama_pelanggan ?>
                 <br><small>
                     Telepon: <?php echo $detail_transaksi->telepon ?>
                     <br>Email: <?php echo $detail_transaksi->email ?>
                     <br>Alamat Kirim: <br><?php echo nl2br($detail_transaksi->alamat) ?>
                     <br>Detail Pesanan: <br><?php echo nl2br($detail_transaksi->detail_pesanan) ?>
                 </small>
            </td>
             <td><?php echo $detail_transaksi->kd_transaksi ?></td>
             <td><?php echo date('d-m-Y', strtotime($detail_transaksi->tgl_transaksi))?></td>
             <td>Rp. <?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>
             <td><?php echo $detail_transaksi->total_item ?></td>
             <td><?php echo $detail_transaksi->status_bayar ?></td>
             <td>
                <div class="btn-group">
                <a href= "<?php echo base_url('admin/transaksi/detail/'.$detail_transaksi->kd_transaksi) ?>" class= "btn btn-info btn-sm"><i class="fa fa-eye"> Detail</i></a> 
                 <a href= "<?php echo base_url('admin/transaksi/cetak/'.$detail_transaksi->kd_transaksi) ?>" target="_blank" class= "btn btn-warning btn-sm"><i class="fa fa-print"> Cetak</i></a>                          
                </div>
            <div class="clearfix">
                
            </div>
             <br>

                <div class="btn-group">
                <a href= "<?php echo base_url('admin/transaksi/pdf/'.$detail_transaksi->kd_transaksi) ?>" class= "btn btn-danger btn-sm"><i class="fa fa-file-pdf"> Unduh PDF</i></a> 
                 <a href= "<?php echo base_url('admin/transaksi/kirim/'.$detail_transaksi->kd_transaksi) ?>" target="_blank" class= "btn btn-warning btn-sm"><i class="fa fa-print"> Cetak Kirim</i></a>                                     
                </div>

            </td>

         </tr>
    <?php $i++; } ?>
     </tbody>
 </table>