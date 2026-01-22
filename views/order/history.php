<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
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
                <div class="flex gap-6 text-sm font-medium">
                    <a href="<?= base_path('products') ?>" class="hover:text-emerald-800">Produk</a>
                    <a href="<?= base_path('dashboard') ?>" class="hover:text-emerald-800">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900">Riwayat Pesanan</h1>
            <p class="text-slate-600 mt-2">Lihat status semua pesanan Anda</p>
        </div>

        <?php if(empty($orders)): ?>
            <div class="bg-white rounded-lg border border-slate-200 p-16 text-center">
                <p class="text-slate-600 text-xl mb-6">Belum ada pesanan</p>
                <a href="<?= base_path('products') ?>" class="inline-block px-6 py-3 bg-emerald-800 text-white font-semibold rounded-lg hover:bg-emerald-900 transition">
                    Mulai Belanja
                </a>
            </div>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach($orders as $order): ?>
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-1">
                                    Pesanan #<?= $order['id'] ?>
                                </h3>
                                <p class="text-sm text-slate-600">
                                    <?= date('d F Y, H:i', strtotime($order['created_at'])) ?>
                                </p>
                            </div>
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
                        </div>

                        <div class="py-4 border-t border-b border-slate-200 mb-4">
                            <p class="text-2xl font-bold text-emerald-800">
                                Rp <?= number_format($order['total'], 0, ',', '.') ?>
                            </p>
                        </div>

                        <a href="<?= base_path('order/detail?id=' . $order['id']) ?>" class="inline-block px-6 py-2 bg-emerald-800 text-white font-medium rounded-lg hover:bg-emerald-900 transition">
                            Lihat Detail
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="border-t border-slate-200 py-10 mt-16">
        <div class="max-w-7xl mx-auto px-6 text-sm text-slate-600 text-center">
            © 2026 E-Commerce-App. All rights reserved.
        </div>
    </footer>
</body>
</html>