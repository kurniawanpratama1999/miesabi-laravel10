@extends('layouts.user')

@section('title', 'Menu | Mie Sabi')

@section('section')
    <section class="container-fluid p-5">
        <div class="row">
            @foreach ($dbTableProducts as $product)
                <div id="product-{{ $product->id }}" class="col-6 col-sm-4 col-lg-3 col-xl-2 p-2">
                    <div class="bg-yellow-200">
                        <div id="p-image" style="aspect-ratio: 1/1;" class="border-bottom"></div>
                        <div class="p-3">
                            <div class="d-flex flex-column">
                                <span id="p-name" class="text-center fw-bold">{{ $product->name }}</span>
                                <span id="p-category" class="text-center fw-bold d-none">{{ $product->category_name }}</span>
                                <span id="p-price" class="text-center">{{ $product->price }}</span>
                            </div>
    
                            @if(Auth::check())
                                <div class="d-flex gap-2 justify-content-center mt-3">
                                    <button onclick="handleProductCounter('-', {{ $product->id }})" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0 bg-red-400">-</button>
                                    <input id="p-quantity-{{ $product->id }}" type="number" style="width: 70px; border: 0; outline-0" class="bg-transparent text-center" value="0" autocomplete="off">
                                    <button onclick="handleProductCounter('+', {{ $product->id }})" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0 bg-green-400">+</button>
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
