<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Konfirmasi Pesanan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        h1 { margin-bottom: 30px; color: #333; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; color: #3498db; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: bold; }
        .product-name { font-weight: bold; color: #333; }
        .product-price { color: #e74c3c; }
        .total-section { text-align: right; margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px; }
        .total-label { font-size: 20px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .total-price { font-size: 32px; font-weight: bold; color: #e74c3c; }
        .payment-method { margin-bottom: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px; }
        .payment-method h3 { margin-bottom: 15px; }
        .payment-method label { display: block; padding: 10px; margin-bottom: 10px; background: white; border: 2px solid #ddd; border-radius: 4px; cursor: pointer; }
        .payment-method input[type="radio"] { margin-right: 10px; }
        .payment-method label:hover { border-color: #3498db; }
        .payment-method input[type="radio"]:checked + label { border-color: #27ae60; background: #d5f4e6; }
        .btn { padding: 15px 40px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #27ae60; color: white; }
        .btn-primary:hover { background: #229954; }
        .btn-secondary { background: #95a5a6; color: white; }
        .actions { display: flex; justify-content: space-between; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/e-commerce-app/public/cart">← Kembali ke Keranjang</a>
        </div>

        <h1>🛒 Checkout - Konfirmasi Pesanan</h1>

        <h3>Detail Pesanan:</h3>
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
                <?php foreach($cart as $item): ?>
                    <tr>
                        <td class="product-name"><?php echo htmlspecialchars($item['name']); ?></td>
                        <td class="product-price">Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td class="product-price">Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-label">Total Pembayaran:</div>
            <div class="total-price">Rp <?php echo number_format($total, 0, ',', '.'); ?></div>
        </div>

        <form method="POST" action="/e-commerce-app/public/checkout/process">
            <div class="payment-method">
                <h3>Pilih Metode Pembayaran:</h3>
                
                <input type="radio" name="payment_method" value="transfer" id="transfer" checked>
                <label for="transfer">
                    <strong>Transfer Bank</strong><br>
                    <small>Transfer ke rekening BCA 1234567890 a.n. Toko Online</small>
                </label>

                <input type="radio" name="payment_method" value="cod" id="cod">
                <label for="cod">
                    <strong>COD (Cash on Delivery)</strong><br>
                    <small>Bayar saat barang diterima</small>
                </label>

                <input type="radio" name="payment_method" value="ewallet" id="ewallet">
                <label for="ewallet">
                    <strong>E-Wallet</strong><br>
                    <small>Gopay, OVO, Dana, ShopeePay</small>
                </label>
            </div>

            <div class="actions">
                <a href="/e-commerce-app/public/cart" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Konfirmasi pesanan Anda?')">Konfirmasi Pesanan</button>
            </div>
        </form>
    </div>
</body>
</html>