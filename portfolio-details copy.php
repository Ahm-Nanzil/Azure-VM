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
      --tertiary-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
      --quaternary-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
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

    /* Circular Portfolio Info Container */
    .portfolio-info-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 530px;
      position: relative;
      margin-top: 30px;
    }

    .circular-container {
      position: relative;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(255, 255, 255, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeInScale 0.8s ease-out forwards;
      opacity: 0;
      transform: scale(0.8);
      transition: all 0.4s ease;
      overflow: hidden;
    }

    .circular-container:hover {
      box-shadow: var(--hover-shadow);
      transform: scale(1.05);
    }

    .circular-container::before {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      border-radius: 50%;
      background: var(--primary-gradient);
      z-index: -1;
      animation: rotateGlow 4s linear infinite;
    }

    .info-items {
      position: relative;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .info-item {
      position: absolute;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: all 0.4s ease;
      cursor: pointer;
      backdrop-filter: blur(10px);
      border: 2px solid transparent;
      animation: bounceIn 0.6s ease-out forwards;
      opacity: 0;
      transform: scale(0);
    }

    .info-item:hover {
      transform: scale(1.15);
      z-index: 10;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    /* Different sizes for different item counts */
    .items-2 .info-item {
      width: 120px;
      height: 120px;
    }

    .items-3 .info-item {
      width: 100px;
      height: 100px;
    }

    .items-4 .info-item {
      width: 80px;
      height: 80px;
    }

    /* Positioning for different counts */
    .items-2 .info-item:nth-child(1) {
      top: 20%;
      left: 50%;
      transform: translateX(-50%);
      background: var(--primary-gradient);
      animation-delay: 0.2s;
    }

    .items-2 .info-item:nth-child(2) {
      bottom: 20%;
      left: 50%;
      transform: translateX(-50%);
      background: var(--secondary-gradient);
      animation-delay: 0.4s;
    }

    .items-3 .info-item:nth-child(1) {
      top: 15%;
      left: 50%;
      transform: translateX(-50%);
      background: var(--primary-gradient);
      animation-delay: 0.2s;
    }

    .items-3 .info-item:nth-child(2) {
      bottom: 25%;
      left: 20%;
      background: var(--secondary-gradient);
      animation-delay: 0.4s;
    }

    .items-3 .info-item:nth-child(3) {
      bottom: 25%;
      right: 20%;
      background: var(--accent-gradient);
      animation-delay: 0.6s;
    }

    .items-4 .info-item:nth-child(1) {
      top: 10%;
      left: 50%;
      transform: translateX(-50%);
      background: var(--primary-gradient);
      animation-delay: 0.2s;
    }

    .items-4 .info-item:nth-child(2) {
      top: 50%;
      left: 10%;
      transform: translateY(-50%);
      background: var(--secondary-gradient);
      animation-delay: 0.4s;
    }

    .items-4 .info-item:nth-child(3) {
      top: 50%;
      right: 10%;
      transform: translateY(-50%);
      background: var(--accent-gradient);
      animation-delay: 0.6s;
    }

    .items-4 .info-item:nth-child(4) {
      bottom: 10%;
      left: 50%;
      transform: translateX(-50%);
      background: var(--tertiary-gradient);
      animation-delay: 0.8s;
    }

    .info-item h1, .info-item h2, .info-item h3 {
      margin: 0;
      font-weight: 700;
      color: white;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      font-size: 0.7rem;
      line-height: 1.2;
    }

    .info-item .value {
      font-size: 0.6rem;
      color: rgba(255, 255, 255, 0.9);
      margin-top: 5px;
      font-weight: 500;
      text-shadow: 0 1px 2px rgba(0,0,0,0.3);
    }

    .info-item .value a {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .info-item .value a:hover {
      color: white;
      text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
    }

    /* Central Title */
    .central-title {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      width: 140px;
      height: 140px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      animation: pulseGlow 2s ease-in-out infinite alternate;
      z-index: 5;
    }

    .central-title h3 {
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 700;
      font-size: 1.1rem;
      margin: 0;
      line-height: 1.3;
    }

    /* Portfolio Description */
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
      animation-delay: 1s;
    }

    .portfolio-description:hover {
      box-shadow: var(--hover-shadow);
      transform: translateY(-5px);
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

    .portfolio-description h2 {
      color: var(--text-primary);
      font-weight: 700;
      font-size: 1.8rem;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 15px;
    }

    .portfolio-description h2::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--primary-gradient);
      border-radius: 2px;
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

    /* Animations */
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    @keyframes fadeInScale {
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes bounceIn {
      0% {
        opacity: 0;
        transform: scale(0);
      }
      60% {
        opacity: 1;
        transform: scale(1.2);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes slideInFromBottom {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes rotateGlow {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    @keyframes pulseGlow {
      0% { 
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transform: translate(-50%, -50%) scale(1);
      }
      100% { 
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        transform: translate(-50%, -50%) scale(1.05);
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
    @media (max-width: 992px) {
      .portfolio-info-container {
        min-height: auto;
        margin-top: 30px;
      }
      
      .circular-container {
        width: 350px;
        height: 350px;
      }
      
      .central-title {
        width: 120px;
        height: 120px;
      }
      
      .central-title h3 {
        font-size: 1rem;
      }
    }

    @media (max-width: 768px) {
      #breadcrumbs h2 { font-size: 2rem; }
      .portfolio-details { padding: 40px 0; }
      .portfolio-description { padding: 25px; }
      .portfolio-details-slider img { height: 300px; }
      
      .circular-container {
        width: 300px;
        height: 300px;
      }
      
      .central-title {
        width: 100px;
        height: 100px;
      }
      
      .central-title h3 {
        font-size: 0.9rem;
      }
      
      .items-2 .info-item {
        width: 90px;
        height: 90px;
      }
      
      .items-3 .info-item {
        width: 75px;
        height: 75px;
      }
      
      .items-4 .info-item {
        width: 60px;
        height: 60px;
      }
      
      .info-item h1, .info-item h2, .info-item h3 {
        font-size: 0.6rem;
      }
      
      .info-item .value {
        font-size: 0.5rem;
      }
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
      // Sample project data for demonstration
      $project = [
        'name' => 'E-Commerce Platform',
        'category' => 'Web Development',
        'client' => 'Tech Solutions Inc.',
        'url' => 'https://example.com',
        'time' => 'March 2024',
        'description' => 'A comprehensive e-commerce platform built with modern web technologies. Features include user authentication, payment integration, inventory management, and responsive design. The platform handles thousands of concurrent users and processes secure transactions with advanced encryption.',
        'images' => [
          'https://via.placeholder.com/800x500/667eea/ffffff?text=Project+Image+1',
          'https://via.placeholder.com/800x500/764ba2/ffffff?text=Project+Image+2',
          'https://via.placeholder.com/800x500/f093fb/ffffff?text=Project+Image+3'
        ]
      ];

      if (!$project) {
          echo '<div class="container"><div class="project-not-found">';
          echo '<h3>Project not found!</h3>';
          echo '<p>The project you are looking for does not exist or has been moved.</p>';
          echo '</div></div>';
          exit;
      }

      // Count available items
      $infoItems = [];
      if (!empty($project['category'])) $infoItems[] = ['label' => 'Category', 'value' => $project['category']];
      if (!empty($project['client'])) $infoItems[] = ['label' => 'Client', 'value' => $project['client']];
      if (!empty($project['url'])) $infoItems[] = ['label' => 'URL', 'value' => $project['url'], 'link' => true];
      if (!empty($project['time'])) $infoItems[] = ['label' => 'Date', 'value' => $project['time']];
      
      $itemCount = count($infoItems);
      $headerTags = ['h1', 'h2', 'h3', 'h4'];
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
                      <div class="circular-container">
                          <div class="info-items items-<?= $itemCount ?>">
                              <?php
                              for ($i = 0; $i < $itemCount; $i++) {
                                  $item = $infoItems[$i];
                                  $headerTag = $headerTags[$i] ?? 'h4';
                                  echo '<div class="info-item">';
                                  echo '<' . $headerTag . '>' . $item['label'] . '</' . $headerTag . '>';
                                  if (isset($item['link']) && $item['link']) {
                                      echo '<div class="value"><a href="' . $item['value'] . '" target="_blank">Visit</a></div>';
                                  } else {
                                      echo '<div class="value">' . $item['value'] . '</div>';
                                  }
                                  echo '</div>';
                              }
                              ?>
                          </div>
                          <div class="central-title">
                              <h3>Project Information</h3>
                          </div>
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

    // Add interactive hover effects
    const infoItems = document.querySelectorAll('.info-item');
    infoItems.forEach((item) => {
      item.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.2)';
        this.style.zIndex = '20';
      });
      
      item.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.zIndex = '1';
      });
    });

    // Add click ripple effect
    const circularContainer = document.querySelector('.circular-container');
    circularContainer.addEventListener('click', function(e) {
      const ripple = document.createElement('div');
      ripple.style.position = 'absolute';
      ripple.style.borderRadius = '50%';
      ripple.style.background = 'rgba(102, 126, 234, 0.3)';
      ripple.style.transform = 'scale(0)';
      ripple.style.animation = 'ripple 0.6s linear';
      ripple.style.left = `${e.offsetX - 50}px`;
      ripple.style.top = `${e.offsetY - 50}px`;
      ripple.style.width = '100px';
      ripple.style.height = '100px';
      ripple.style.pointerEvents = 'none';

      // Add the ripple element
      this.appendChild(ripple);

      // Remove ripple after animation ends
      ripple.addEventListener('animationend', () => {
        ripple.remove();
      });
    });
  });
</script>

<style>
  @keyframes ripple {
    to {
      transform: scale(2);
      opacity: 0;
    }
  }
</style>
