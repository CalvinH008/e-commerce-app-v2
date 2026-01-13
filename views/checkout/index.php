<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Konfirmasi Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <!-- Navigation Header -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?= base_path('') ?>" class="text-xl font-semibold text-slate-900">
                    E-Commerce-App
                </a>
                <a href="<?= base_path('cart') ?>" class="text-slate-600 hover:text-slate-900 transition">← Kembali</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900">Konfirmasi Pesanan</h1>
            <p class="text-slate-600 mt-2">Review dan pilih metode pembayaran</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Detail Pesanan</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Produk</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Harga</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cart as $item): ?>
                                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                                        <td class="px-6 py-4 font-medium text-slate-900"><?= htmlspecialchars($item['name']) ?></td>
                                        <td class="px-6 py-4 text-slate-900">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td class="px-6 py-4 text-slate-900"><?= $item['quantity'] ?></td>
                                        <td class="px-6 py-4 font-semibold text-slate-900">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <form method="POST" action="<?= base_path('checkout/process') ?>" class="space-y-6">
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-6">Pilih Metode Pembayaran</h3>

                        <div class="space-y-4">
                            <!-- Transfer Bank -->
                            <label class="flex items-start p-4 border-2 border-slate-300 rounded-lg cursor-pointer hover:border-slate-400 hover:bg-slate-50 transition">
                                <input 
                                    type="radio" 
                                    name="payment_method" 
                                    value="transfer" 
                                    id="transfer" 
                                    checked
                                    class="mt-1 mr-4"
                                >
                                <div class="flex-1">
                                    <div class="font-semibold text-slate-900">Transfer Bank</div>
                                    <div class="text-sm text-slate-600">Transfer ke rekening BCA 1234567890 a.n. Toko Online</div>
                                </div>
                            </label>

                            <!-- COD -->
                            <label class="flex items-start p-4 border-2 border-slate-300 rounded-lg cursor-pointer hover:border-slate-400 hover:bg-slate-50 transition">
                                <input 
                                    type="radio" 
                                    name="payment_method" 
                                    value="cod" 
                                    id="cod"
                                    class="mt-1 mr-4"
                                >
                                <div class="flex-1">
                                    <div class="font-semibold text-slate-900">COD (Cash on Delivery)</div>
                                    <div class="text-sm text-slate-600">Bayar saat barang diterima</div>
                                </div>
                            </label>

                            <!-- E-Wallet -->
                            <label class="flex items-start p-4 border-2 border-slate-300 rounded-lg cursor-pointer hover:border-slate-400 hover:bg-slate-50 transition">
                                <input 
                                    type="radio" 
                                    name="payment_method" 
                                    value="ewallet" 
                                    id="ewallet"
                                    class="mt-1 mr-4"
                                >
                                <div class="flex-1">
                                    <div class="font-semibold text-slate-900">E-Wallet</div>
                                    <div class="text-sm text-slate-600">Gopay, OVO, Dana, ShopeePay</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a 
                            href="<?= base_path('cart') ?>" 
                            class="flex-1 text-center px-6 py-3 border-2 border-slate-300 text-slate-900 font-semibold rounded-lg hover:bg-slate-50 transition"
                        >
                            Kembali ke Keranjang
                        </a>
                        <button 
                            type="submit" 
                            onclick="return confirm('Konfirmasi pesanan Anda?')"
                            class="flex-1 px-6 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition"
                        >
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 sticky top-32">
                    <h3 class="text-lg font-semibold text-slate-900 mb-6">Ringkasan Pesanan</h3>

                    <div class="space-y-4 pb-6 border-b border-slate-200">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal:</span>
                            <span class="font-medium">Rp <?= number_format($total, 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Ongkir:</span>
                            <span class="font-medium">Rp 0</span>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="text-sm text-slate-600 mb-1">Total Bayar</div>
                        <div class="text-3xl font-bold text-slate-900">Rp <?= number_format($total, 0, ',', '.') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 E-Commerce-App. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>
            </div>

            <div class="actions">
                <a href="/e-commerce-app/public/cart" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Konfirmasi pesanan Anda?')">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</body>
</html>