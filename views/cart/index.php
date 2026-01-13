<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900">Keranjang Belanja</h1>
            <p class="text-slate-600 mt-2">Review dan lanjutkan checkout</p>
        </div>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <?php if(empty($cart)): ?>
            <div class="bg-white rounded-lg border border-slate-200 p-16 text-center">
                <p class="text-slate-600 text-xl mb-6">Keranjang belanja Anda kosong</p>
                <a href="<?= base_path('products') ?>" class="inline-block px-6 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition">
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
                                    <tr class="border-b border-slate-200 bg-slate-50">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Produk</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Harga</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Jumlah</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subtotal</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cart as $productId => $item): ?>
                                        <tr class="border-b border-slate-200 hover:bg-slate-50">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-16 h-16 bg-gradient-to-br from-slate-100 to-slate-200 rounded flex items-center justify-center">
                                                        <span class="text-xs text-slate-400">Image</span>
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
                                                        class="w-16 px-2 py-1 border border-slate-300 rounded text-slate-900"
                                                    >
                                                    <button type="submit" class="px-3 py-1 text-sm bg-slate-900 text-white rounded hover:bg-slate-800 transition">
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

                        <div class="p-6 border-t border-slate-200 bg-slate-50">
                            <form method="POST" action="<?= base_path('cart/clear') ?>" style="display:inline;">
                                <button 
                                    type="submit"
                                    onclick="return confirm('Kosongkan keranjang?')"
                                    class="px-4 py-2 text-sm border border-slate-300 text-slate-600 rounded hover:bg-white transition"
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
                                <span class="text-2xl font-bold text-slate-900">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </div>

                            <a 
                                href="<?= base_path('checkout') ?>" 
                                class="block w-full text-center px-6 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition"
                            >
                                Lanjut Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    </div>

</body>
</html>