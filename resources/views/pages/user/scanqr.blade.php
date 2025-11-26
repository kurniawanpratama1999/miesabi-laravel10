@extends('layouts.user')

@section('title', 'ScanQr | Mie Sabi')

@section('section')
        <section style="max-width: 450px;background-color: rgb(255, 255, 255,0.2);" class="mx-auto py-4">
            <h3 class="text-center mb-3">QR SCAN</h3>
            <div style="max-width: 300px; min-width: 300px; max-height: 300px; min-height: 300px;" class="border mx-auto">
                <img src="{{ $barcode->photo }}" alt="">
            </div>


            <div class="mt-4 d-flex flex-column align-items-center">
                <span class="fw-bold fs-4">Total Pembayaran</span>
                <span class="fw-bold fs-4">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form enctype="multipart/form-data" action="{{ route('u.scanqr.update', $order_id) }}" method="post" class="py-2 px-4 mt-3">
                @csrf
                @method("PUT")
                <div class="col-12">
                    <label for="orders_receipt" class="text-center d-block">Upload Bukti Pembayaran</label>
                    <input type="file" id="orders_receipt" name="orders_receipt" class="form-control">
                </div>
                <button type="submit" class="bg-yellow-500 px-4 py-2 rounded border-0 mx-auto d-block mt-5">Sudah Bayar</button>
            </form>
        </section>
@endsection

@pushOnce('scripts')
    <script>

    </script>
@endPushOnce
