<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - E-Commerce</title>
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
                <div class="hidden md:flex gap-8">
                    <a href="<?= base_path('products') ?>" class="text-slate-900 font-medium">Produk</a>
                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="<?= base_path('dashboard') ?>" class="text-slate-600 hover:text-slate-900 transition">Dashboard</a>
                        <?php if($_SESSION['user']['role'] === 'admin'): ?>
                            <a href="<?= base_path('admin/dashboard') ?>" class="text-slate-600 hover:text-slate-900 transition">Admin</a>
                        <?php endif; ?>
                        <a href="<?= base_path('logout') ?>" class="text-slate-600 hover:text-slate-900 transition">Logout</a>
                    <?php else: ?>
                        <a href="<?= base_path('login') ?>" class="text-slate-600 hover:text-slate-900 transition">Masuk</a>
                        <a href="<?= base_path('register') ?>" class="text-slate-600 hover:text-slate-900 transition">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-slate-900 mb-3">Jelajahi Produk</h1>
            <p class="text-slate-600">Temukan produk berkualitas dengan harga terbaik</p>
        </div>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($products as $product): ?>
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <!-- Product Image -->
                    <div class="w-full h-48 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                        <span class="text-slate-400 text-sm">
                            <?= htmlspecialchars($product['image'] ?? 'No Image') ?>
                        </span>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900 mb-2 line-clamp-2">
                            <?= htmlspecialchars($product['name']) ?>
                        </h3>
                        
                        <div class="mb-3 space-y-1">
                            <p class="text-lg font-bold text-slate-900">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </p>
                            <p class="text-sm text-slate-500">
                                Stok: <span class="font-medium text-slate-900"><?= $product['stock'] ?></span>
                            </p>
                        </div>

                        <a href="<?= base_path('product/detail?id=' . $product['id']) ?>" class="block w-full text-center px-4 py-2 bg-slate-900 text-white font-medium rounded-lg hover:bg-slate-800 transition duration-200">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty State -->
        <?php if(empty($products)): ?>
            <div class="text-center py-16">
                <p class="text-slate-600 text-lg">Produk tidak tersedia</p>
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