<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
                <div class="flex items-center gap-6 text-sm font-medium">
                     <a href="<?= base_path('cart') ?>"
                        class="group flex items-center text-emerald-800">
                            <span class="flex items-center justify-center
                                        w-10 h-10 rounded-full
                                        bg-emerald-700 text-white
                                        ring-emerald-300">
                                <i class="bx bx-cart text-2xl"></i>
                            </span>
                        </a>
                    <a href="<?= base_path('products') ?>" class="hover:text-emerald-800">Produk</a>
                    <a href="<?= base_path('dashboard') ?>" class="hover:text-emerald-800">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900">Keranjang Belanja</h1>
            <p class="text-slate-600 mt-2">Review dan lanjutkan checkout</p>
        </div>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-emerald-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <?php if(empty($cart)): ?>
            <div class="bg-white rounded-lg border border-slate-200 p-16 text-center">
                <p class="text-slate-600 text-xl mb-6">Keranjang belanja Anda kosong</p>
                <a href="<?= base_path('products') ?>" class="inline-block px-6 py-3 bg-emerald-800 text-white font-semibold rounded-lg hover:bg-emerald-900 transition">
                    Mulai Belanja
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-slate-200 bg-emerald-50">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Produk</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Harga</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Jumlah</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subtotal</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cart as $productId => $item): ?>
                                        <tr class="border-b border-slate-200 hover:bg-emerald-50">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded flex items-center justify-center">
                                                        <span class="text-xs text-emerald-600">Image</span>
                                                    </div>
                                                    <span class="font-medium text-slate-900"><?= htmlspecialchars($item['name']) ?></span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-900 font-medium">
                                                Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <form method="POST" action="<?= base_path('cart/update') ?>" class="inline-flex gap-2">
                                                    <input type="hidden" name="product_id" value="<?= $productId ?>">
                                                    <input 
                                                        type="number" 
                                                        name="quantity" 
                                                        value="<?= $item['quantity'] ?>" 
                                                        min="1"
                                                        class="w-16 px-2 py-1 border border-slate-300 rounded text-slate-900 focus:ring-2 focus:ring-emerald-500 outline-none"
                                                    >
                                                    <button type="submit" class="px-3 py-1 text-sm bg-emerald-800 text-white rounded hover:bg-emerald-900 transition">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 text-slate-900 font-semibold">
                                                Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <form method="POST" action="<?= base_path('cart/remove') ?>" style="display:inline;">
                                                    <input type="hidden" name="product_id" value="<?= $productId ?>">
                                                    <button 
                                                        type="submit" 
                                                        onclick="return confirm('Hapus produk ini?')"
                                                        class="px-3 py-1 text-sm bg-red-50 text-red-700 rounded hover:bg-red-100 transition"
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

                        <div class="p-6 border-t border-slate-200 bg-emerald-50">
                            <form method="POST" action="<?= base_path('cart/clear') ?>" style="display:inline;">
                                <button 
                                    type="submit"
                                    onclick="return confirm('Kosongkan keranjang?')"
                                    class="px-4 py-2 text-sm border border-emerald-800 text-emerald-800 rounded hover:bg-white transition"
                                >
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 sticky top-32">
                        <h3 class="text-lg font-semibold text-slate-900 mb-6">Ringkasan</h3>
                        
                        <div class="space-y-4 pb-6 border-b border-slate-200">
                            <div class="flex justify-between text-slate-600">
                                <span>Total Belanja:</span>
                                <span class="font-medium">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>
                            <div class="flex justify-between text-slate-600">
                                <span>Ongkir:</span>
                                <span class="font-medium">Rp 0</span>
                            </div>
                        </div>

                        <div class="pt-6">
                            <div class="flex justify-between mb-6">
                                <span class="text-lg font-bold text-slate-900">Total:</span>
                                <span class="text-2xl font-bold text-emerald-800">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>

                            <a 
                                href="<?= base_path('checkout') ?>" 
                                class="block w-full text-center px-6 py-3 bg-emerald-800 text-white font-semibold rounded-lg hover:bg-emerald-900 transition"
                            >
                                Lanjut Checkout
                            </a>
                        </div>
                    </div>
                </div>
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