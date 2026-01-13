<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <a href="<?= base_path('admin/dashboard') ?>" class="block px-4 py-3 rounded-lg bg-slate-800 text-white font-medium hover:bg-slate-700 transition">
                    📊 Dashboard
                </a>
                <a href="<?= base_path('admin/products') ?>" class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
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
            <div class="px-6 py-12">
        <?php if(isset($_SESSION['flash'])): ?>
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                <p class="text-emerald-700">
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Products -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Total Produk</p>
                        <p class="text-4xl font-bold text-slate-900 mt-2"><?= $totalProducts ?></p>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 rounded-lg flex items-center justify-center text-2xl">
                        📦
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Total Pesanan</p>
                        <p class="text-4xl font-bold text-slate-900 mt-2"><?= $totalOrders ?></p>
                    </div>
                    <div class="w-14 h-14 bg-orange-50 rounded-lg flex items-center justify-center text-2xl">
                        🛒
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 text-sm font-medium">Total Revenue</p>
                        <p class="text-3xl font-bold text-slate-900 mt-2">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-50 rounded-lg flex items-center justify-center text-2xl">
                        💰
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-200">
            <div class="p-6 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-900">Pesanan Terbaru</h2>
            </div>

            <?php if(empty($recentOrders)): ?>
                <div class="p-12 text-center">
                    <p class="text-slate-600">Belum ada pesanan</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Order ID</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Customer</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Total</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Tanggal</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recentOrders as $order): ?>
                                <tr class="border-b border-slate-200 hover:bg-slate-50">
                                    <td class="px-6 py-4 font-medium text-slate-900">#<?= $order['id'] ?></td>
                                    <td class="px-6 py-4 text-slate-900"><?= htmlspecialchars($order['username']) ?></td>
                                    <td class="px-6 py-4 font-semibold text-slate-900">Rp <?= number_format($order['total'], 0, ',', '.') ?></td>
                                    <td class="px-6 py-4">
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
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 text-sm"><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                    <td class="px-6 py-4">
                                        <a href="<?= base_path('admin/orders/detail?id=' . $order['id']) ?>" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="p-6 border-t border-slate-200 bg-slate-50">
                    <a href="<?= base_path('admin/orders') ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                        Lihat Semua Pesanan →
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
            <?php endif; ?>