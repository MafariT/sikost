<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKOST</title>
    <style>
        body {
            margin: 0;
            font-family: "Calibri", sans-serif;
            
            
            background-image: url('{{ asset("img/apartemen.jpg") }}'); 
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
        nav {
            background: #081F5C; /* Midnight */
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgb(255, 255, 255);
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }
        .hero {
            text-align: center;
            padding: 130px 20px 220px; 
            
       
            background: rgba(237, 241, 246, 0.85); 
        }
        .hero h1 {
            color: #081F5C;
            font-size: 52px;
            margin-bottom: 16px;
            font-family: "Calibri", serif;
        }
        .hero p {
            font-size: 20px;
            color: #334EAC; /* Royal */
            margin-bottom: 35px;
        }
        .btn-primary {
            background: #334EAC; 
            color: white;
            padding: 15px 35px;
            border-radius: 8px;
            font-size: 19px;
            text-decoration: none;
            transition: .3s;
        }
        .btn-primary:hover {
            background: #081F5C;
        }
        .features {
           
            background: rgba(208, 227, 255, 0.9); 
            padding: 90px 20px;
            text-align: center;
        }
        .features h2 {
            color: #081F5C;
            font-size: 36px;
            margin-bottom: 40px;
        }
        .feature-box {
            max-width: 900px;
            margin: auto;
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .feature-item {
            background: white;
            padding: 25px;
            width: 260px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            color: #334EAC;
            font-size: 20px;
            font-weight: 500;
        }
        footer {
            background: #081F5C;
            color: #BAD6EB; /* Sky */
            text-align: center;
            padding: 60px;
            margin-top: 0px;
        }
    </style>
</head>
<body>

<nav>
    <div class="logo"><strong>SIKOST</strong></div>
    <div class="menu">
        <a href="#">Beranda</a>
        <a href="#">Cari Kamar</a>
        <a href="#">Tentang</a>
        <a href="#">Login</a>
    </div>
</nav>

<section class="hero">
    <h1>Selamat Datang di SIKOST!</h1>
    <p>Sistem Penyewaan Kamar Kost Secara Online</p>
    <a href="#" class="btn-primary">Mulai Cari Kamar</a>
</section>

<section class="features">
    <h2>Mengapa SIKOST?</h2>
    <div class="feature-box">
        <div class="feature-item">Booking Kamar Kapan Pun</div>
        <div class="feature-item">Aman dan Nyaman</div>
        <div class="feature-item">Harga lengkap & transparan</div>
        <div class="feature-item">Check-in & Check-Out dimana saja</div>
    </div>
</section>

<footer>
    © 2025 SIKOST — Platform Penyewaan Kos Online
</footer>

</body>
</html>