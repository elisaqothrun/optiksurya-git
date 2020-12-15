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
                <!-- Product -->
               	
               	
               	<h1 ><?php echo $title ?></h1>
                   <hr>
                   <p>Berikut adalah riwayat belanja anda</p>

                   <?php
                    // Kalau ada transaksi 
                   if($detail_transaksi) {
                    ?>
                    <table class="table table-bordered" >
                        <thead>
                            <tr >
                                <th class="20%">Kode Transaksi</th>
                                <th>: <?php echo $detail_transaksi->kd_transaksi ?></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?php echo date('d-M-Y',strtotime($detail_transaksi->tgl_transaksi)) ?></td>    
                            </tr>
                            <tr>
                                <td>Jumlah Total</td>
                                <td>: <?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>    
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: <?php echo $detail_transaksi->status_bayar ?></td>    
                            </tr>
                            
                        </tbody>
                    </table>
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr class="bg-success">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($transaksi as $transaksi) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $transaksi->kd_produk ?></td>
                                <td><?php echo $transaksi->nama_produk ?></td>
                                <td><?php echo number_format($transaksi->jumlah) ?></td>
                                <td><?php echo number_format($transaksi->harga) ?></td>
                                <td><?php echo number_format($transaksi->total_harga) ?></td>
                                
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <?php
                    }else{ ?>
                    <p class="alert alert-success">
                        <i class="fa fa-warning"></i>Belum ada data transaksi</p>
                    </
                    <?php
                    }
                    ?>
               		
               	</div>
                </div>
            </div>
        </div>
    </div>
</section>