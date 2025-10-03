<x-app-layout>
    {{-- 🔹 Shipping Banner --}}
    <div class="bg-gradient-to-r from-rose-100 to-pink-100 border-b border-rose-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center text-sm py-2 text-rose-900 font-medium">
                Shipping done all across the country!
            </div>
        </div>
    </div>

    <x-navbar />

    {{-- 🔹 Checkout Page --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10 grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-8">
        
        {{-- Checkout Form --}}
        <form action="{{ route('checkout.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border p-6 space-y-6 w-full">
            @csrf

            <h2 class="text-xl font-semibold text-gray-800">Checkout</h2>

            {{-- Personal Info --}}
            <div>
                <h3 class="font-medium text-gray-700 mb-3">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <input type="text" name="name" placeholder="Full Name" required
                           value="{{ old('name', Auth::user()->name ?? '') }}"
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="email" name="email" placeholder="Email Address" required
                           value="{{ old('email', Auth::user()->email ?? '') }}"
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="phone" placeholder="Phone Number" required
                           value="{{ old('phone', Auth::user()->phone ?? '') }}"
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                </div>
            </div>

            {{-- Shipping Address --}}
            <div>
                <h3 class="font-medium text-gray-700 mb-3">Shipping Address</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="shipping_address" placeholder="Address" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="shipping_city" placeholder="City" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="shipping_district" placeholder="District" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="shipping_postal" placeholder="Postal Code" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                </div>
            </div>

            {{-- Payment Method --}}
            <div>
                <h3 class="font-medium text-gray-700 mb-3">Payment Method</h3>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="payment_method" value="cod" checked class="text-rose-600 payment-radio">
                        Cash on Delivery
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="radio" name="payment_method" value="card" class="text-rose-600 payment-radio">
                        Card Payment
                    </label>
                </div>

                {{-- Card Type Selection (Hidden unless "Card Payment" is selected) --}}
                <div id="cardOptions" class="mt-4 hidden">
                    <h4 class="font-medium text-gray-700 mb-2">Select Card Type</h4>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="radio" name="card_type" value="visa" class="text-rose-600"> Visa
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="radio" name="card_type" value="mastercard" class="text-rose-600"> MasterCard
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="radio" name="card_type" value="amex" class="text-rose-600"> American Express
                        </label>
                    </div>
                </div>
            </div>

            {{-- Billing Address --}}
            <div>
                <h3 class="font-medium text-gray-700 mb-3">Billing Address</h3>
                <label class="flex items-center gap-2 text-sm text-gray-700 mb-3">
                    <input type="checkbox" id="sameAsShipping">
                    Same as Shipping Address
                </label>

                <div id="billingFields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="billing_address" placeholder="Address" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="billing_city" placeholder="City" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="billing_district" placeholder="District" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                    <input type="text" name="billing_postal" placeholder="Postal Code" required
                           class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500">
                </div>
            </div>

            {{-- Additional Notes --}}
            <div>
                <h3 class="font-medium text-gray-700 mb-3">Additional Requirements</h3>
                <textarea name="notes" rows="3" placeholder="Anything else you want to tell us?"
                          class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500"></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-rose-600 text-white rounded-lg hover:bg-rose-700">
                Place Order
            </button>
        </form>

        {{-- Order Summary --}}
        <div class="bg-white rounded-xl shadow-sm border p-6 h-fit">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Order Summary</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-800">Rs. {{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping</span>
                    <span class="text-gray-800">Rs. {{ number_format($shipping, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tax</span>
                    <span class="text-gray-800">Rs. {{ number_format($tax, 2) }}</span>
                </div>
                <hr>
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span class="text-gray-900">Rs. {{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-footer />

<script>
    // Copy shipping
    document.getElementById('sameAsShipping').addEventListener('change', function() {
        let billingFields = document.getElementById('billingFields').querySelectorAll('input');
        let shippingFields = {
            address: document.querySelector('[name="shipping_address"]').value,
            city: document.querySelector('[name="shipping_city"]').value,
            district: document.querySelector('[name="shipping_district"]').value,
            postal: document.querySelector('[name="shipping_postal"]').value,
        };

        if (this.checked) {
            billingFields[0].value = shippingFields.address;
            billingFields[1].value = shippingFields.city;
            billingFields[2].value = shippingFields.district;
            billingFields[3].value = shippingFields.postal;
        } else {
            billingFields.forEach(input => input.value = '');
        }
    });

    document.querySelectorAll('.payment-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            let cardOptions = document.getElementById('cardOptions');
            if (this.value === 'card') {
                cardOptions.classList.remove('hidden');
            } else {
                cardOptions.classList.add('hidden');
            }
        });
    });
</script>
