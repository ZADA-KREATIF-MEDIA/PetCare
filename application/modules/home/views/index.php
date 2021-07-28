

<div class="ftco-blocks-cover-1">
   <div class="ftco-cover-1 overlay" style="background-image: url('<?php echo base_url('')?>assets/frontend/depan/images/box.jpg')">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-sm-6 col-lg-12">
               <h1>Anter#Anter</h1>
               <p class="mb-5">
                  <?php if($this->session->userdata('cust_id_customer')!=""):?>
                     <a href="<?php echo base_url('order');?>" class="btn btn-sm mb-2 btn-dark text-decoration-none">Kirim Barang</a>
                  <?php else:?>
                     <a href="<?php echo base_url('home/show_login');?>" class="btn btn-sm mb-2 btn-dark text-decoration-none">Kirim Barang</a>
                  <?php endif;?>
                  <a href="<?php echo base_url('home/daftar');?>" class="btn btn-sm mb-2 btn-warning text-decoration-none <?php if($this->session->userdata('cust_id_customer')!=""){ echo "d-none";}?>">Daftar Langganan</a>
                  <a href="mailto: busdev@anteranter.com" target="_blank" class="btn btn-sm mb-2 btn-success">Butuh Solusi Korporasi?</a>
                  <a href="https://play.google.com/store/apps/details?id=id.compro.anteranter"  target="_blank" class="btn btn-sm mb-2 btn-primary">Belanja di marketplace</a>
               </p>
            </div>
         </div>
      </div>
   </div>
   <!-- END .ftco-cover-1 -->
   <div class="ftco-service-image-1 pb-5">
      <div class="container">
         <div class="owl-carousel owl-all">
            <div class="service text-center">
               <a href="#"><img src="<?php echo base_url()?>assets/frontend/img/atas-1.jpeg" alt="Image" class="img-fluid"></a>
               <div class="px-md-3">
                  <h3><a href="#">Easy</a></h3>
                  <p></p>
               </div>
            </div>
            <div class="service text-center">
               <a href="#"><img src="<?php echo base_url()?>assets/frontend/img/atas-2.jpeg" alt="Image" class="img-fluid"></a>
               <div class="px-md-3">
                  <h3><a href="#">Cheap</a></h3>
                  <p></p>
               </div>
            </div>
            <div class="service text-center">
               <a href="#"><img src="<?php echo base_url()?>assets/frontend/img/atas-3.jpeg" alt="Image" class="img-fluid"></a>
               <div class="px-md-3">
                  <h3><a href="#">Package Forwarding</a></h3>
                  <p></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="site-section bg-light" id="services-section">
   <div class="container">
      <div class="row mb-5 justify-content-center">
         <div class="col-md-7 text-center">
            <div class="block-heading-1">
               <h2>What We Offer</h2>
               <p></p>
            </div>
         </div>
      </div>
      <div class="owl-carousel owl-all">
        
      </div>
   </div>
</div>
<!-- <div class="site-section" id="about-section">
   <div class="container">
      <div class="row mb-5 justify-content-center">
         <div class="col-md-7 text-center">
            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
               <h2>About Us</h2>
               <p></p>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="site-section bg-light" id="about-section">
   <div class="container">
      <div class="row justify-content-center mb-4 block-img-video-1-wrap">
         <div class="col-md-12 mb-5">
            <figure class="block-img-video-1" data-aos="fade">
               <img src="<?php echo base_url()?>assets/frontend/depan/images/cargo_delivery_big.jpg" alt="Image" class="img-fluid">
            </figure>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="row">
               <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="">
                  <div class="block-counter-1">
                     <span class="number"><span data-number="50">0</span>+</span>
                     <span class="caption">Years of Experience</span>
                  </div>
               </div>
               <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                  <div class="block-counter-1">
                     <span class="number"><span data-number="300">0</span>+</span>
                     <span class="caption">Companies</span>
                  </div>
               </div>
               <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                  <div class="block-counter-1">
                     <span class="number"><span data-number="108">0</span>+</span>
                     <span class="caption">Covered Countries</span>
                  </div>
               </div>
               <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                  <div class="block-counter-1">
                     <span class="number"><span data-number="1500">0</span>+</span>
                     <span class="caption">Couriers</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->
<div class="site-section" id="team-section">
   <div class="container">
      <div class="row mb-5 justify-content-center">
         <div class="col-md-7 text-center">
            <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
               <h2>Our Partner</h2>
               <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p> -->
            </div>
         </div>
      </div>
      <div class="owl-carousel owl-all">
         <div class="block-team-member-1 border-0 text-center h-100">
            <figure>
               <img src="<?php echo base_url()?>assets/frontend/img/yosalad.jpeg" alt="Image" class="img-fluid">
            </figure>
            <h3 class="font-size-20 text-black">Yosalad Jogja</h3>
         </div>
         <div class="block-team-member-1 border-0 text-center h-100">
            <figure>
               <img src="<?php echo base_url()?>assets/frontend/img/laku-laku.jpeg" alt="Image" class="img-fluid">
            </figure>
            <h3 class="font-size-20 text-black">Lakulaku</h3>
         </div>
         <div class="block-team-member-1 border-0 text-center h-100">
            <figure>
               <img src="<?php echo base_url()?>assets/frontend/img/hasil_tani.jpeg" alt="Image" class="img-fluid">
            </figure>
            <h3 class="font-size-20 text-black">Hasil tani</h3>
         </div>
         <div class="block-team-member-1 border-0 text-center h-100">
            <figure>
               <img src="<?php echo base_url()?>assets/frontend/img/resik.jpeg" alt="Image" class="img-fluid">
            </figure>
            <h3 class="font-size-20 text-black">Resik</h3>
         </div>
      </div>
   </div>
</div>


