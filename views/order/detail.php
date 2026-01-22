<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #<?= $order['id'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-800">
    <!-- Navigation Header -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?= base_path('') ?>" class="flex items-center gap-2">
                    <img src="<?= base_path('images/logo.png') ?>" alt="Logo" class="h-8 w-8">
                    <span class="text-xl font-bold text-emerald-800">E-Commerce-App</span>
                </a>
                <a href="<?= base_path('order/history') ?>" class="text-emerald-800 hover:text-emerald-900 transition">← Kembali</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-emerald-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900">Pesanan #<?= $order['id'] ?></h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Order Info -->
            <div class="md:col-span-2 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                    <h3 class="text-lg font-semibold text-slate-900 mb-6">Informasi Pesanan</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-slate-600">Tanggal Pesanan</p>
                            <p class="font-medium text-slate-900"><?= date('d F Y, H:i', strtotime($order['created_at'])) ?></p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-600">Status Pesanan</p>
                            <p class="mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                    <?php 
                                        if($order['status'] === 'pending') echo 'bg-yellow-50 text-yellow-700';
                                        elseif($order['status'] === 'processing') echo 'bg-emerald-50 text-emerald-700';
                                        elseif($order['status'] === 'completed') echo 'bg-emerald-100 text-emerald-800';
                                        elseif($order['status'] === 'cancelled') echo 'bg-red-50 text-red-700';
                                    ?>
                                ">
                                    <?= ucfirst($order['status']) ?>
                                </span>
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-600">Status Pembayaran</p>
                            <p class="mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                    <?php 
                                        if($payment['status'] === 'pending') echo 'bg-yellow-50 text-yellow-700';
                                        elseif($payment['status'] === 'verified') echo 'bg-emerald-50 text-emerald-700';
                                        elseif($payment['status'] === 'failed') echo 'bg-red-50 text-red-700';
                                    ?>
                                ">
                                    <?= ucfirst($payment['status']) ?>
                                </span>
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-600">Metode Pembayaran</p>
                            <p class="font-medium text-slate-900"><?= ucfirst($payment['payment_method']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Payment Status Alert -->
                <?php if($payment['status'] === 'pending'): ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <h3 class="font-semibold text-yellow-900 mb-4">⏳ Menunggu Pembayaran</h3>
                        
                        <?php if($payment['payment_method'] === 'transfer'): ?>
                            <div class="space-y-3 text-yellow-900">
                                <p><strong>Silakan transfer ke rekening berikut:</strong></p>
                                <div class="bg-white rounded p-4">
                                    <p class="text-sm text-slate-600">Bank</p>
                                    <p class="font-semibold text-lg">BCA 1234567890</p>
                                    <p class="text-sm text-slate-600 mt-2">a.n. Toko Online</p>
                                    <p class="text-sm text-slate-600 mt-4">Nominal Transfer</p>
                                    <p class="font-semibold text-lg text-emerald-800">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                        <?php elseif($payment['payment_method'] === 'cod'): ?>
                            <p class="text-yellow-900">Pesanan akan dikirim. Silakan bayar saat barang diterima.</p>
                        <?php elseif($payment['payment_method'] === 'ewallet'): ?>
                            <p class="text-yellow-900">Scan QRIS atau transfer ke nomor e-wallet: <strong>08123456789</strong></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Produk Pesanan</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-emerald-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Produk</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Harga</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($items as $item): ?>
                                    <tr class="border-b border-slate-200 hover:bg-emerald-50">
                                        <td class="px-6 py-4 font-medium text-slate-900"><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td class="px-6 py-4 text-slate-900">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td class="px-6 py-4 text-slate-900"><?= $item['quantity'] ?></td>
                                        <td class="px-6 py-4 font-semibold text-emerald-800">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 sticky top-32">
                    <h3 class="text-lg font-semibold text-slate-900 mb-6">Ringkasan</h3>

                    <div class="space-y-4 pb-6 border-b border-slate-200">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal:</span>
                            <span class="font-medium">Rp <?= number_format($order['total'], 0, ',', '.') ?></span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Ongkir:</span>
                            <span class="font-medium">Rp 0</span>
                        </div>
                    </div>

                    <div class="pt-6">
                        <div class="text-sm text-slate-600 mb-1">Total Pembayaran</div>
                        <div class="text-3xl font-bold text-emerald-800">Rp <?= number_format($order['total'], 0, ',', '.') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-slate-200 py-10 mt-16">
        <div class="max-w-7xl mx-auto px-6 text-sm text-slate-600 text-center">
            © 2026 E-Commerce-App. All rights reserved.
        </div>
    </footer>
</body>
</html>