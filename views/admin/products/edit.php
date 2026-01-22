<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-800">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-emerald-900 text-white min-h-screen fixed left-0 top-0">
            <div class="p-6 border-b border-emerald-700">
                <div class="flex items-center gap-3">
                    <img src="<?= base_path('images/logo.png') ?>" alt="Logo" class="h-10 w-10 bg-white rounded-lg p-1">
                    <div>
                        <h1 class="text-xl font-bold">E-Commerce-App</h1>
                        <p class="text-emerald-300 text-sm">Admin Panel</p>
                    </div>
                </div>
            </div>
            
            <nav class="p-6 space-y-3">
                <a href="<?= base_path('admin/dashboard') ?>" class="block px-4 py-3 rounded-lg text-emerald-200 hover:bg-emerald-800 hover:text-white transition">
                    📊 Dashboard
                </a>
                <a href="<?= base_path('admin/products') ?>" class="block px-4 py-3 rounded-lg bg-emerald-800 text-white font-medium hover:bg-emerald-700 transition">
                    📦 Produk
                </a>
                <a href="<?= base_path('admin/orders') ?>" class="block px-4 py-3 rounded-lg text-emerald-200 hover:bg-emerald-800 hover:text-white transition">
                    🛒 Pesanan
                </a>
                <a href="<?= base_path('') ?>" class="block px-4 py-3 rounded-lg text-emerald-200 hover:bg-emerald-800 hover:text-white transition">
                    🌐 Website
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-emerald-700">
                <a href="<?= base_path('logout') ?>" class="block px-4 py-3 rounded-lg text-emerald-200 hover:bg-red-900 hover:text-white transition text-center font-medium">
                    🚪 Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 w-full">
            <div class="px-6 py-8">
                <div class="mb-8">
                    <a href="<?= base_path('admin/products') ?>" class="text-emerald-800 hover:text-emerald-900 transition">← Kembali</a>
                </div>

                <?php if(isset($_SESSION['flash'])): ?>
                    <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-700">
                            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
                    <h1 class="text-3xl font-bold text-slate-900 mb-8">Edit Produk</h1>

                    <form method="POST" action="<?= base_path('admin/products/update') ?>" class="space-y-6">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">

                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Nama Produk *</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name"
                                value="<?= htmlspecialchars($product['name']) ?>"
                                required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition text-slate-900"
                            >
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-slate-700 mb-2">Harga (Rp) *</label>
                            <input 
                                type="number" 
                                name="price" 
                                id="price"
                                value="<?= $product['price'] ?>"
                                required
                                min="0"
                                step="1000"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition text-slate-900"
                            >
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-slate-700 mb-2">Stok (Unit) *</label>
                            <input 
                                type="number" 
                                name="stock" 
                                id="stock"
                                value="<?= $product['stock'] ?>"
                                required
                                min="0"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition text-slate-900"
                            >
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                            <textarea 
                                name="description" 
                                id="description"
                                rows="5"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition text-slate-900"
                            ><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <a href="<?= base_path('admin/products') ?>" class="flex-1 text-center px-6 py-3 border-2 border-emerald-800 text-emerald-800 font-medium rounded-lg hover:bg-emerald-50 transition">
                                Batal
                            </a>
                            <button 
                                type="submit" 
                                class="flex-1 px-6 py-3 bg-emerald-800 text-white font-medium rounded-lg hover:bg-emerald-900 transition"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>