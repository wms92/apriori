<!DOCTYPE html>
<html lang="en">
    <head>
        <title>HealthMe &mdash; Healthy Life , Healthy Me</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets_front/') ?>fonts/icomoon/style.css">

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
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
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
                            <li><a href="<?= base_url('login') ?>" class="nav-link">Masuk</a></li>
                            <li><a href="<?= base_url('daftar') ?>" class="nav-link">Daftar</a></li>
                      </ul>
                    </nav>
                  </div>


                  <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a></div>

                </div>
              </div>
              
            </header>

            <div class="site-section bg-light" id="contact-section">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12 text-center">
                            <h2 class="section-title mb-3">Daftar</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-7 mb-5">

                            <form action="<?= base_url('daftar/register');?>" method="post" class="p-5 bg-white">
                              
                                <div class="row form-group">                
                                    <div class="col-md-12">
                                        <label class="text-black" for="username">Nama Lengkap</label> 
                                        <input type="text" id="email" name="nama" class="form-control rounded-0" required>
                                    </div>
                                </div>

                                <div class="row form-group">                
                                    <div class="col-md-12">
                                        <label class="text-black" for="username">Jenis Kelamin</label> 
                                        <select class="form-control rounded-0" name="jk">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">                
                                    <div class="col-md-12">
                                        <label class="text-black" for="username">Umur</label> 
                                        <input type="text" id="email" name="umur" class="form-control rounded-0">
                                    </div>
                                </div>

                                <div class="row form-group">                
                                    <div class="col-md-12">
                                        <label class="text-black" for="username">Email</label> 
                                        <input type="email" id="email" name="email" class="form-control rounded-0">
                                    </div>
                                </div>

                                <div class="row form-group">                
                                    <div class="col-md-12">
                                        <label class="text-black" for="username">Username</label> 
                                        <input type="text" id="email" name="username" class="form-control rounded-0" required>
                                    </div>
                                </div>

                                <div class="row form-group">                
                                    <div class="col-md-12">
                                        <label class="text-black" for="password">Password</label> 
                                        <input type="password" id="email" name="password" class="form-control rounded-0" required>
                                    </div>
                                </div>

                             
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Log In" class="btn btn-black rounded-0 py-3 px-4">
                                    </div>
                                </div>  
                            </form>
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
                                        <li><a href="<?= base_url('login') ?>" class="nav-link">Masuk</a></li>
                                        <li><a href="<?= base_url('daftar') ?>" class="nav-link">Daftar</a></li>
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