<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Portfolio Details - iPortfolio Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

    <?php
    $canonical = "https://ahmnanzil.me/portfolio-details.php";
    if (isset($_GET['name'])) {
      $canonical .= "?name=" . urlencode($_GET['name']);
    }
  ?>
  <link rel="canonical" href="<?= $canonical ?>" />


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Updated: Jun 29 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="portfolio-details-page">

  <header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      <img src="assets/img/mine.jpg" alt="" class="img-fluid rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename">Ahm Nanzil</h1>
    </a>

    <div class="social-links text-center">
      <a href="https://x.com/ahm_nanzil" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/ahm_nanzil77?igsh=MWxta3pxano1N3RrbQ==" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
      <a href="https://www.linkedin.com/in/ahmnanzil" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
        <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
        <li><a href="#resume"><i class="bi bi-file-earmark-text navicon"></i> Resume</a></li>
        <li><a href="#portfolio"><i class="bi bi-images navicon"></i> Portfolio</a></li>
        <!-- <li><a href="#services"><i class="bi bi-hdd-stack navicon"></i> Services</a></li> -->
        <li class="dropdown">
          <a href="#services">
            <i class="bi bi-menu-button navicon"></i>
            <span>Services</span>
            <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul>
            <li><a href="#custom-web-dev">Web Development</a></li>
            <li><a href="#software-dev">Software Apps</a></li>
            <li><a href="#ecommerce">E-commerce</a></li>
            <li><a href="#api-integration">API Integration</a></li>
            <li><a href="#database">Database</a></li>
            <li><a href="#maintenance">Support</a></li>
            <li><a href="#bug-fix">Bug Fixes</a></li>
            <li><a href="#coding-help">Coding Help</a></li>
            <li><a href="#hosting">DevOps & Hosting</a></li>
          </ul>
        </li>

        <li><a href="#contact"><i class="bi bi-envelope navicon"></i> Contact</a></li>
      </ul>
    </nav>

  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Portfolio Details</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Portfolio Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

            <?php
            $jsonData = file_get_contents('projects.json');
            $projects = json_decode($jsonData, true);
            $name = $_GET['name'] ?? '';
            $project = null;

            foreach ($projects as $p) {
                if ($p['name'] === $name) {
                    $project = $p;
                    break;
                }
            }

            if (!$project) {
                echo '<div class="container"><div class="project-not-found">';
                echo '<h3>Project not found!</h3>';
                echo '<p>The project you are looking for does not exist or has been moved.</p>';
                echo '</div></div>';
                exit;
            }
            ?>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
              <div class="row gy-4">

                <div class="col-lg-8">
                  <div class="portfolio-details-slider swiper init-swiper">

                    <script type="application/json" class="swiper-config">
                      {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                          "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                          "el": ".swiper-pagination",
                          "type": "bullets",
                          "clickable": true
                        }
                      }
                    </script>

                    <div class="swiper-wrapper align-items-center">
                      <?php foreach ($project['images'] as $img): ?>
                        <div class="swiper-slide">
                          <img src="<?= htmlspecialchars($img) ?>" alt="">
                        </div>
                      <?php endforeach; ?>
                    </div>

                    <div class="swiper-pagination"></div>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                    <h3>Project information</h3>
                    <ul>
                      <li><strong>Category</strong>: <?= htmlspecialchars($project['category']) ?></li>
                      <li><strong>Client</strong>: <?= htmlspecialchars($project['client']) ?></li>
                      <li><strong>Project URL</strong>: <a href="<?= htmlspecialchars($project['url']) ?>" target="_blank"><?= htmlspecialchars($project['url']) ?></a></li>
                    </ul>
                  </div>

                  <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                    <h2><?= htmlspecialchars($project['client']) ?> Project</h2>
                    <p><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                  </div>
                </div>

              </div>
            </div>

          </section><!-- /Portfolio Details Section -->

  </main>

  <style>
    .social-connections {
      margin-top: 50px;
      position: relative;
      padding-top: 20px;
    }

    .social-connections::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 2px;
      background: linear-gradient(to right, transparent, rgba(20, 157, 221, 0.5), transparent);
    }

    .social-connections h4 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 25px;
      color: #173b6c;
    }

    .social-icons {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    .social-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #f5f8fd;
      color: #149ddd;
      font-size: 22px;
      transition: all 0.3s ease;
      border: 1px solid rgba(20, 157, 221, 0.1);
      position: relative;
      overflow: hidden;
    }

    .social-icon::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #149ddd, #64b5f6);
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: -1;
    }

    .social-icon:hover {
      color: white;
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(20, 157, 221, 0.3);
      border-color: transparent;
    }

    .social-icon:hover::before {
      opacity: 1;
    }

    .footer .copyright {
          margin-top: 2rem;
      }

  </style>
  <footer id="footer" class="footer position-relative light-background">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
              <div class="social-connections">
                <h4>Connect With Me</h4>
                <div class="social-icons">
                  <a href="https://github.com/Ahm-Nanzil" target="_blank" class="social-icon"><i class="bi bi-github"></i></a>
                  <a href="https://www.linkedin.com/in/ahmnanzil" target="_blank" class="social-icon"><i class="bi bi-linkedin"></i></a>
                  <a href="https://x.com/ahm_nanzil" target="_blank" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                  <a href="https://www.instagram.com/ahm_nanzil77?igsh=MWxta3pxano1N3RrbQ==" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.upwork.com/freelancers/~0188c3e0f408323508?mp_source=share" target="_blank" class="social-icon">Up</a>
                  <a href="https://www.fiverr.com/s/qD6ZbRZ" target="_blank" class="social-icon">Fi</a>
                </div>
              </div>
        </div>
      </div>
      <div class="copyright text-center ">
          <p>&copy; <span id="currentYear"></span> All Rights Reserved | Designed with 
                  <i class="bi bi-heart-fill" style="color: #e25555;"></i> 
                  by <a href="#">Ahm Nanzil</a>
                </p>      
      </div>
     <script>
            document.getElementById("currentYear").textContent = new Date().getFullYear();
      </script>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/typed.js/typed.umd.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>