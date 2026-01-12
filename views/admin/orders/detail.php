<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order #<?php echo $order['id']; ?> - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #2c3e50; color: white; padding: 20px; }
        .header h1 { font-size: 24px; }
        .nav { background: #34495e; padding: 15px 20px; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 15px; border-radius: 4px; }
        .nav a:hover { background: #2c3e50; }
        .nav a.active { background: #3498db; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        .back-link { color: #3498db; text-decoration: none; margin-bottom: 20px; display: inline-block; }
        .order-info { background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .order-info h2 { margin-bottom: 20px; color: #2c3e50; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 20px; }
        .info-item { padding: 15px; background: #f8f9fa; border-radius: 4px; }
        .info-item label { font-weight: bold; color: #7f8c8d; font-size: 14px; display: block; margin-bottom: 5px; }
        .info-item value { color: #2c3e50; font-size: 16px; }
        .status { display: inline-block; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cfe2ff; color: #084298; }
        .status.completed { background: #d1e7dd; color: #0f5132; }
        .status.cancelled { background: #f8d7da; color: #842029; }
        .status.paid { background: #d1e7dd; color: #0f5132; }
        .section { background: white; padding: 25px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .section h3 { margin-bottom: 20px; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ecf0f1; }
        th { background: #f8f9fa; font-weight: bold; }
        .total-section { text-align: right; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-top: 20px; }
        .total-price { font-size: 28px; font-weight: bold; color: #e74c3c; }
        .actions { background: #fff3cd; padding: 20px; border-radius: 8px; border-left: 4px solid #ffc107; }
        .actions h3 { margin-bottom: 15px; color: #856404; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        .btn-primary { background: #3498db; color: white; }
        .btn-success { background: #27ae60; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .flash { background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏪 Admin Dashboard - E-Commerce App</h1>
    </div>
    
    <div class="nav">
        <a href="/e-commerce-app/public/admin/dashboard">Dashboard</a>
        <a href="/e-commerce-app/public/admin/products">Kelola Produk</a>
        <a href="/e-commerce-app/public/admin/orders" class="active">Kelola Pesanan</a>
        <a href="/e-commerce-app/public/products">Lihat Website</a>
        <a href="/e-commerce-app/public/logout">Logout</a>
    </div>

    <div class="container">
        <a href="/e-commerce-app/public/admin/orders" class="back-link">← Kembali ke Daftar Pesanan</a>

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
            
            <form method="POST" action="/e-commerce-app/public/admin/payments/update-status">
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
            
            <form method="POST" action="/e-commerce-app/public/admin/orders/update-status">
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
    </div>
</body>
</html>