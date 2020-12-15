<!-- Title Page -->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center"><?php echo $title ?></h1>
    <p class="lead text-center"><?php echo $site->namaweb ?> | <?php echo $site->tagline ?> </p>
  </div>
</div>
<!-- content page -->
<section class="bgwhite p-t-60">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-9 p-b-75">
            <div class="p-r-50 p-r-0-lg">
                <!-- item blog -->
                <?php foreach ($berita as $berita) { ?>

                <div class="item-blog p-b-80">
                    <a href="blog-detail.html" class="item-blog-img pos-relative dis-block hov-img-zoom">
                        <img src="<?php echo base_url('assets/upload/images/thumbs/'.$berita->gambar)?>" alt="IMG-BLOG">

                        <span class="item-blog-date dis-block flex-c-m pos1 size30 bg4 s-text1">
                            <?php echo $berita->tgl_update ?>
                        </span>
                    </a>

                    <div class="item-blog-txt p-t-33">
                        <h4 class="p-b-11">
                             <?php echo $berita->judul_berita ?>
                        </h4>

                        <p class="p-b-12">
                             <?php echo $berita->jenis_berita ?>
                        </p>

                        <a href="<?php echo base_url('berita/detail/'.$berita->slug_berita) ?>" class="s-text20">
                            Baca Selengkapnya
                            <i class="fa fa-long-arrow-right m-l-8" aria-hidden="true"></i>
                        </a>
                    <?php } ?>
                    </div>
                </div>
       
            <!-- Pagination -->
            <div class="pagination flex-m flex-w p-r-50">
                 <?php echo $pagin; ?>
            </div>
        </div>
    </div>
</div>
</section>