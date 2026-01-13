<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order #<?= $order['id'] ?> - Admin</title>
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
                <a href="<?= base_path('admin/products') ?>" class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    📦 Produk
                </a>
                <a href="<?= base_path('admin/orders') ?>" class="block px-4 py-3 rounded-lg bg-slate-800 text-white font-medium hover:bg-slate-700 transition">
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
                <div class="mb-8">
                    <a href="<?= base_path('admin/orders') ?>" class="text-slate-600 hover:text-slate-900 transition">← Kembali ke Daftar Pesanan</a>
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
                        <div class="p-4 bg-slate-50 rounded-lg">
                            <p class="text-sm text-slate-600 mb-1">Tanggal Pesanan</p>
                            <p class="font-semibold text-slate-900"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-lg">
                            <p class="text-sm text-slate-600 mb-1">Status Pesanan</p>
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
                        <div class="p-4 bg-slate-50 rounded-lg">
                            <p class="text-sm text-slate-600 mb-1">Status Pembayaran</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                <?php 
                                    if($payment['status'] === 'pending') echo 'bg-yellow-50 text-yellow-700';
                                    elseif($payment['status'] === 'verified') echo 'bg-emerald-50 text-emerald-700';
                                    elseif($payment['status'] === 'failed') echo 'bg-red-50 text-red-700';
                                ?>
                            ">
                                <?= ucfirst($payment['status']) ?>
                            </span>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-lg">
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
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Produk</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Harga</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($items as $item): ?>
                                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                                        <td class="px-6 py-4 font-medium text-slate-900"><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td class="px-6 py-4 text-slate-900">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td class="px-6 py-4 text-slate-900"><?= $item['quantity'] ?></td>
                                        <td class="px-6 py-4 font-semibold text-slate-900">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Update Status Forms -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Update Order Status -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="font-semibold text-blue-900 mb-4">Update Status Pesanan</h3>
                        <form method="POST" action="<?= base_path('admin/orders/update-status') ?>" class="space-y-3">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <select 
                                name="status" 
                                class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                            >
                                <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                            <button 
                                type="submit" 
                                class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition"
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
                                class="w-full px-4 py-2 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-700 transition"
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
                        <div class="text-3xl font-bold text-slate-900">Rp <?= number_format($order['total'], 0, ',', '.') ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
        <h1>🏪 Admin Dashboard - E-Commerce App</h1>
    </div>
    
    <div class="nav">
        <a href="<?php echo base_path('admin/dashboard'); ?>">Dashboard</a>
        <a href="<?php echo base_path('admin/products'); ?>">Kelola Produk</a>
        <a href="<?php echo base_path('admin/orders'); ?>" class="active">Kelola Pesanan</a>
        <a href="<?php echo base_path('products'); ?>">Lihat Website</a>
        <a href="<?php echo base_path('logout'); ?>">Logout</a>
    </div>

    <div class="container">
        <a href="<?php echo base_path('admin/orders'); ?>" class="back-link">← Kembali ke Daftar Pesanan</a>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="flash">
                <?php 
                echo $_SESSION['flash']; 
                unset($_SESSION['flash']);
                ?>
            </div>
        <?php endif; ?>

        <div class="order-info">
            <h2>📦 Detail Pesanan #<?php echo $order['id']; ?></h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <label>Customer</label>
                    <value><?php echo htmlspecialchars($order['username'] ?? 'Unknown'); ?></value>
                </div>
                
                <div class="info-item">
                    <label>Tanggal Pesanan</label>
                    <value><?php echo date('d F Y, H:i', strtotime($order['created_at'])); ?></value>
                </div>
                
                <div class="info-item">
                    <label>Status Pesanan</label>
                    <value>
                        <span class="status <?php echo $order['status']; ?>">
                            <?php echo strtoupper($order['status']); ?>
                        </span>
                    </value>
                </div>
                
                <div class="info-item">
                    <label>Status Pembayaran</label>
                    <value>
                        <span class="status <?php echo $payment['status']; ?>">
                            <?php echo strtoupper($payment['status']); ?>
                        </span>
                    </value>
                </div>
                
                <div class="info-item">
                    <label>Metode Pembayaran</label>
                    <value><?php echo strtoupper($payment['payment_method']); ?></value>
                </div>
                
                <div class="info-item">
                    <label>Total Pembayaran</label>
                    <value style="color: #e74c3c; font-weight: bold; font-size: 20px;">
                        Rp <?php echo number_format($order['total'], 0, ',', '.'); ?>
                    </value>
                </div>
            </div>
        </div>

        <div class="section">
            <h3>📋 Detail Produk</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                            <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>Rp <?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="total-section">
                <div style="font-size: 18px; margin-bottom: 10px;">Total:</div>
                <div class="total-price">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></div>
            </div>
        </div>

        <?php if($payment['status'] === 'pending'): ?>
        <div class="actions">
            <h3>⚡ Verifikasi Pembayaran</h3>
            <p style="margin-bottom: 15px;">Customer sudah melakukan pembayaran? Ubah status pembayaran di bawah ini:</p>
            
            <form method="POST" action="<?php echo base_path('admin/payments/update-status'); ?>">
                <input type="hidden" name="payment_id" value="<?php echo $payment['id']; ?>">
                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                
                <div class="form-group">
                    <label>Status Pembayaran:</label>
                    <select name="status">
                        <option value="pending" selected>Pending - Menunggu Pembayaran</option>
                        <option value="paid">Paid - Pembayaran Diterima</option>
                        <option value="failed">Failed - Pembayaran Gagal</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success" onclick="return confirm('Yakin update status pembayaran?')">
                    ✓ Update Status Pembayaran
                </button>
            </form>
        </div>
        <?php endif; ?>

        <div class="actions" style="background: #e8f4f8; border-color: #3498db;">
            <h3>📦 Update Status Pesanan</h3>
            
            <form method="POST" action="<?php echo base_path('admin/orders/update-status'); ?>">
                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                
                <div class="form-group">
                    <label>Status Pesanan:</label>
                    <select name="status">
                        <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending - Menunggu Konfirmasi</option>
                        <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>Processing - Sedang Diproses</option>
                        <option value="completed" <?php echo $order['status'] === 'completed' ? 'selected' : ''; ?>>Completed - Selesai</option>
                        <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled - Dibatalkan</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin update status pesanan?')">
                    📝 Update Status Pesanan
                </button>
            </form>
            </div>
        </main>
    </div>
</body>
</html>