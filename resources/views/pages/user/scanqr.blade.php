@extends('layout')

@section('title', 'ScanQr | Mie Sabi')

@section('content')
<div class="container py-5">
    {{-- Kontainer Utama Responsif, menggunakan shadow dan padding Bootstrap --}}
    <section class="mx-auto p-4 p-md-5 shadow-lg rounded-3 bg-light" style="max-width: 450px;">
        
        <h3 class="text-center mb-4 fw-bolder text-uppercase text-dark">Lakukan Pembayaran</h3>
        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body text-center p-3">
                
                
                <div id="qris-container" 
                     class="mx-auto border border-3 border-secondary rounded-3 overflow-hidden d-flex justify-content-center align-items-center bg-white"
                     style="max-width: 280px; height: 280px;">
                    
                    @if(isset($barcode, $barcode->photo))
                        {{-- img-fluid memastikan gambar responsif dan tidak melebihi container --}}
                        <img src="{{ asset('storage/'. $barcode->photo) }}" 
                             alt="QRIS Code" 
                             class="img-fluid w-100 h-100" style="object-fit: contain;">
                    @else
                        <p class="text-muted p-4">QRIS tidak tersedia.</p>
                    @endif
                </div>
            </div>
        </div>

       
        <div class="alert alert-success text-center p-3 mb-4 shadow-sm" role="alert">
            <span class="d-block text-muted fw-bold mb-1 fs-6">Total Pembayaran Anda</span>
            
            <span class="d-block fw-bolder display-5">
                Rp {{ number_format($total, 0, ',', '.') }}
            </span>
        </div>
        
      
        <form enctype="multipart/form-data" action="{{ route('u.scanqr.update', $order_id) }}" method="post" class="mt-4">
            @csrf
            @method("PUT")
            
            <div class="mb-4">
                <label for="orders_receipt" class="form-label fw-bold text-center d-block">
                    Upload Bukti Transfer / Pembayaran
                </label>
                {{-- form-control-lg untuk input yang lebih besar --}}
                <input type="file" id="orders_receipt" name="orders_receipt" class="form-control form-control-lg @error('orders_receipt') is-invalid @enderror" required>
                @error('orders_receipt')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Tombol Submit Interaktif --}}
            {{-- Menggunakan btn-warning (warna kuning Bootstrap) dan menambahkan kelas hover kustom jika diperlukan, atau fokus pada utilitas Bootstrap --}}
            <button type="submit" 
                    class="btn btn-warning btn-lg w-100 mt-3 fw-bold shadow-sm" 
                    id="submit-payment-btn">
                <i class="fas fa-check-circle me-2"></i> Konfirmasi Pembayaran
            </button>
            
        </form>
    </section>
</div>

{{-- Tambahan Style (opsional, hanya untuk sedikit peningkatan visual pada tombol) --}}
<style>
    /* Menggunakan variabel Bootstrap untuk warna tombol warning */
    .btn-warning {
        background-color: var(--bs-warning);
        border-color: var(--bs-warning);
        color: #212529; /* Warna teks gelap */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-warning:hover {
        background-color: #ffc400; /* Sedikit lebih gelap saat hover */
        border-color: #ffc400;
        transform: translateY(-2px); /* Efek sedikit terangkat saat hover */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        color: #212529;
    }
    
    /* Memastikan object-fit tetap dipertahankan */
    .img-fluid[style*="object-fit: contain"] {
        object-fit: contain !important;
    }
</style>
@endsection