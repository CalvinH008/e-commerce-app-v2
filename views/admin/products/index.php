<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white min-h-screen fixed left-0 top-0">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-xl font-bold">E-Commerce-App</h1>
                <p class="text-slate-400 text-sm mt-1">Admin Panel</p>
            </div>
            
            <nav class="p-6 space-y-3">
                <a href="<?= base_path('admin/dashboard') ?>" class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    📊 Dashboard
                </a>
                <a href="<?= base_path('admin/products') ?>" class="block px-4 py-3 rounded-lg bg-slate-800 text-white font-medium hover:bg-slate-700 transition">
                    📦 Produk
                </a>
                <a href="<?= base_path('admin/orders') ?>" class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    🛒 Pesanan
                </a>
                <a href="<?= base_path('') ?>" class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    🌐 Website
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-slate-700">
                <a href="<?= base_path('logout') ?>" class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-red-900 hover:text-white transition text-center font-medium">
                    🚪 Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 w-full">
            <div class="px-6 py-8">
                <div class="mb-8 flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-slate-900">Kelola Produk</h1>
                    <a href="<?= base_path('admin/products/create') ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        + Tambah Produk
                    </a>
                </div>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-emerald-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-4xl font-bold text-slate-900">Kelola Produk</h2>
                <p class="text-slate-600 mt-2">Manage semua produk di toko Anda</p>
            </div>
            <a href="<?= base_path('admin/products/create') ?>" class="px-6 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition">
                + Tambah Produk
            </a>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <?php if(empty($products)): ?>
                <div class="p-12 text-center">
                    <p class="text-slate-600 text-lg mb-4">Belum ada produk</p>
                    <a href="<?= base_path('admin/products/create') ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                        Tambah produk baru
                    </a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Nama Produk</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Harga</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Stok</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr class="border-b border-slate-200 hover:bg-slate-50">
                                    <td class="px-6 py-4 text-sm text-slate-900"><?= $product['id'] ?></td>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900"><?= htmlspecialchars($product['name']) ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-900">Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                                    <td class="px-6 py-4 text-sm text-slate-900"><?= $product['stock'] ?> unit</td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <a href="<?= base_path('admin/products/edit?id=' . $product['id']) ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                                            Edit
                                        </a>
                                        <form method="POST" action="<?= base_path('admin/products/delete') ?>" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                            <button 
                                                type="submit" 
                                                onclick="return confirm('Hapus produk ini?')"
                                                class="text-red-600 hover:text-red-800 font-medium"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>