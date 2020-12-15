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
                   <?php
                    // Notifikasi
                    if($this->session->flashdata('sukses')) {
                        echo '<div class="alert alert-warning">';
                        echo $this->session->flashdata('sukses');
                        echo '</div>';
                    } 
                    //valiadasi error
                    echo validation_errors('<div class="alert alert-warning">','</div>');
                    //form open
                    echo form_open(base_url('dasbor/profile'), 'class="leave-comment"'); ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama </th>
                                    <th><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Email </th>
                                    <td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $pelanggan->email ?>" readonly></td>
                                </tr>
                                <tr>
                                    <th>Password </th>
                                    <td><input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password')?>" >
                                    <span class="text-danger">Ketik minimal 6 karakter untuk mengganti password atau biarkan untuk tetap</span></td>
                                    
                                </tr>
                                <tr>
                                    <th>Telepon/Hp </th>
                                    <td><input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $pelanggan->telepon ?>" required></td>
                                </tr>
                                <tr>
                                    <th>Alamat </th>
                                    <td><textarea name="alamat" class="form-control" placeholder="Alamat"  required><?php echo $pelanggan->alamat ?></textarea> 
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                    <button class="btn btn-success btn-lg" type="submit"><i class="fa fa-save"></i>Update</button>
                                    <button class="btn btn-warning btn-lg" type="reset"><i class="fa fa-times"></i>Reset</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                <?php echo form_close(); ?>
               		
               	
            </div>
        </div>
    </div>
</section>