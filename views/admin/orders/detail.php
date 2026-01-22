<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order #<?= $order['id'] ?> - Admin</title>
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
                <a href="<?= base_path('admin/products') ?>" class="block px-4 py-3 rounded-lg text-emerald-200 hover:bg-emerald-800 hover:text-white transition">
                    📦 Produk
                </a>
                <a href="<?= base_path('admin/orders') ?>" class="block px-4 py-3 rounded-lg bg-emerald-800 text-white font-medium hover:bg-emerald-700 transition">
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
                    <a href="<?= base_path('admin/orders') ?>" class="text-emerald-800 hover:text-emerald-900 transition">← Kembali ke Daftar Pesanan</a>
                </div>

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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Order Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Order Info -->
                        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                            <h2 class="text-xl font-semibold text-slate-900 mb-6">Informasi Pesanan</h2>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-emerald-50 rounded-lg">
                                    <p class="text-sm text-slate-600 mb-1">Tanggal Pesanan</p>
                                    <p class="font-semibold text-slate-900"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                                </div>
                                <div class="p-4 bg-emerald-50 rounded-lg">
                                    <p class="text-sm text-slate-600 mb-1">Status Pesanan</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                        <?php 
                                            if($order['status'] === 'pending') echo 'bg-yellow-50 text-yellow-700';
                                            elseif($order['status'] === 'processing') echo 'bg-emerald-100 text-emerald-700';
                                            elseif($order['status'] === 'completed') echo 'bg-emerald-200 text-emerald-800';
                                            elseif($order['status'] === 'cancelled') echo 'bg-red-50 text-red-700';
                                        ?>
                                    ">
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                </div>
                                <div class="p-4 bg-emerald-50 rounded-lg">
                                    <p class="text-sm text-slate-600 mb-1">Status Pembayaran</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                        <?php 
                                            if($payment['status'] === 'pending') echo 'bg-yellow-50 text-yellow-700';
                                            elseif($payment['status'] === 'verified') echo 'bg-emerald-100 text-emerald-700';
                                            elseif($payment['status'] === 'failed') echo 'bg-red-50 text-red-700';
                                        ?>
                                    ">
                                        <?= ucfirst($payment['status']) ?>
                                    </span>
                                </div>
                                <div class="p-4 bg-emerald-50 rounded-lg">
                                    <p class="text-sm text-slate-600 mb-1">Metode Pembayaran</p>
                                    <p class="font-semibold text-slate-900"><?= ucfirst($payment['payment_method']) ?></p>
                                </div>
                            </div>
                        </div>

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

                        <!-- Update Status Forms -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Update Order Status -->
                            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-6">
                                <h3 class="font-semibold text-emerald-900 mb-4">Update Status Pesanan</h3>
                                <form method="POST" action="<?= base_path('admin/orders/update-status') ?>" class="space-y-3">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <select 
                                        name="status" 
                                        class="w-full px-3 py-2 border border-emerald-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"
                                    >
                                        <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                        <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                    <button 
                                        type="submit" 
                                        class="w-full px-4 py-2 bg-emerald-800 text-white font-medium rounded-lg hover:bg-emerald-900 transition"
                                    >
                                        Update Status
                                    </button>
                                </form>
                            </div>

                            <!-- Update Payment Status -->
                            <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-6">
                                <h3 class="font-semibold text-emerald-900 mb-4">Update Status Pembayaran</h3>
                                <form method="POST" action="<?= base_path('admin/orders/update-payment') ?>" class="space-y-3">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <select 
                                        name="status" 
                                        class="w-full px-3 py-2 border border-emerald-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none"
                                    >
                                        <option value="pending" <?= $payment['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="verified" <?= $payment['status'] === 'verified' ? 'selected' : '' ?>>Verified</option>
                                        <option value="failed" <?= $payment['status'] === 'failed' ? 'selected' : '' ?>>Failed</option>
                                    </select>
                                    <button 
                                        type="submit" 
                                        class="w-full px-4 py-2 bg-emerald-800 text-white font-medium rounded-lg hover:bg-emerald-900 transition"
                                    >
                                        Update Pembayaran
                                    </button>
                                </form>
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
                                <div class="text-sm text-slate-600 mb-2">Total Pembayaran</div>
                                <div class="text-3xl font-bold text-emerald-800">Rp <?= number_format($order['total'], 0, ',', '.') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>