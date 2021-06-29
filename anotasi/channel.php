<?php

$ch = $_GET['ch'];
if(!isset($_GET['ch'])){
  header("location: index.html");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bocor Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script type="text/javascript">
    const flt_cod = ["prank", "skit", "standup", "food", "daily", "review", "reaction", "podcast", "music", "clip", "reality", "game", "otomotive", "technology", "beauty", "education", "horror", "howto", "magic", "challenge", "discussion", "animation", "news"];
    const flt_str = ["Prank", "Comedy Skit", "Stand Up Comedy", "Food Vlog", "Daily Vlog", "Review", "Reaction", "Podcast", "Music", "Cuplikan Film", "Reality Show", "Gaming", "Otomotif", "Teknologi", "Beauty Vlog", "Edukasi", "Horor", "Tutorial", "Magic", "Challenge", "Diskusi", "Animasi", "Berita"];

    $(function(){
      $.get('datafinal.json',function(obj){
        var str = "";
        var desc = "";
        var flt = "<li data-filter='*' class='filter-active'>All</li>";
        obj = obj[<?php echo $ch; ?>];  
        
        obj.category.forEach((categ) => {
          var fltint = -1;
          for(let i = 0; i < flt_cod.length; i++){
            if(flt_cod[i].localeCompare(categ) == 0){
              fltint = i;
              break;
            }
          }
          flt += "<li data-filter='.filter-" + categ + "'>" + flt_str[fltint] + "</li>";
        });

        var channel_id = obj.channel_id;
        var channel_name = obj.channel_name;
        var channel_photo = obj.channel_photo;
        var subs_string = "" + obj.subs_count + " juta";
        var video_count = obj.video_count;
        var videos = obj.videos;

        var yt_link = "https://youtube.com/";
        if(channel_id.startsWith("UC")){
          yt_link += "channel/" + channel_id;
        } else {
          yt_link += "user/" + channel_id;
        }
        
        desc += "<h2 data-aos='fade-in'>" + channel_name + "</h2>";
        desc += "<a href='" + yt_link + "' class='channel-photo'><img src='"+ channel_photo +"' width='20%' height='auto' alt=''></a>";
        desc += "</br></br><p data-aos='fade-in'>" + subs_string + " subscribers.</p>"
        desc += "<p data-aos='fade-in'>" + video_count + " videos.</p>"
        
        $.each(videos,function(n,data){
          str += "<div class='offset-lg-4 col-lg-4 col-md-6 portfolio-item filter-" + data.category + "'>"

          str += "<div class='portfolio-wrap'>";
          
          str+= "<img src='"+ data.thumbnail +"' width='100%' height='auto' class='img-fluid' alt=''>";

          str += "<div class='portfolio-links'>";

          str += "<a href='"+ data.thumbnail +"' data-gallery='portfolioGallery' class='portfolio-lightbox' title='"+ data.title +"'><i class='bi bi-plus'></i></a>";

          str += "<a href='" + data.url + "' title='Watch'><i class='bi bi-link'></i></a> </div> <div class='portfolio-info'> <h4>"+ data.title +"</h4> </div> </div> </div>"
          
        });
        $('#portfolio-flters').html(flt);
        $('.portfolio-container').html(str);
        $('#channel-desc').html(desc);
        doIsotope();
      });
    });

    const select = (el, all = false) => {
      el = el.trim()
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    }

    const on = (type, el, listener, all = false) => {
      let selectEl = select(el, all)
      if (selectEl) {
        if (all) {
          selectEl.forEach(e => e.addEventListener(type, listener))
        } else {
          selectEl.addEventListener(type, listener)
        }
      }
    }

    function doIsotope(){
      let portfolioContainer = select('.portfolio-container');
      if (portfolioContainer) {
        let portfolioIsotope = new Isotope(portfolioContainer, {
          itemSelector: '.portfolio-item',
          layoutMode: 'vertical'
        });

        let portfolioFilters = select('#portfolio-flters li', true);

        on('click', '#portfolio-flters li', function(e) {
          e.preventDefault();
          portfolioFilters.forEach(function(el) {
            el.classList.remove('filter-active');
          });
          this.classList.add('filter-active');

          portfolioIsotope.arrange({
            filter: this.getAttribute('data-filter')
          });
          portfolioIsotope.on('arrangeComplete', function() {
            AOS.refresh()
          });
        }, true);
      }
      setTimeout(function(){select('.filter-active').click();}, 3000);
    }
  </script>

  <!-- =======================================================
  * Template Name: Bocor - v4.3.0
  * Template URL: https://bootstrapmade.com/bocor-bootstrap-template-nice-animation/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html">Bocor<span>.</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row d-flex align-items-center">
      <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
        <h1>Your new digital experience with Bocor</h1>
        <h2>We are team of talented designers making websites with Bootstrap</h2>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
        <img src="assets/img/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div id="channel-desc" class="section-title">
        </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up"></div>

      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row  justify-content-center">
          <div class="col-lg-6">
            <h3>Bocor</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
          </div>
        </div>

        <div class="row footer-newsletter justify-content-center">
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>

        <div class="social-links">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Bocor</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bocor-bootstrap-template-nice-animation/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script> 

  

  

</body>

</html>