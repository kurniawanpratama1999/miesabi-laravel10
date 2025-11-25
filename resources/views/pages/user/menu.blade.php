@extends('layouts.user')

@section('title', 'Menu | Mie Sabi')

@section('section')
    <section class="container-fluid p-5">
        <div class="row">
            @foreach ($dbTableProducts as $product)
                <div id="product-{{ $product->id }}" class="col-6 col-sm-4 col-lg-3 col-xl-2 p-2">
                    <div class="bg-yellow-200">
                        <div id="p-image" style="aspect-ratio: 1/1;" class="p-2 position-relative">
                            @if ($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" style="object-position: center" class="object-fit-cover rounded" width="100%" height="100%">
                            @else
                                <i class="bi bi-fork-knife fs-2 top-50 start-50 translate-middle position-absolute"></i>
                            @endif
                        </div>
                        <div class="p-3">
                            <div class="d-flex flex-column">
                                <span id="p-name" class="text-center fw-bold">{{ $product->name }}</span>
                                <span id="p-category" class="text-center fw-bold d-none">{{ $product->category_name }}</span>
                                <span id="p-price" class="text-center">{{ $product->price }}</span>
                            </div>

                            @if(Auth::check())
                                <div class="d-flex gap-2 justify-content-center mt-3">
                                    <button onclick="handleProductCounter('-', {{ $product->id }})" class="bi bi-dash-circle-fill border-0 bg-transparent p-0 text-red-500 fs-4"></button>
                                    <input id="p-quantity-{{ $product->id }}" type="number" class="form-control form-control-color text-center bg-transparent border-0" value="0" autocomplete="off">
                                    <button onclick="handleProductCounter('+', {{ $product->id }})" class="bi bi-plus-circle-fill border-0 bg-transparent p-0 text-green-500 fs-4"></button>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="link-success text-center d-block mt-3">Beli</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@pushOnce('scripts')
    <script>
        const arrCart = {value: []}

        const changeCartPopup = () => {
            const getCartElement = document.getElementById('cart')
            const countingQuantity = arrCart.value.reduce((a, b) => a + b.quantity, 0)
            if(countingQuantity) {
                // tampilkan
                getCartElement.classList.remove('d-none');
            } else {
                // sembunyikan
                getCartElement.classList.add('d-none');
            }

            getCartElement.querySelector('span').innerHTML = arrCart.value.reduce((a, b) => a + b.quantity, 0)
        }

        function handleProductCounter(operator, id){
            const inputQuantityElement = document.getElementById(`p-quantity-${id}`);
            const findProductByID = arrCart.value.find(v => v.id == id)
            if (operator === "+") {
                if (findProductByID) {
                    findProductByID.quantity += 1;
                    inputQuantityElement.value = findProductByID.quantity
                } else {
                    const productElement = document.getElementById(`product-${id}`)
                    const nameContent = productElement.querySelector('#p-name').textContent
                    const categoryContent = productElement.querySelector('#p-category').textContent
                    const priceContent = productElement.querySelector('#p-price').textContent

                    arrCart.value = [...arrCart.value, {id, variant_id: null, quantity: 1}];
                    const secondfindProductByID = arrCart.value.find(v => v.id == id)

                    inputQuantityElement.value = secondfindProductByID.quantity
                }

            } else if (operator === "-") {
                if (findProductByID && findProductByID.quantity > 0) {
                    findProductByID.quantity -= 1;
                    inputQuantityElement.value = findProductByID.quantity
                }

            }

            changeCartPopup()
        }

        async function goToCart () {
            const countingQuantity = arrCart.value.reduce((a, b) => a + b.quantity, 0);

            if (!countingQuantity) return;

            const HIT_API = await fetch('/u/menu', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ payloadMenuToCart: arrCart.value })
            });

            const res = await HIT_API.json()
            if (res.success) {
                location.href = res.redirect
            }
        }
    </script>
@endPushOnce
