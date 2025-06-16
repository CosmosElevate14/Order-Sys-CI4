<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Home</title>
    <style>
        /* Full screen background */
        body, html {
            height: 100dvh;
            width: 100dvw;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .bg-container {
            position: relative;
            z-index: 1;
            color: white; /* or any color to contrast the video */
            padding: 2rem;
        }

        .logo {
            z-index: 10;
        }
       
        .start-button {
            background-color: rgb(202, 158, 64);
            color: white;
            font-size: 36px; 
            padding: 10px 30px; 
            border: none;
            cursor: pointer;
            border-radius: 15px; 
            transition: background-color 0.3s;
        }

        .start-button:hover {
            background-color: rgb(212, 160, 46);
        } 
    </style>
</head>
<body>
    <!-- Logo Image -->
    
    <video autoplay muted loop playsinline id="bg-video">
        <source src="<?= base_url('upload/kakanin_intro.mp4') ?>" type="video/mp4">
    </video>
    <div class="bg-container">
        <div class="h-100 w-100 d-flex flex-column align-items-center justify-content-center">
            <img class="logo" src="<?= base_url('upload/logo.png') ?>" alt="Apollo XIII Store Logo">
            <a role="button" class="btn start-button mt-5" href="<?= site_url('/home') ?>">
                Start Now
            </a>
        </div>
    </div>
</body>
</html>
