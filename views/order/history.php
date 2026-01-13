<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
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
                <div class="flex gap-6">
                    <a href="<?= base_path('products') ?>" class="text-slate-600 hover:text-slate-900 transition">Produk</a>
                    <a href="<?= base_path('dashboard') ?>" class="text-slate-600 hover:text-slate-900 transition">Dashboard</a>
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
                <a href="<?= base_path('products') ?>" class="inline-block px-6 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition">
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
                                    elseif($order['status'] === 'processing') echo 'bg-blue-50 text-blue-700';
                                    elseif($order['status'] === 'completed') echo 'bg-emerald-50 text-emerald-700';
                                    elseif($order['status'] === 'cancelled') echo 'bg-red-50 text-red-700';
                                ?>
                            ">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </div>

                        <div class="py-4 border-t border-b border-slate-200 mb-4">
                            <p class="text-2xl font-bold text-slate-900">
                                Rp <?= number_format($order['total'], 0, ',', '.') ?>
                            </p>
                        </div>

                        <a href="<?= base_path('order/detail?id=' . $order['id']) ?>" class="inline-block px-6 py-2 bg-slate-900 text-white font-medium rounded-lg hover:bg-slate-800 transition">
                            Lihat Detail
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 mt-16 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 E-Commerce-App. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>