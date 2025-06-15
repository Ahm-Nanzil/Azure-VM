<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Portfolio Details</title>
  
  <?php
    $canonical = "https://ahmnanzil.me/portfolio-details.php";
    if (isset($_GET['name'])) {
      $canonical .= "?name=" . urlencode($_GET['name']);
    }
  ?>
  <link rel="canonical" href="<?= $canonical ?>" />

  <!-- Favicons -->
  <link href="assets/img/web-developer-icon-10.jpg" rel="icon">
  <link href="assets/img/software_developer.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --light-bg: #f8fafc;
      --card-shadow: 0 20px 40px rgba(0,0,0,0.1);
      --hover-shadow: 0 30px 60px rgba(0,0,0,0.15);
      --text-primary: #2d3748;
      --text-secondary: #718096;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--primary-gradient);
      min-height: 100vh;
    }

    /* Breadcrumbs */
    #breadcrumbs {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      padding: 30px 0;
    }

    #breadcrumbs h2 {
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 700;
      font-size: 2.5rem;
      margin: 0;
    }

    #breadcrumbs ol li a {
      color: var(--text-secondary);
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    #breadcrumbs ol li a:hover {
      background: var(--accent-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Main Content */
    #main {
      background: var(--light-bg);
      min-height: calc(100vh - 200px);
      position: relative;
      overflow: hidden;
    }

    #main::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 20%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(245, 87, 108, 0.1) 0%, transparent 50%);
      pointer-events: none;
    }

    .portfolio-details {
      padding: 80px 0;
      position: relative;
      z-index: 1;
    }

    /* Image Slider */
    .portfolio-details-slider {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      background: white;
      position: relative;
      transition: all 0.3s ease;
      margin-bottom: 30px;
    }

    .portfolio-details-slider:hover {
      box-shadow: var(--hover-shadow);
      transform: translateY(-5px);
    }

    .portfolio-details-slider::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--primary-gradient);
      z-index: 10;
    }

    .portfolio-details-slider img {
      width: 100%;
      height: 500px;
      object-fit: cover;
    }

    .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 1;
      transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
      background: var(--primary-gradient);
      transform: scale(1.2);
    }

    /* Navigation Buttons */
    .swiper-button-next, .swiper-button-prev {
      color: #667eea !important;
      background: rgba(255, 255, 255, 0.9);
      width: 50px !important;
      height: 50px !important;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .swiper-button-next:hover, .swiper-button-prev:hover {
      background: rgba(255, 255, 255, 1);
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .swiper-button-next::after, .swiper-button-prev::after {
      font-size: 18px !important;
      font-weight: bold;
    }

    /* Cards */
    .portfolio-info {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 40px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.3);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      animation: fadeInUp 0.6s ease-out forwards;
      opacity: 0;
      transform: translateY(30px);
      height: fit-content;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .portfolio-description {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 40px;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.3);
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
      animation: slideInFromBottom 0.8s ease-out forwards;
      opacity: 0;
      transform: translateY(50px);
    }

    .portfolio-info:hover, .portfolio-description:hover {
      box-shadow: var(--hover-shadow);
      transform: translateY(-5px);
    }

    .portfolio-info::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--secondary-gradient);
    }

    .portfolio-description::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--accent-gradient);
    }

    .portfolio-description {
      animation-delay: 0.2s;
    }

    /* Overview Animation Effects */
    .portfolio-description p {
      color: var(--text-secondary);
      line-height: 1.8;
      font-size: 1.1rem;
      margin: 0;
    }

    /* Responsive Container for Vertical Alignment */
    .portfolio-info-container {
      display: flex;
      align-items: center;
      min-height: 530px; /* Match image height */
    }

    @media (max-width: 991px) {
      .portfolio-info-container {
        min-height: auto;
        margin-top: 0;
      }
    }

    .portfolio-info h3, .portfolio-description h2 {
      color: var(--text-primary);
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 15px;
    }

    .portfolio-info h3::after, .portfolio-description h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--primary-gradient);
      border-radius: 2px;
    }

    .portfolio-info ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .portfolio-info ul li {
      padding: 15px 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      transition: all 0.3s ease;
    }

    .portfolio-info ul li:last-child {
      border-bottom: none;
    }

    .portfolio-info ul li:hover {
      padding-left: 10px;
      background: rgba(102, 126, 234, 0.05);
      margin: 0 -20px;
      padding-right: 30px;
      border-radius: 10px;
    }

    .portfolio-info ul li strong {
      color: #667eea;
      font-weight: 600;
      min-width: 140px;
      font-size: 0.95rem;
    }

    .portfolio-info ul li a {
      color: #764ba2;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
    }

    .portfolio-info ul li a:hover {
      color: #667eea;
    }

    .portfolio-info ul li a::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary-gradient);
      transition: width 0.3s ease;
    }

    .portfolio-info ul li a:hover::after {
      width: 100%;
    }

    .portfolio-description p {
      color: var(--text-secondary);
      line-height: 1.8;
      font-size: 1.1rem;
      margin: 0;
    }

    /* Floating Elements */
    .floating-element {
      position: absolute;
      pointer-events: none;
      z-index: 0;
    }

    .floating-circle {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: rgba(102, 126, 234, 0.1);
      animation: float 6s ease-in-out infinite;
    }

    .floating-square {
      width: 60px;
      height: 60px;
      background: rgba(245, 87, 108, 0.1);
      transform: rotate(45deg);
      animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInFromBottom {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideInFromLeft {
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes typewriter {
      to {
        opacity: 1;
      }
    }

    /* Error State */
    .project-not-found {
      text-align: center;
      padding: 100px 20px;
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      margin: 50px auto;
      max-width: 600px;
    }

    .project-not-found h3 {
      color: var(--text-primary);
      font-size: 2rem;
      margin-bottom: 20px;
      background: var(--secondary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Responsive */
    @media (max-width: 768px) {
      #breadcrumbs h2 { font-size: 2rem; }
      .portfolio-details { padding: 40px 0; }
      .portfolio-info, .portfolio-description { padding: 25px; }
      .portfolio-details-slider img { height: 300px; }
    }
  </style>
</head>

<body>
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- Header -->
  <header id="header">
    <div class="d-flex flex-column">
      <div class="profile">
        <img src="assets/img/profile.jpg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.html">Ahm Nanzil</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="https://x.com/ahm_nanzil" class="twitter" target="_blank"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="https://www.instagram.com/ahm_nanzil77?igsh=MWxta3pxano1N3RrbQ==" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="https://www.linkedin.com/in/ahmnanzil" class="linkedin" target="_blank"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="index.html#hero" class="nav-link"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="index.html#about" class="nav-link"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="index.html#resume" class="nav-link"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
          <li><a href="index.html#portfolio" class="nav-link"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          <li><a href="index.html#services" class="nav-link"><i class="bx bx-server"></i> <span>Services</span></a></li>
          <li><a href="index.html#contact" class="nav-link"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="main">
    <!-- Breadcrumbs -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
          </ol>
        </div>
      </div>
    </section>

    <!-- Floating Elements -->
    <div class="floating-element floating-circle" style="top: 10%; left: 5%;"></div>
    <div class="floating-element floating-square" style="top: 60%; right: 10%;"></div>
    <div class="floating-element floating-circle" style="bottom: 20%; left: 20%; width: 60px; height: 60px;"></div>

    <!-- Portfolio Details -->
    <section id="portfolio-details" class="portfolio-details">
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

      <div class="container">
          <div class="row gy-4">
              <div class="col-lg-8">
                  <div class="portfolio-details-slider swiper">
                      <div class="swiper-wrapper align-items-center">
                          <?php
                          foreach ($project['images'] as $image) {
                              echo '<div class="swiper-slide"><img src="' . $image . '" alt="Project Image"></div>';
                          }
                          ?>
                      </div>
                      <div class="swiper-pagination"></div>
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                  </div>
              </div>

              <div class="col-lg-4">
                  <div class="portfolio-info-container">
                      <div class="portfolio-info">
                          <h3>Project Information</h3>
                          <ul>
                              <li><strong>Category</strong>: <?= $project['category'] ?></li>
                              <li><strong>Client</strong>: <?= $project['client'] ?></li>
                              <?php if (!empty($project['url'])): ?>
                              <li><strong>Project URL</strong>: <a href="<?= $project['url'] ?>" target="_blank"><?= $project['url'] ?></a></li>
                              <?php endif; ?>

                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-lg-12">
                  <div class="portfolio-description">
                      <h2>Project Overview</h2>
                      <p><?= $project['description'] ?></p>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer">
      <div class="container">
        <div class="copyright">Thank <strong><span>You</span></strong></div>
        <div class="credits">For Visiting <a href="http://ahmnanzil.great-site.net">My Portfolio</a></div>
      </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Scripts -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    // Initialize Swiper
    document.addEventListener('DOMContentLoaded', function() {
      const swiper = new Swiper('.portfolio-details-slider', {
        loop: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        effect: 'slide',
        speed: 600,
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 0
          },
          768: {
            slidesPerView: 1,
            spaceBetween: 0
          },
          1024: {
            slidesPerView: 1,
            spaceBetween: 0
          }
        }
      });
    });
  </script>
</body>
</html>