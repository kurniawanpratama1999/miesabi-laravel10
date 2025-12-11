@extends('layout')

@section('title', 'Dashboard | Mie Sabi')

@section('content')
 <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
<style>
    .mie-sabi-container {
    background-color: #fcf9e8; 
    min-height: 100vh; 
    display: flex;
    align-items: center;
}

/
.display-3 {
    font-size: 4rem;
    line-height: 1.1;
    color: #333;
}


.hero-img {
    max-width: 400px; 
    height: auto;
    object-fit: cover;
}


@media (max-width: 991.98px) {
    
    
    .mie-sabi-container {
        min-height: auto;
    }
    
   
    .display-3 {
        font-size: 2.5rem;
    }

    
    .text-content {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }

    
    .info-text {
        max-width: 90%;
    }
    
    
    .hero-img {
        max-width: 90%; 
        margin-top: 1rem !important; 
    }
}
.animate__animated.animate__swing {
  --animate-duration: 4s;
}

@media (max-width: 575.98px) {
    .display-3 {
        font-size: 2rem;
    }
}
</style>
<div class="container-fluid mie-sabi-container">
        <div class="row align-items-center h-100">

            <div class="col-lg-6 col-12 text-content ps-5">
                <p class="text-danger fw-bold mb-1">Mie Sabi Berdiri sejak Juli 2023</p>
                <h1 class="display-3 fw-bold mb-3 animate__animated animate__jello">Freshness in every bite</h1>
                <p class="fs-5 mb-2">Pesan Sekarang dan dapat diantar</p>
                <p>Mie Sabi sudah hadir di dua cabang, yaitu Kebon Jeruk (Jakarta Barat) dan Raden Patah (Jakarta Selatan) <br>
            Setiap Jumat, jangan lewatkan program spesial Mie Sabi yaitu Voucher Jumat Berkah, dengan pembagian 100–200 porsi gratis yang dimulai pukul 13.00 setelah salat Jumat.</p>
                <p class="text-muted small mt-4 mb-5">
                    *Pemesanan online hanya dikirim dengan radius 10km dari tempat mie sabi
                </p>
                
            </div>

            <div class="col-lg-6 col-12 image-content">
                <div class="dish-illustration">
                    <img class="mt-5 mb-4 rounded animate__animated animate__swing" width="400" src="/gerobak.jpeg" alt="">
             </div>
            </div>
        </div>
    </div>
@endsection