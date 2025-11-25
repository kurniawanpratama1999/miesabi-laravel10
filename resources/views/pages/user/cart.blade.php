@extends('layouts.user')

@section('title', 'Cart | Mie Sabi')

@section('section')
    {{-- <main style="height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="height: calc(100dvh - 3.5rem);" class="col-7 overflow-y-auto row gap-4 p-4 justify-content-evenly">
            @foreach ($getProducts as $product)
            <div style="" class="col-4 bg-white p-2 ">
                <div style="aspect-ratio: 1/1;" class="border"></div>
                <div class="p-3">
                    <span class="text-center fw-bold d-block">{{ $product->name }}</span>

                    @if (count($product->variants) > 0)
                    <div class="d-flex flex-column mt-3 gap-3">
                        <span class="text-center">Pilih Varian</span>
                        @foreach ($product->variants as $variant)
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="px-3 py-1 rounded-5 bg-old-brown text-white">{{ $variant->name }}</span>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button onclick="handleVariantCounter(event,{{ $product->id }}, {{ $variant->id }}, '-')" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                                    <input id="variant-{{ $product->id }}-{{ $variant->id }}" type="number" style="width: 20px; border: 0; outline-0" class="bg-transparent text-center" value="{{ $variant->quantity ?? 0 }}">
                                    <button onclick="handleVariantCounter(event,{{ $product->id }}, {{ $variant->id }}, '+')" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button onclick="handleProductCounter(event, {{ $product->id }}, '-')"  type="button" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                        <input id="product-{{ $product->id }}"  type="number" style="width: 70px; border: 0; outline-0" class="bg-transparent text-center" value="{{ $product->quantity }}">
                        <button onclick="handleProductCounter(event, {{ $product->id }}, '+')"  style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        <section style="height: calc(100dvh - 3.5rem);" class="col-5 p-3 overflow-y-auto">
            <span class="d-block text-center fw-bold fs-4">Pilih Metode Pengambilan Pesanan</span>
            <span class="d-block text-center fs-6">Silakan pilih cara yang paling nyaman untuk menerima pesanan anda</span>

            <div class="d-flex justify-content-center gap-5 mt-3">
                @foreach ($getDeliveryMethods as $delivery)
                <div onclick="handleClickDelivery({{ $delivery->id }})">
                    <div style="width: 80px; height: 80px;" class="border mb-2">

                    </div>
                    <span class="d-block text-center">{{ $delivery->name }}</span>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center gap-5 mt-3">
                @foreach ([1, 2] as $payment)
                <div onclick="handleClickPayment('{{ $payment }}')">
                    <div style="width: 80px; height: 40px;" class="border mb-2">

                    </div>
                    <span class="d-block text-center">
                        @switch($payment)
                            @case(1) Tunai @break
                            @case(2) QRIS @break
                        @endswitch
                    </span>
                </div>
                @endforeach
            </div>

            <form class="mt-4 d-flex flex-column gap-4">
                <label for="note" class="d-flex flex-column gap-1 ">
                    <span>Catatan Tambahan</span>
                    <textarea name="note" id="note" style="outline: 0; resize: none;" class="p-2 border-0"></textarea>
                </label>
                <label for="address" class="d-flex flex-column gap-1 ">
                    <span>Alamat Lengkap</span>
                    <textarea name="address" id="address" style="outline: 0; resize: none;" class="p-2 border-0"></textarea>
                </label>
                <label for="phone" class="d-flex flex-column gap-1 ">
                    <span>No. Telp / Whatsapp</span>
                    <input type="text" name="phone" id="phone" style="outline: 0; resize: none;" class="p-2 border-0" maxlength="13">
                </label>

                <button type="button" onclick="checkout()" class="btn bg-old-brown text-white rounded-0">Chekout</button>
            </form>
        </section>-
    </main> --}}

    <div class="container-fluid">
        <div class="row">
            <section style="height: calc(100dvh - 3.5rem)" id="menus" class="col-8 overflow-y-auto p-3">
                <h5>Pesanan Kamu</h5>
                <div class="row">
                    @foreach ($getProducts as $product)
                        <div class="col-6 col-sm-4 col-lg-3 col-xl-2 p-2">
                        <div class="bg-yellow-200">
                            <div id="p-image" style="aspect-ratio: 1/1;" class="border-bottom"></div>
                            <div class="p-3">
                                <div class="d-flex flex-column">
                                    <span id="p-name" class="text-center fw-bold">{{ $product->name }}</span>
                                    <span id="p-category" class="text-center fw-bold d-none">{{ $product->category_name }}</span>
                                    <span id="p-price" class="text-center">{{ $product->price }}</span>
                                </div>


                                @if(Auth::check())
                                <div class="d-flex flex-column align-items-center my-3">
                                    <span class="badge bg-yellow-600">Total Pesanan</span>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button onclick="handleProductCounter(event, {{ $product->id }}, '-')" class="bi bi-dash-circle-fill border-0 bg-transparent p-0 text-red-500 fs-4"></button>
                                        <input id="product-{{ $product->id }}" type="text" class="ini form-control form-control-color text-center bg-transparent border-0 p-0" value="{{ $product->quantity ?? 0 }}" autocomplete="off">
                                        <button onclick="handleProductCounter(event, {{ $product->id }}, '+')" class="bi bi-plus-circle-fill border-0 bg-transparent p-0 text-green-500 fs-4"></button>
                                    </div>
                                </div>
                                @else
                                <a href="{{ route('login') }}" class="link-success text-center d-block mt-3">Beli</a>
                                @endif

                                <div class="d-flex flex-column mt-3">
                                    @foreach ($product->variants as $variant)
                                        <div class="d-flex flex-column align-items-center mb-1 bg-yellow-300 p-2 rounded">
                                            <span class="badge bg-yellow-600">{{ $variant->name }}</span>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button onclick="handleVariantCounter(event,{{ $product->id }}, {{ $variant->id }}, '-')" class="bg-transparent border-0 bi bi-dash-circle-fill text-red-500"></button>
                                                <input id="variant-{{ $product->id }}-{{ $variant->id }}" type="number" class="form-control text-center bg-transparent border-0 w-25 p-0" value="{{ $variant->quantity ?? 0 }}">
                                                <button onclick="handleVariantCounter(event,{{ $product->id }}, {{ $variant->id }}, '+')" class="bg-transparent border-0 bi bi-plus-circle-fill text-green-500"></button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <section id="details" style="height: calc(100dvh - 3.5rem)" class="col-4 overflow-y-auto bg-yellow-300">
                <h5 class="d-block text-center fw-bold fs-4 py-3">Pilih Metode Pengambilan Pesanan</h5>
                <div class="row">
                    <div class="col-6">
                        <h5>Pengantaran</h5>
                        @foreach ($getDeliveryMethods as $delivery)
                        <div id="deliveryChoose-{{ $delivery->id }}" onclick="handleClickDelivery(event, {{ $delivery->id }})" style="cursor: pointer" class="text-center rounded p-3 mb-3 {{ $delivery->id == 1 ? 'bg-yellow-400' : 'bg-yellow-200' }}">
                            @switch($delivery->id)
                                @case(1) <i class="bi bi-shop fs-3"></i> @break
                                @case(2) <i class="bi bi-truck-front fs-3"></i> @break
                            @endswitch
                            <span class="d-block text-center">{{ $delivery->name }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-6">
                        <h5>Pembayaran</h5>
                        @foreach ([1, 2] as $payment)
                        <div id="paymentChoose-{{ $payment }}" onclick="handleClickPayment(event, '{{ $payment }}')" style="cursor: pointer" class="text-center rounded p-3 mb-3 {{ $payment == 1 ? 'bg-yellow-400' : 'bg-yellow-200' }}">
                            @switch($payment)
                                @case(1) <i class="bi bi-cash-coin fs-3"></i> @break
                                @case(2) <i class="bi bi-qr-code-scan fs-3"></i> @break
                            @endswitch
                            <span class="d-block text-center">
                                @switch($payment)
                                    @case(1) Tunai @break
                                    @case(2) QRIS @break
                                @endswitch
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="note" class="form-label text-yellow-900">Note</label>
                        <textarea type="note" class="form-control" id="note" name="note" style="height: 100px"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label text-yellow-900">Address</label>
                        <textarea type="address" class="form-control" id="address" name="address" style="height: 100px"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="phone" class="form-label text-yellow-900">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone">
                    </div>

                    <button type="button" onclick="checkout()" style="width: fit-content" class="bg-yellow-600 border-0 text-white rounded-1 d-block ms-auto px-4 py-1 me-2">Chekout</button>
                </form>
            </section>
        </div>
    </div>
@endsection

@pushOnce('scripts')
<script>
    const delivery_id = {value: 1};
    const payment_method = {value: 1}

    let getProducts = {{ Js::from($getProducts) }}

    getProducts = getProducts.filter((product) => {
        const productQuantity = product.quantity
        const variantQuantity = product.variants.reduce((a, b) => a + (b.quantity ?? 0) , 0)
        const totalQuantity = productQuantity + variantQuantity
        return totalQuantity !== 0
    })

    function generateQuantityForInput () {
        for(const product of getProducts) {
            const inputQuantityProductElement = document.getElementById('product-' + product.id)

            for (const variant of product.variants) {
                const inputQuantityVariantElement = document.getElementById(`variant-${product.id}-${variant.id}`)
                inputQuantityVariantElement.value = variant.quantity ?? 0
            }

            inputQuantityProductElement.value = product.quantity
        }
    }

    function handleProductCounter (event, id, operator) {
        const inputElement = document.getElementById('product-' + id)
        const inputVal = parseInt(inputElement.value)
        const findById = getProducts.find(p => p.id == id)
        if (!findById) return

        if (operator == "+" && findById.quantity >= 0 && inputVal >= 0) {
            findById.quantity += 1
        } else if (operator == "-" && findById.quantity > 0 && inputVal > 0) {
            findById.quantity -= 1
        }

        inputElement.value = findById.quantity
    }

    function handleVariantCounter (event, productID, variantID, operator) {
        const inputElement = document.getElementById(`variant-${productID}-${variantID}`)
        const productIndex = getProducts.findIndex(p => p.id == productID)

        if (productIndex === -1) return

        const variants = getProducts[productIndex].variants

        const variantIndex = getProducts[productIndex].variants.findIndex(v => v.id == variantID)
        if (variantIndex === -1) return

        const oldVariant = variants[variantIndex]

        let newQuantity = oldVariant.quantity ?? 0;
        if(operator === "+") {
            const countVariantsQuantity = variants.reduce((a, b) => a + (b.quantity ?? 0), 0)
            if (countVariantsQuantity >= getProducts[productIndex].quantity) return;

            newQuantity += 1
        } else if (operator === "-") {
            newQuantity -= 1
        }

        const quantity = Math.max(newQuantity, 0)
        variants[variantIndex] = {
            ...oldVariant,
            quantity
        }
        inputElement.value = quantity
    }

    function handleClickDelivery (event, id) {
        delivery_id.value = parseInt(id)
        const deliveriesElement = document.querySelectorAll('div[id^=deliveryChoose-]')
        deliveriesElement.forEach(d => {
            d.classList.remove('bg-yellow-400')
            d.classList.remove('bg-yellow-200')
            const [str, getid] = d.id.split('-')
            if (getid == id) {
                d.classList.add('bg-yellow-400')
            } else {
                d.classList.add('bg-yellow-200')
            }
        })
    }

    function handleClickPayment(event, method) {
        payment_method.value = method
        const paymentElement = document.querySelectorAll('div[id^=paymentChoose-]')
        paymentElement.forEach(d => {
            d.classList.remove('bg-yellow-400')
            d.classList.remove('bg-yellow-200')
            const [str, getid] = d.id.split('-')
            if (getid == method) {
                d.classList.add('bg-yellow-400')
            } else {
                d.classList.add('bg-yellow-200')
            }
        })
    }

    function flattenProducts(products) {
        let result = [];

        products.forEach(prod => {
            let productQuantity = prod.quantity;

            if (!prod.variants || prod.variants.length === 0) {
                result.push({
                    product_id: prod.id,
                    variant_id: null,
                    merge: `${prod.id}-0`,
                    quantity: productQuantity
                });
                return;
            }

            let variantsWithQuantity = [];
            let totalVariantQuantity = 0;

            prod.variants.forEach((v, i) => {
                if (v.quantity && v.quantity > 0) {
                    variantsWithQuantity.push({
                        product_id: prod.id,
                        variant_id: v.id,
                        quantity: v.quantity
                    });
                    totalVariantQuantity += v.quantity;
                }
            });

            let remainingQuantity = productQuantity - totalVariantQuantity;

            result.push(...variantsWithQuantity);

            if (remainingQuantity > 0) {
                const firstVariant = prod.variants[0];

                result.push({
                    product_id: prod.id,
                    variant_id: firstVariant.id,
                    quantity: remainingQuantity
                });
            }
        });


        const new_result = Object.values(
            result.reduce((acc, item) => {
                const key = `${item.product_id}-${item.variant_id ?? 0}`;

                if (!acc[key]) {
                    acc[key] = { ...item }; // clone
                } else {
                    acc[key].quantity += item.quantity; // tambah quantity
                }

                return acc;
            }, {})
        );

        return new_result;
    }


    async function checkout () {
        let copygetProducts = [...getProducts];
        let order_details = flattenProducts(copygetProducts)
        let orders = {
            delivery_id: delivery_id.value,
            payment_with: payment_method.value,
            note: "ABC",
            address: "ABC",
            phone: "ABC"
        }

        const arrCheckout = {
            orders,
            order_details
        }

        const HIT_API = await fetch('/u/cart', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            },

            body: JSON.stringify({payloadCartToCheckout: arrCheckout})
        })

        const res = await HIT_API.json();
        if (res.success) {
            location.href = res.redirect
        }
    }

    generateQuantityForInput()
</script>
@endPushOnce
