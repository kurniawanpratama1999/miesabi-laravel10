@extends('layouts.user')

@section('title', 'Menu | Mie Sabi')

@section('section')
<main class="bg-young-brown">
    <section class="p-4 row gap-4 justify-content-evenly container-fluid">
        <span class="fw-bold fs-3 text-old-brown">Daftar Menu</span>
        <div class="row gap-3 justify-content-evenly">
            @foreach ($datas as $product)
                <div style="" class="col-2 bg-white p-2">
                    <div style="aspect-ratio: 1/1;" class="border"></div>
                    <div class="p-3">
                        <div class="d-flex flex-column">
                            <span class="text-center fw-bold">{{ $product->name }}</span>
                            <span class="text-center">{{ $product->price }}</span>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button onclick="handleDecrement({{ $product->id }})" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                            <input id="qty-{{ $product->id }}" type="number" style="width: 70px; border: 0; outline-0" class="bg-transparent text-center" value="0">
                            <button onclick="handleIncrement({{ $product->id }})" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
</main>
@endsection

@pushOnce('scripts')
    <script>
        const cart = {value: []}

        const changeKeranjangPopup = (isActive = false) => {
            const keranjangElement = document.getElementById('keranjang')

            if(isActive) {
                keranjangElement.classList.remove('d-none');
            } else {
                keranjangElement.classList.add('d-none');
            }

            keranjangElement.querySelector('span').innerHTML = cart.value.reduce((a, b) => a + b.qty, 0)

        }

        function handleIncrement(id){
            const inputQtyElement = document.getElementById(`qty-${id}`);
            inputQtyElement.value = parseInt(inputQtyElement.value) + 1
            const findById = cart.value.find(v => v.id == id)
            if (findById) {
                findById.qty += 1
            } else {
                cart.value.push({id, variant_id: null, qty: 1})
            }

            changeKeranjangPopup(true)

            console.log(cart)
        }

        function handleDecrement(id){
            const inputQtyElement = document.getElementById(`qty-${id}`);

            if (inputQtyElement.value > 0) {
                inputQtyElement.value = parseInt(inputQtyElement.value) - 1

                const findById = cart.value.find(v => v.id == id)
                if (findById && findById.qty > 0) {
                    findById.qty -= 1
                } else {
                    cart.value.push({id, variant_id: null, qty: 1})
                }
            }

            const calcQty = cart.value.reduce((a, b) => a + b.qty, 0);
            if (calcQty <= 0) {
                changeKeranjangPopup(false)
            } else {
                changeKeranjangPopup(true)
            }
        }

        async function goToKeranjang () {
            const calcQty = cart.value.reduce((a, b) => a + b.qty, 0);

            if (calcQty <= 0) return;

            const api = await fetch('/user/keranjang', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ datas: cart.value })
            });

            const res = await api.json()

            if (res.success) {
                location.href = '/user/keranjang'
            }
        }
    </script>
@endPushOnce
