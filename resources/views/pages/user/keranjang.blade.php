@extends('layouts.user')

@section('title', 'Keranjang | Mie Sabi')

@section('section')
    <main style="height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="height: calc(100dvh - 3.5rem);" class="col-7 overflow-y-auto row gap-4 p-4 justify-content-evenly">
            @foreach ($arr as $product)
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
                                    <button onclick="handleDecrementVariant(event,{{ $product->id }}, {{ $variant->id }})" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                                    <input id="variant-{{ $product->id }}-{{ $variant->id }}" type="number" style="width: 20px; border: 0; outline-0" class="bg-transparent text-center" value="{{ $variant->qty ?? 0 }}">
                                    <button onclick="handleIncrementVariant(event,{{ $product->id }}, {{ $variant->id }})" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button onclick="handleDecrementProduct(event, {{ $product->id }})"  type="button" style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                        <input id="product-{{ $product->id }}"  type="number" style="width: 70px; border: 0; outline-0" class="bg-transparent text-center" value="{{ $product->qty }}">
                        <button onclick="handleIncrementProduct(event, {{ $product->id }})"  style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        <section style="height: calc(100dvh - 3.5rem);" class="col-5 p-3 overflow-y-auto">
            <span class="d-block text-center fw-bold fs-4">Pilih Metode Pengambilan Pesanan</span>
            <span class="d-block text-center fs-6">Silakan pilih cara yang paling nyaman untuk menerima pesanan anda</span>

            <div class="d-flex justify-content-center gap-5 mt-3">
                @foreach ($delivery_methods as $delivery)
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
    let datas = {{ Js::from($arr) }}
    datas = datas.filter((p) => {
        const productQty = p.qty
        const variantQty = p.variants.reduce((a, b) => a + (b.qty ?? 0) , 0)
        const totalQty = productQty + variantQty
        return totalQty !== 0
    })

    function generateQtyForInput () {
        for(const product of datas) {
            const inputQtyProductElement = document.getElementById('product-' + product.id)

            for (const variant of product.variants) {
                const inputQtyVariantElement = document.getElementById(`variant-${product.id}-${variant.id}`)
                inputQtyVariantElement.value = variant.qty ?? 0
            }

            inputQtyProductElement.value = product.qty
        }
    }

    function handleDecrementProduct (event, id) {
        const inputElement = document.getElementById('product-' + id)
        const inputVal = parseInt(inputElement.value)

        if (inputVal > 0) {
            const findById = datas.find(p => p.id == id)
            if (findById && findById.qty > 0) {
                findById.qty -= 1
                inputElement.value = findById.qty
            }
        }
    }

    function handleIncrementProduct (event, id) {
        const inputElement = document.getElementById('product-' + id)
        const inputVal = parseInt(inputElement.value)

        if (inputVal >= 0) {
            const findById = datas.find(p => p.id == id)
            if (findById && findById.qty >= 0) {
                findById.qty += 1
                inputElement.value = findById.qty
            }
        }
    }

    function handleDecrementVariant(event, productID, variantID){
        const inputElement = document.getElementById(`variant-${productID}-${variantID}`)
        const productIndex = datas.findIndex(p => p.id == productID)
        if (productIndex === -1) return

        const variantIndex = datas[productIndex].variants.findIndex(v => v.id == variantID)
        if (variantIndex === -1) return

        const oldVariant = datas[productIndex].variants[variantIndex]

        const newQty = (oldVariant.qty ?? 0) - 1
        const qty = Math.max(newQty, 0)
        datas[productIndex].variants[variantIndex] = {
            ...oldVariant,
            qty // optional: biar tidak minus
        }
        inputElement.value = qty
    }

    function handleIncrementVariant(event, productID, variantID){
        const inputElement = document.getElementById(`variant-${productID}-${variantID}`)
        const productIndex = datas.findIndex(p => p.id == productID)
        if (productIndex === -1) return

        const variantIndex = datas[productIndex].variants.findIndex(v => v.id == variantID)
        if (variantIndex === -1) return

        const countVariantsQty = datas[productIndex].variants.reduce((a, b) => a + (b.qty ?? 0), 0)

        if (countVariantsQty >= datas[productIndex].qty) return;
        const oldVariant = datas[productIndex].variants[variantIndex]

        const newQty = (oldVariant.qty ?? 0) + 1
        const qty = Math.max(newQty, 0)
        datas[productIndex].variants[variantIndex] = {
            ...oldVariant,
            qty // optional: biar tidak minus
        }

        inputElement.value = qty
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
            let productQty = prod.qty;

            if (!prod.variants || prod.variants.length === 0) {
                result.push({
                    product_id: prod.id,
                    variant_id: null,
                    merge: `${prod.id}-0`,
                    qty: productQty
                });
                return;
            }

            let variantsWithQty = [];
            let totalVariantQty = 0;

            prod.variants.forEach((v, i) => {
                if (v.qty && v.qty > 0) {
                    variantsWithQty.push({
                        product_id: prod.id,
                        variant_id: v.id,
                        merge: `${prod.id}-${v.id}`,
                        qty: v.qty
                    });
                    totalVariantQty += v.qty;
                }
            });

            let remainingQty = productQty - totalVariantQty;

            result.push(...variantsWithQty);

            if (remainingQty > 0) {
                const firstVariant = prod.variants[0];

                result.push({
                    product_id: prod.id,
                    variant_id: firstVariant.id,
                    merge: `${prod.id}-${firstVariant.id}`,
                    qty: remainingQty
                });
            }
        });


        const new_result = Object.values(
            result.reduce((acc, item) => {
                const key = `${item.product_id}-${item.variant_id ?? 0}`;

                if (!acc[key]) {
                    acc[key] = { ...item }; // clone
                } else {
                    acc[key].qty += item.qty; // tambah qty
                }

                return acc;
            }, {})
        );

        return new_result;
    }


    async function checkout () {
        let copyDatas = [...datas];
        let order_details = flattenProducts(copyDatas)
        alert(delivery_id.value)
        let orders = {
            user_id: 1,
            delivery_id: delivery_id.value,
            code: '',
            payment_with: payment_method.value,
            payment_status: 'keranjang',
            order_status: 'menunggu',
            note: document.getElementById('note').value,
            address: document.getElementById('address').value,
            phone: document.getElementById('phone').value
        }

        const sendToCheckOut = {
            orders,
            order_details
        }

        const api = await fetch('/user/keranjang', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            },
            body: JSON.stringify({datas: sendToCheckOut})
        })

        const res = await api.json();
        if (res.success) {
            location.href = '/user/checkout'
        }
    }

    generateQtyForInput()
</script>
@endPushOnce
