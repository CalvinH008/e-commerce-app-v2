<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?></title>
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
                    <a href="<?= base_path('cart') ?>" class="text-slate-600 hover:text-slate-900 transition">Keranjang</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <a href="<?= base_path('products') ?>" class="text-slate-600 hover:text-slate-900 transition flex items-center gap-2">
                <span>←</span> Kembali ke Produk
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <!-- Product Image -->
                <div class="flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 rounded-lg h-96">
                    <span class="text-slate-400 text-lg">
                        <?= htmlspecialchars($product['image'] ?? 'No Image') ?>
                    </span>
                </div>

                <!-- Product Details -->
                <div class="flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 mb-4">
                            <?= htmlspecialchars($product['name']) ?>
                        </h1>

                        <!-- Price and Stock -->
                        <div class="mb-6 pb-6 border-b border-slate-200 space-y-3">
                            <p class="text-4xl font-bold text-slate-900">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </p>
                            <p class="text-sm text-slate-600">
                                <?php if($product['stock'] > 0): ?>
                                    <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full font-medium">
                                        Stok: <?= $product['stock'] ?> unit
                                    </span>
                                <?php else: ?>
                                    <span class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded-full font-medium">
                                        Stok Habis
                                    </span>
                                <?php endif; ?>
                            </p>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-sm font-semibold text-slate-900 mb-3">Deskripsi Produk</h3>
                            <p class="text-slate-600 line-height-relaxed whitespace-pre-wrap">
                                <?= htmlspecialchars($product['description']) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <div class="space-y-4">
                        <?php if($product['stock'] > 0): ?>
                            <form method="POST" action="<?= base_path('cart/add') ?>" class="space-y-4">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-slate-700 mb-2">
                                        Jumlah
                                    </label>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        id="quantity"
                                        value="1" 
                                        min="1" 
                                        max="<?= $product['stock'] ?>"
                                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 outline-none text-slate-900"
                                    >
                                </div>

                                <button 
                                    type="submit" 
                                    class="w-full px-6 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition duration-200"
                                >
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        <?php else: ?>
                            <button 
                                disabled 
                                class="w-full px-6 py-3 bg-slate-300 text-slate-500 font-semibold rounded-lg cursor-not-allowed"
                            >
                                Stok Habis
                            </button>
                        <?php endif; ?>

                        <a 
                            href="<?= base_path('products') ?>" 
                            class="block text-center px-6 py-3 border-2 border-slate-300 text-slate-900 font-semibold rounded-lg hover:border-slate-900 hover:bg-slate-50 transition duration-200"
                        >
                            Lanjut Belanja
                        </a>
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
</html>