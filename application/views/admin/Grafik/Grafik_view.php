<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Grafik Stok Produk</title>
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/morris.css'?>">
  </head>
  <body>
    <h2>Grafik Jumlah Stok Produk di Optik Surya</h2>
 
    <div id="graph"></div>
 
    <script src="<?php echo base_url().'assets/js/jquery3.4.1.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/raphael.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/morris.js'?>"></script>
    <script>
        Morris.Bar({
          element: 'graph',
          data: <?php echo $data2;?>,
          xkey: 'year',
          ykeys: ['purchase', 'sale', 'profit'],
          labels: ['Purchase', 'Sale', 'Profit']
        });
    </script>
  </body>
</html>