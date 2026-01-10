<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #<?php echo $order['id']; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        h1 { margin-bottom: 10px; color: #333; }
        .order-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        .order-info p { margin-bottom: 10px; }
        .status { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cfe2ff; color: #084298; }
        .status.completed { background: #d1e7dd; color: #0f5132; }
        .status.cancelled { background: #f8d7da; color: #842029; }
        .status.paid { background: #d1e7dd; color: #0f5132; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .total-section { text-align: right; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-bottom: 30px; }
        .total-price { font-size: 28px; font-weight: bold; color: #e74c3c; }
        .payment-info { background: #fff3cd; padding: 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #ffc107; }
        .payment-info h3 { margin-bottom: 15px; color: #856404; }
        .btn { padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #3498db; color: white; }
        .nav { margin-bottom: 20px; }
        .nav a { color: #3498db; text-decoration: none; }
        .flash { background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/e-commerce-app/public/order/history">← Lihat Semua Pesanan</a> |
            <a href="/e-commerce-app/public/products">Lanjut Belanja</a>
        </div>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="flash">
                <?php 
                echo $_SESSION['flash']; 
                unset($_SESSION['flash']);
                ?>
            </div>
        <?php endif; ?>

        <h1>📦 Detail Pesanan #<?php echo $order['id']; ?></h1>
        
        <div class="order-info">
            <p><strong>Tanggal Pesanan:</strong> <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
            <p><strong>Status Pesanan:</strong> 
                <span class="status <?php echo $order['status']; ?>">
                    <?php echo strtoupper($order['status']); ?>
                </span>
            </p>
            <p><strong>Status Pembayaran:</strong> 
                <span class="status <?php echo $payment['status']; ?>">
                    <?php echo strtoupper($payment['status']); ?>
                </span>
            </p>
            <p><strong>Metode Pembayaran:</strong> <?php echo strtoupper($payment['payment_method']); ?></p>
        </div>

        <?php if($payment['status'] === 'pending'): ?>
            <div class="payment-info">
                <h3>⚠️ Menunggu Pembayaran</h3>
                <p><strong>Silakan lakukan pembayaran:</strong></p>
                
                <?php if($payment['payment_method'] === 'transfer'): ?>
                    <p>Transfer ke rekening:</p>
                    <p><strong>BCA 1234567890</strong></p>
                    <p>a.n. Toko Online</p>
                    <p>Nominal: <strong>Rp <?php echo number_format($payment['amount'], 0, ',', '.'); ?></strong></p>
                    <br>
                    <p>Setelah transfer, upload bukti pembayaran di halaman ini.</p>
                <?php elseif($payment['payment_method'] === 'cod'): ?>
                    <p>Pesanan akan dikirim. Bayar saat barang diterima.</p>
                <?php elseif($payment['payment_method'] === 'ewallet'): ?>
                    <p>Scan QRIS atau transfer ke nomor e-wallet: <strong>08123456789</strong></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h3>Detail Produk:</h3>
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
            <div style="font-size: 20px; margin-bottom: 10px;">Total Pembayaran:</div>
            <div class="total-price">Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></div>
        </div>

        <?php if($payment['status'] === 'pending'): ?>
            <p style="text-align: center; color: #666;">
                <em>Pesanan akan diproses setelah pembayaran dikonfirmasi oleh admin.</em>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>