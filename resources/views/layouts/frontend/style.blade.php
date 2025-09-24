 <style>
     body {
         background-color: #f0f2f5;
         /* Warna latar belakang ringan */
     }

     .navbar {
         background-color: #2c3e50;
         /* Warna navbar gelap */
     }

     .navbar .nav-link,
     .navbar .navbar-brand {
         color: #ecf0f1 !important;
         /* Warna teks navbar */
     }

     .hero-section {
         background: url('https://wallpapercave.com/wp/wp6600435.jpg') no-repeat center center/cover;
         /* Ganti dengan gambar anime */
         color: white;
         padding: 100px 0;
         text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
     }

     .anime-card {
         margin-bottom: 20px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         transition: transform 0.2s;
         height: 100%;
         /* Pastikan tinggi kartu seragam */
         display: flex;
         flex-direction: column;
     }

     .anime-card:hover {
         transform: translateY(-5px);
     }

     .anime-card .card-body {
         flex-grow: 1;
         /* Biarkan konten mengisi sisa ruang */
         display: flex;
         flex-direction: column;
         justify-content: space-between;
     }

     .anime-card .card-text {
         font-size: 0.9rem;
         color: #555;
     }

     .footer {
         background-color: #34495e;
         /* Warna footer gelap */
         color: white;
         padding: 40px 0;
     }
 </style>
