<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Apollo XIII Pastry Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('styles/Userstyle.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<style>
  html, body {
  scroll-behavior: smooth;
  font-family: 'Poppins', sans-serif;
  font-size: 16px; /* base font size */
  }

  /* Hero Section */
  #hero-section {
    height: 100vh;
    position: relative;
    color: white;
    text-align: center;
  }
h1, h2, h3, h4, h5 {
  font-weight: 600;
}

h2 {
  font-size: 2.2rem;
}

p {
  font-size: 1.1rem;
  line-height: 1.7;
}

    .store-description {
    font-size: 1.4rem;
    }

    .motto {
    font-size: 1.5rem;
    }

    .card-title {
    font-size: 1.25rem;
    font-weight: 600;
    }

    .card-text {
    font-size: 1.05rem;
    }

    blockquote p {
    font-size: 1.2rem;
    }

    footer {
    font-size: 1rem;
    }
  #bg-video {
    position: absolute;
    top: 0;
    left: 0;
    min-width: 100%;
    min-height: 100%;
    object-fit: cover;
    z-index: -2;
  }

  .overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4));
    z-index: -1;
  }

  .bg-container {
    z-index: 1;
    padding: 2rem;
  }

  .logo {
    max-width: 400px;
    margin-bottom: 1.5rem;
    animation: fadeInDown 1s ease-out;
  }

  .store-description {
    font-size: 1.3rem;
    margin: 1rem auto;
    max-width: 720px;
    animation: fadeIn 2s ease-in;
  }

  .motto {
    font-style: italic;
    font-size: 1.6rem;
    color: #f7d774;
    margin-top: 1rem;
    animation: fadeIn 2.5s ease-in;
  }

  .start-button {
    margin-top: 2rem;
    background-color: rgb(202, 158, 64);
    color: white;
    font-size: 1.3rem;
    padding: 12px 40px;
    border: none;
    border-radius: 50px;
    transition: 0.3s ease;
  }

  .start-button:hover {
    background-color: rgb(218, 170, 58);
    transform: scale(1.05);
  }

  /* About Section */
  #about {
    background-color: #fffdf5;
    padding: 4rem 2rem;
  }

  #about p {
    text-align: justify;
  }

  /* Why Choose Us Section */
  #why-choose {
    background: #fdf8ee;
    padding: 4rem 2rem;
  }

  .why-icon {
    font-size: 3rem;
    color: #c49b42;
    margin-bottom: 1rem;
  }

  /* Testimonials */
  #testimonials {
    background-color: #f7f4ed;
    padding: 4rem 2rem;
  }

  .testimonial {
    font-style: italic;
    color: #444;
  }

  .card:hover {
    transform: scale(1.02);
    transition: transform 0.3s ease;
  }

  .card-img-top {
    height: 200px;
    object-fit: cover;
  }

  #intro-section {
    padding: 4rem 2rem;
    background: linear-gradient(to bottom right, #f3e7d9, #fffbe8);
    text-align: center;
  }

  footer {
    background-color: #343a40;
    color: #eee;
    padding: 2rem;
  }

  footer a {
    color: #f7d774;
    text-decoration: none;
  }
  
@media (max-width: 768px) {
  h2 {
    font-size: 1.8rem;
  }

  p, .card-text, .store-description, .motto {
    font-size: 1rem;
  }
}
  @keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
</style>
</head>
<body>

<!-- Hero Section -->
<section id="hero-section" class="d-flex flex-column justify-content-center align-items-center text-white">
  <video autoplay muted loop playsinline id="bg-video">
    <source src="<?= base_url('upload/kakanin_intro.mp4') ?>" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="overlay"></div>
  <div class="bg-container text-center">
    <img class="logo" src="<?= base_url('upload/logo.png') ?>" alt="Apollo XIII Store Logo">
    <div class="store-description">
      Welcome to <strong>Apollo XIII Store</strong>, where every treat tells a story. Inspired by our family's rich heritage and generations of passion, we offer the finest Filipino delicacies—from cherished kakanin to delectable pastries. Experience the taste of tradition, made with love and deep local pride.
    </div>
    <div class="motto">"Tilawi, diri mo gud hingangalimtan."</div>
  </div>
</section>

<!-- About Us Section -->
<section id="about">
  <div class="container">
    <h2 class="text-center mb-4">About Apollo XIII</h2>
    <div class="row">
      <div class="col-md-12">
        <p><strong>Apollo XIII Pastry Shop</strong> is more than a store — it's a story of love, tradition, and legacy. We began in Carigara with the simple mission of sharing our family’s handmade delicacies with the world.</p>
        <p>Our shop’s name comes from “Apo” (grandchild in Waray) and the number 13 — honoring our 13 grandchildren who inspire us daily. Every item we serve is infused with the warmth of family gatherings and the joy of Filipino celebrations.</p>
        <p>Whether it's the fluffiness of our <em>puto</em>, the richness of our <em>moron</em>, or the golden texture of our <em>suman latik</em>, you're tasting generations of heritage baked into every bite.</p>
        <p>We serve not just food, but a connection — to home, to loved ones, to our roots.</p>
        <blockquote class="blockquote text-center mt-4">
          <p class="mb-0 fst-italic">"A pastry from Apollo XIII isn’t just food—it’s a story, a memory, and a warm embrace."</p>
        </blockquote>
      </div>
    </div>
  </div>
</section>


<!-- Home / Product Highlights Section -->
<section id="home" class="py-5">
  <div class="container text-center">
    <h2 class="mb-4">Our Sought-After Products</h2>
    <p class="mb-5">Explore handcrafted Filipino delicacies made with tradition and care.</p>
    <div class="row">
      <!-- Product: Puto -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <img src="<?= base_url('upload/puto_1715824216_1716683793.jpg') ?>" class="card-img-top" alt="Puto">
          <div class="card-body">
            <h5 class="card-title">Puto</h5>
            <p class="card-text">Soft, fluffy, and delicately sweet. A staple at every Filipino celebration.</p>
          </div>
        </div>
      </div>
      <!-- Product: Moron -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <img src="<?= base_url('upload/moron_1715824209_1716683957.jpg') ?>" class="card-img-top" alt="Moron">
          <div class="card-body">
            <h5 class="card-title">Moron</h5>
            <p class="card-text">A specialty from Leyte — rich chocolate-flavored rice cake wrapped in banana leaves.</p>
          </div>
        </div>
      </div>
      <!-- Product: Suman Latik -->
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <img src="<?= base_url('upload/suman-latik_1715824243_1716683985.jpg') ?>" class="card-img-top" alt="Suman Latik">
          <div class="card-body">
            <h5 class="card-title">Suman Latik</h5>
            <p class="card-text">Sticky rice rolls topped with golden coconut curds (latik), offering a rich and authentic Filipino treat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="why-choose">
  <div class="container text-center">
    <h2 class="mb-4">Why Choose Apollo XIII?</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="why-icon">🌿</div>
        <h5>All-Natural Ingredients</h5>
        <p>No preservatives. Just local, fresh ingredients from our kitchen to your table.</p>
      </div>
      <div class="col-md-4">
        <div class="why-icon">👨‍👩‍👧‍👦</div>
        <h5>Family-Owned Legacy</h5>
        <p>Every product is made with the same love and care passed down through generations.</p>
      </div>
      <div class="col-md-4">
        <div class="why-icon">🚚</div>
        <h5>Local Delivery</h5>
        <p>We deliver to nearby towns with advance notice to ensure your order stays fresh and arrives on time. Prefer to pick up? You're always welcome at our shop — and we happily accommodate bulk orders too!</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA / Intro Section -->
<section id="intro-section">
  <h2 class="mb-3">Ready to explore our delicacies?</h2>
  <p class="lead mb-4">Click below to start your journey into delicious Filipino treats!</p>
  <p class="lead mb-4">We prepare every order with care. Submit at least <strong>2 days in advance.</strong></p>
  <a role="button" class="btn start-button" href="<?= site_url('/home') ?>">🛒 ORDER HERE</a>
</section>
</body>
<footer class="bg-dark text-white pt-4 pb-3 mt-5">
  <div class="container">
    <div class="row text-center text-md-start">
      <!-- Brand and Contact Info -->
      <div class="col-md-4 mb-3">
        <h5 class="fw-bold">Apollo XIII Pastry Shop</h5>
        <p class="mb-1 small">906 Jose Riel Street Sawang Carigara Leyte</p>
        <p class="mb-1 small">Phone: 09513698085</p>
        <p class="mb-0 small">Email: apolloxiii@gmail.com</p>
      </div>

      <!-- Social Media -->
      <div class="col-md-4 mb-3 text-md-end">
        <h6 class="fw-semibold">Follow Us</h6>
        <a href="https://www.facebook.com/people/Apollo-XIII-Pastry-Shop/61577788491769/" class="text-white fs-5 me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-white fs-5 me-2"><i class="bi bi-instagram"></i></a>
      </div>
    </div>

    <hr class="border-secondary my-2">

    <div class="text-center small">
      <p class="mb-0">&copy; <?= date('Y') ?> Apollo XIII. All rights reserved.</p>
    </div>
  </div>
</footer>
</html>
