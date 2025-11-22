@extends('layouts.user')

@section('title', 'Keranjang | Mie Sabi')

@section('section')
    <main style="height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
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
                @foreach (['qris', 'tunai'] as $payment)
                <div onclick="handleClickPayment('{{ $payment }}')">
                    <div style="width: 80px; height: 40px;" class="border mb-2">

                    </div>
                    <span class="d-block text-center">{{ $payment }}</span>
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
    </main>
@endsection

@pushOnce('scripts')
<script>
    const delivery_id = {value: 1};
    const payment_method = {value: 'qris'}

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
        const findById = getProducts.find(p => product.id == id)

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
        const productIndex = getProducts.findIndex(p => product.id == productID)
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

    function handleClickDelivery (id) {
        delivery_id.value = id
    }

    function handleClickPayment(method) {
        payment_method.value = method
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
                        merge: `${prod.id}-${v.id}`,
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
                    merge: `${prod.id}-${firstVariant.id}`,
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
            user_id: 2,
            delivery_id: delivery_id.value,
            code: '',
            payment_with: payment_method.value,
            payment_status: '',
            order_status: '',
            note: "ABC",
            address: "ABC",
            phone: "ABC"
        }

        const arrCheckout = {
            orders,
            order_details
        }

        const HIT_API = await fetch('/keranjang', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            },

            body: JSON.stringify({payloadKeranjangToCheckout: arrCheckout})
        })

        const res = await HIT_API.json();
        if (res.success) {
            location.href = res.redirect
        }
    }

    generateQuantityForInput()
</script>
@endPushOnce
