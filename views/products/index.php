<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - E-Commerce</title>
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
                <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="<?= base_path('products') ?>" class="text-emerald-800 font-semibold">Produk</a>
                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="<?= base_path('cart') ?>" class="hover:text-emerald-800">Keranjang</a>
                        <a href="<?= base_path('dashboard') ?>" class="hover:text-emerald-800">Dashboard</a>
                        <?php if($_SESSION['user']['role'] === 'admin'): ?>
                            <a href="<?= base_path('admin/dashboard') ?>" class="hover:text-emerald-800">Admin</a>
                        <?php endif; ?>
                        <a href="<?= base_path('logout') ?>" class="px-4 py-2 rounded-md hover:bg-emerald-50 text-emerald-800">Logout</a>
                    <?php else: ?>
                        <a href="<?= base_path('login') ?>" class="hover:text-emerald-800">Masuk</a>
                        <a href="<?= base_path('register') ?>" class="px-5 py-2 bg-emerald-800 text-white rounded-md hover:bg-emerald-900">Daftar</a>
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
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-emerald-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($products as $product): ?>
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <!-- Product Image -->
                    <div class="w-full h-48 bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center">
                        <span class="text-emerald-600 text-sm">
                            <?= htmlspecialchars($product['image'] ?? 'No Image') ?>
                        </span>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900 mb-2 line-clamp-2">
                            <?= htmlspecialchars($product['name']) ?>
                        </h3>
                        
                        <div class="mb-3 space-y-1">
                            <p class="text-lg font-bold text-emerald-800">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </p>
                            <p class="text-sm text-slate-500">
                                Stok: <span class="font-medium text-slate-900"><?= $product['stock'] ?></span>
                            </p>
                        </div>

                        <a href="<?= base_path('product/detail?id=' . $product['id']) ?>" class="block w-full text-center px-4 py-2 bg-emerald-800 text-white font-medium rounded-lg hover:bg-emerald-900 transition duration-200">
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
    <footer class="border-t border-slate-200 py-10">
        <div class="max-w-7xl mx-auto px-6 text-sm text-slate-600 text-center">
            © 2026 E-Commerce-App. All rights reserved.
        </div>
    </footer>
</body>
</html>