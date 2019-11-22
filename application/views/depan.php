<!DOCTYPE html>
<html lang="en">
    <?php $assets_image = base_url('assets_front/'); ?>
    <head>
        <title>HealthMe &mdash; Healthy Life , Healthy Me</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">

        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/jquery-ui.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/jquery.fancybox.min.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/aos.css">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>css/style.css">
    
    </head>
    <body>
  
        <div class="site-wrap">

            <div class="site-mobile-menu site-navbar-target">
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                    </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div>
            <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

                <div class="container">
                    <div class="row align-items-center">
                      
                        <div class="col-6 col-xl-2">
                            <h1 class="mb-0 site-logo"><a href="<?= base_url('depan')?>" class="text-black mb-0">HealthMe<span class="text-primary">.</span> </a></h1>
                        </div>
                        <div class="col-12 col-md-10 d-none d-xl-block">
                            <nav class="site-navigation position-relative text-right" role="navigation">

                                <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                                    <li><a href="#home-section" class="nav-link">Beranda</a></li>
                                    <li><a href="#pola-hidup-section" class="nav-link">Pola Hidup Sehat</a></li>
                                    <li><a href="#penyakit-section" class="nav-link">Penyakit</a></li>
                                    <?php if ($userLogin){ ?>
                                    <li><a href="<?= base_url('diagnosa') ?>" class="nav-link">Konsultasi</a></li>
                                    <li><a href="<?= base_url('login/logout') ?>" class="nav-link">Keluar</a></li>
                                    <?php } else { ?>
                                    <li><a href="<?= base_url('login') ?>" class="nav-link">Masuk</a></li>
                                    <li><a href="<?= base_url('daftar') ?>" class="nav-link">Daftar</a></li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>


                        <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>
                    </div>
                </div>
              
            </header>

      
         
            <div class="site-blocks-cover overlay" style="background-image: url(<?= $assets_image ?>images/home.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center justify-content-center">

                        <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                                    
                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <h1>Healthy With Us</h1>
                                    <p class="mb-5 lead">Sehat itu bukan suatu kemewahan. Sehat itu murah tetapi menjadi mahal ketika sehat telah berubah menjadi sakit.</p>
                                    <div>
                                        <a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Konsultasi  Sekarang</a>                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="site-section bg-light" id="pola-hidup-section">
                <div class="container">
                    <div class="row mb-5 justify-content-center">
                        <div class="col-md-6 text-center">
                            <h3 class="section-sub-title">Healthy Life Style</h3>
                            <h2 class="section-title mb-3">Pola Hidup Sehat</h2>
            			     <p>Pola hidup sehat adalah upaya seseorang untuk menjaga tubuhnya agar tetap sehat. Pola hidup sehat dapat dilakukan dengan cara mengonsumsi makanan bergizi, olahraga secara rutin, dan istirahat yang cukup.</p>
    		            </div>
                    </div>      
                    <div class="bg-white py-4 mb-4">
                        <div class="row mx-4 my-4 product-item-2 align-items-start">
                            <div class="col-md-6 mb-5 mb-md-0">
                                <img src="<?= $assets_image ?>images/makanan.png" alt="Image" class="img-fluid">
                            </div>
                       
                            <div class="col-md-5 ml-auto product-title-wrap">
                                <span class="number">01.</span>
                                <h3 class="text-black mb-4 font-weight-bold">Makanan 4 Sehat 5 Sempurna</h3>
                                <p class="mb-4">Makanan 4 sehat 5 sempurna adalah menu makanan yang lengkap dan mengandung zat gizi yang dibutuhkan oleh tubuh seperti karbohidrat, protein, vitamin dan mineral. Makanan 4 sehat terdiri dari nasi, lauk pauk, sayur-sayuran, dan buah-buahan. Sedangkan nutrisi kelima sebagai penyempurnanya adalah susu.</p>
                                <p>Pada pola makan 4 sehat 5 sempurna, terdapat masing-masing zat gizi yang terkandung dalam berbagai jenis makanan yang berbeda. Oleh karena itu, menu makanan haruslah beranekaragam agar kebutuhan gizi yang di perlukan tubuh terpenuhi.</p>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white py-4 mb-4">
                        <div class="row mx-4 my-4 product-item-2 align-items-start">
                            <div class="col-md-6 mb-5 mb-md-0 order-1 order-md-2">
                                <img src="<?= $assets_image ?>images/jogging.png" alt="Image" class="img-fluid">
                            </div>
                       
                            <div class="col-md-5 mr-auto product-title-wrap order-2 order-md-1">
                                <span class="number">02.</span>
                                <h3 class="text-black mb-4 font-weight-bold">Aktivitas Fisik</h3>
                                <p>Latihan kardio saja seperti misalnya jogging akan membuat penat dan bosan. Berikan tubuh lebih banyak olahraga yang menyenangkan dan berkelompok, seperti misalnya basket, sepak bola, renang, tenis, badminton atau voli dan masih banyak yang lain. Ini akan menyenangkan karena Anda sekaligus juga dapat bersosialisasi dengan orang lain sembari melakukan aktivitas yang sehat.</p>
                            </div>
                        </div>
                    </div>
    		
            		<div class="bg-white py-4 mb-4">
                        <div class="row mx-4 my-4 product-item-2 align-items-start">
                            <div class="col-md-6 mb-5 mb-md-0">
                                <img src="<?= $assets_image ?>images/makanan.png" alt="Image" class="img-fluid">
                            </div>
                       
                            <div class="col-md-5 ml-auto product-title-wrap">
                                <span class="number">03.</span>
                                <h3 class="text-black mb-4 font-weight-bold" style="text-transform: capitalize;">Kurangi makanan olahan dan makanan dalam kaleng</h3>
                                <p class="mb-4">Makanan  olahan atau kalengan sebaiknya dihindari karena berbagai alasan seperti misalnya; nilai gizi yang sering tidak sempurna, adanya pengawet yang ditambahkan yang dapat berdampak buruk bagi kesehatan, jika dikonsumsi terus menerus dan dalam jangka waktu panjang. Bahkan juga penambahan garam yang harus dipertimbangkan sebelum mengkonsumsi makanan olahan atau kalengan terlalu sering.</p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="site-section border-bottom" id="penyakit-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12 text-center">
                            <h2 class="section-sub-titleon-title mb-3">Penyakit</h2>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php foreach ($data_penyakit as $key => $value) {?>
                                <div class="col-md-4">
                                    <h4 style="font-weight: bold;text-align: center;"><?= $value->penyakit ?></h4>
                                    <h5><?= $value->keterangan ?></h5>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        	<div class="site-blocks-cover overlay get-notification" id="special-section" style="background-image: url(<?= $assets_image ?>images/home.jpg); background-attachment: fixed; background-position: top;" data-aos="fade">
                <div class="container">

                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-7 text-center">
                            <h3 class="section-sub-title">Consultation</h3>
                            <h3 class="section-title text-white mb-4">Konsultasi</h3>
                            <p class="mb-5 lead">Ketahui kesehatan anda melalui konsultasi dengan HealthMe untuk mendapatkan informasi kesehatan anda.</p>
                 
                            <p><a href="#" class="btn btn-white btn-outline-white py-3 px-5 rounded-0 mb-lg-0 mb-2 d-block d-sm-inline-block">Konsultasi Sekarang!</a></p>
                        </div>
                    </div>  

                </div>
            </div>
            <footer class="site-footer bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <h2 class="footer-heading mb-4">Tautan</h2>
                                    <ul class="list-unstyled">
                                        <li><a href="#home-section" class="nav-link">Beranda</a></li>
                                        <li><a href="#pola-hidup-section" class="nav-link">Pola Hidup Sehat</a></li>
                                        <li><a href="#penyakit-section" class="nav-link">Penyakit</a></li>
                                        <?php if ($userLogin){ ?>
                                        <li><a href="<?= base_url('diagnosa') ?>" class="nav-link">Konsultasi</a></li>
                                        <li><a href="<?= base_url('login/logout') ?>" class="nav-link">Keluar</a></li>
                                        <?php } else { ?>
                                        <li><a href="<?= base_url('login') ?>" class="nav-link">Masuk</a></li>
                                        <li><a href="<?= base_url('daftar') ?>" class="nav-link">Daftar</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row pt-5 mt-5 text-center">
                      <div class="col-md-12">
                        <div class="border-top pt-5">
                        <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <!--Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. 
                  </p>
                        </div>
                      </div>
                      
                    </div>-->
                </div>
            </footer>

        </div> <!-- .site-wrap -->

        <script src="<?= base_url('assets_front/') ?>js/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery-migrate-3.0.1.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery-ui.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/popper.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/bootstrap.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/owl.carousel.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery.stellar.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery.countdown.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery.easing.1.3.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/aos.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery.fancybox.min.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/jquery.sticky.js"></script>
        <script src="<?= base_url('assets_front/') ?>js/main.js"></script>
    
    </body>
</html>