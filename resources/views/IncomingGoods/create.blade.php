@extends('layout.app')
@section('content')
    <x-breadcrumb :items="[['label' => 'Tambah Data', 'url' => '#']]" />

    <div class="bg-white rounded-lg shadow-md p-6 w-full overflow-hidden">
        <form id="incomingGoodsForm">
            <div class="mb-8">
                <h3 class="text-lg font-medium mb-4 border-b pb-2">INFORMASI UMUM</h3>
                <div class="flex flex-col md:flex-row md:flex-wrap gap-4">
                    <div class="w-full">
                        <div class="form-group w-full md:w-1/4">
                            <label for="operator_id" class="block text-sm font-semibold text-gray-700 mb-2">Operator</label>
                            <div class="relative">
                                <select name="operator_id" id="operator_id"
                                    class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    @if (auth()->user()->hasRole('operator')) disabled @endif>
                                    <option value="">Pilih Operator</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('operator_id') == $item->id || (auth()->user()->hasRole('operator') && auth()->id() == $item->id)) selected @endif>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (auth()->user()->hasRole('operator'))
                                    <input type="hidden" name="operator_id" value="{{ auth()->id() }}">
                                @endif
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M7 7l3-3 3 3H7zm0 6l3 3 3-3H7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="form-group w-full md:w-1/4">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <div class="relative">
                                <select name="category_id" id="category_id"
                                    class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" data-limit="{{ $item->price_limit ?? '0' }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name_category }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M7 7l3-3 3 3H7zm0 6l3 3 3-3H7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex flex-col md:flex-wrap md:flex-row gap-4">
                        <div class="form-group w-full md:w-1/4">
                            <label for="subcategory_id" class="block text-sm font-semibold text-gray-700 mb-2">Sub
                                Kategori</label>
                            <div class="relative">
                                <select name="subcategory_id" id="subcategory_id"
                                    class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Sub Kategori</option>
                                    @if (old('category_id'))
                                        @foreach ($subcategories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('subcategory_id') == $item->id ? 'selected' : '' }}>
                                                {{ $item->sub_category_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-600">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M7 7l3-3 3 3H7zm0 6l3 3 3-3H7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="form-group w-full md:w-1/4">
                            <label for="price_limit" class="block text-gray-700 mb-2">Batas Harga</label>
                            <input type="text" id="price_limit" name="price_limit"
                                class="w-full px-4 py-2 border rounded-lg" disabled value="{{ old('price_range', '0') }}">
                        </div>
                    </div>

                    <div class="w-full md:w-1/2">
                        <label class="block text-gray-700 mb-2">Asal Barang</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-lg">
                    </div>
                    <div class="w-full flex flex-col md:flex-wrap md:flex-row gap-4">
                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Nomor Surat</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div class="form-group w-full md:w-1/4">
                            <label class="block text-gray-700 mb-2">Lampiran</label>
                            <div class="border rounded-lg p-2">
                                <input type="file" id="attachment" class="hidden">
                                <label for="attachment" class="cursor-pointer">
                                    <div class="flex items-center">
                                        <span class="bg-gray-100 px-3  rounded-l border-r">Choose File</span>
                                        <span class="px-3 text-gray-500">No file chosen</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8 mt-5">
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <h3 class="text-lg font-medium">INFORMASI BARANG</h3>
                        <button type="button" id="addItemButton"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                            + Tambah Barang
                        </button>
                    </div>

                    <div id="itemRows" class="space-y-4">
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Nama Barang</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded">
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Harga (Rp.)</label>
                                    <div class="flex items-center flex-col">
                                        <input type="text" class="w-full px-3 py-2 border rounded price-input">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Jumlah</label>
                                    <input type="number" class="w-full px-3 py-2 border rounded quantity-input">
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Satuan</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded ">
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Total</label>
                                    <div class="flex items-center">
                                        <span class="mr-1">Rp.</span>
                                        <input type="text" class="w-full px-3 py-2 border rounded total-input"
                                            readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="block text-gray-700 mb-2 text-sm">Tgl. Expired</label>
                                    <input type="date" class="w-full px-3 py-2 border rounded">
                                </div>
                            </div>
                            <div class="mt-3 flex justify-end">
                                <button type="button" class="text-red-500 hover:text-red-700 remove-item">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex justify-start space-x-4">
                    <a href="/incoming-goods"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let isPriceExceeded = false;

            function addNewItem() {
                const newItem = `
            <div class="border rounded-lg p-4 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                    <div class="form-group">
                        <label class="block text-gray-700 mb-2 text-sm">Nama Barang</label>
                        <input type="text" class="w-full px-3 py-2 border rounded">
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 mb-2 text-sm">Harga (Rp.)</label>
                        <div class="flex items-center flex-col">
                            <input type="text" class="w-full px-3 py-2 border rounded price-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 mb-2 text-sm">Jumlah</label>
                        <input type="number" class="w-full px-3 py-2 border rounded quantity-input">
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 mb-2 text-sm">Satuan</label>
                        <select class="w-full px-3 py-2 border rounded">
                            <option value="Buah">Buah</option>
                            <option value="Lusin">Lusin</option>
                            <option value="Box">Box</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 mb-2 text-sm">Total</label>
                        <div class="flex items-center">
                            <span class="mr-1">Rp.</span>
                            <input type="text" class="w-full px-3 py-2 border rounded total-input" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-700 mb-2 text-sm">Tgl. Expired</label>
                        <input type="date" class="w-full px-3 py-2 border rounded">
                    </div>
                </div>
                <div class="mt-3 flex justify-end">
                    <button type="button" class="text-red-500 hover:text-red-700 remove-item">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        `;
                document.getElementById('itemRows').insertAdjacentHTML('beforeend', newItem);
                validatePriceLimit();
            }

            function validatePriceLimit() {
                console.log("Running price validation...");
                const existingError = document.getElementById('price-error');
                if (existingError) {
                    existingError.remove();
                }
                let priceLimit = document.getElementById('price_limit').value;
                priceLimit = parseCurrency(priceLimit);
                let totalPrice = 0;
                const totalInputs = document.querySelectorAll('.total-input');
                totalInputs.forEach(input => {
                    let itemTotal = parseCurrency(input.value);
                    totalPrice += itemTotal;
                });
                console.log("Total price of all items:", totalPrice);
                const priceInputs = document.querySelectorAll('.price-input');
                priceInputs.forEach(input => {
                    const itemPrice = parseCurrency(input.value);
                    const parentCard = input.closest('.border.rounded-lg');
                    if (itemPrice > priceLimit && priceLimit > 0) {
                        input.classList.add('border-red-500', 'bg-red-50');
                        if (!parentCard.querySelector('.price-error-message')) {
                            const errorMessage = document.createElement('div');
                            errorMessage.className = 'price-error-message text-red-500 text-xs mt-1';
                            errorMessage.textContent =
                                `Harga melebihi batas (Rp. ${formatCurrency(priceLimit)})`;
                            input.parentElement.appendChild(errorMessage);
                        }
                    } else {
                        input.classList.remove('border-red-500', 'bg-red-50');
                        const existingError = parentCard.querySelector('.price-error-message');
                        if (existingError) {
                            existingError.remove();
                        }
                    }
                });

                if (priceLimit > 0 && totalPrice > priceLimit) {
                    console.log("Price limit exceeded!");

                    const errorMessage = `
                <div id="price-error" class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <p>Peringatan: Total harga (Rp. ${formatCurrency(totalPrice)}) melebihi batas harga dari Sub Kategori yang dipilih (Rp. ${formatCurrency(priceLimit)})</p>
                </div>
            `;
                    const itemRowsElement = document.getElementById('itemRows');
                    itemRowsElement.insertAdjacentHTML('afterend', errorMessage);
                    isPriceExceeded = true;
                } else {
                    isPriceExceeded = false;
                }
                const submitButton = document.querySelector('button[type="submit"]');
                submitButton.disabled = isPriceExceeded;
                if (isPriceExceeded) {
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }

            function parseCurrency(value) {
                if (!value) return 0;
                const numericString = value.toString().replace(/[^0-9]/g, '');
                return parseFloat(numericString) || 0;
            }

            function formatCurrency(value) {
                return new Intl.NumberFormat('id-ID').format(value);
            }
            document.getElementById('addItemButton').addEventListener('click', addNewItem);
            document.getElementById('itemRows').addEventListener('click', function(e) {
                if (e.target.closest('.remove-item')) {
                    const items = document.querySelectorAll('#itemRows > div');
                    if (items.length > 1) {
                        e.target.closest('.border.rounded-lg').remove();
                        validatePriceLimit();
                    } else {
                        swal.fire({
                            text: 'Anda tidak dapat menghapus item terakhir.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        })
                    }
                }
            });

            document.getElementById('itemRows').addEventListener('input', function(e) {
                if (e.target.classList.contains('price-input') || e.target.classList.contains(
                        'quantity-input')) {
                    const card = e.target.closest('.border.rounded-lg');
                    const priceInput = card.querySelector('.price-input');
                    const quantityInput = card.querySelector('.quantity-input');
                    const totalInput = card.querySelector('.total-input');
                    const price = parseFloat(priceInput.value.replace(/[^0-9.-]+/g, '')) || 0;
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const total = price * quantity;
                    totalInput.value = formatCurrency(total);
                    console.log(`Price: ${price}, Quantity: ${quantity}, Total: ${total}`);
                    validatePriceLimit();
                }
            });
            document.getElementById('incomingGoodsForm').addEventListener('submit', function(e) {
                validatePriceLimit();
                if (isPriceExceeded) {
                    e.preventDefault();
                    alert(
                        'Total harga melebihi batas harga dari Sub Kategori yang dipilih. Silakan periksa kembali.'
                    );
                }
            });
            $(document).ready(function() {
                $('#category_id').off('change').on('change', function() {
                    var categoryId = $(this).val();
                    var priceLimit = $(this).find('option:selected').data('limit');
                    $('#price_limit').val(formatCurrency(priceLimit) || '0');
                    $('#subcategory_id').html('<option value="">Pilih Sub Kategori</option>');

                    if (!categoryId) return;

                    $.get(window.location.origin + '/get-subcategories', {
                        category_id: categoryId
                    }, function(data) {
                        console.log("Data Sub Kategori:", data);

                        var options = '<option value="">Pilih Sub Kategori</option>';
                        $.each(data, function(index, subcategory) {
                            options += '<option value="' + subcategory.id +
                                '" data-price="' +
                                subcategory.price_range + '">' +
                                subcategory.sub_category_name + '</option>';
                        });
                        $('#subcategory_id').html(options);
                        validatePriceLimit();
                    });
                });

                $('#subcategory_id').off('change').on('change', function() {
                    var selectedOption = $(this).find('option:selected');
                    var priceRange = selectedOption.data('price') || 0;

                    console.log("Price Range Selected:", priceRange);
                    $('#price_limit').val(formatCurrency(priceRange));
                    validatePriceLimit();
                });
                validatePriceLimit();
            });
        });
    </script>
@endsection
