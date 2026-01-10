<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        h1 { margin-bottom: 30px; color: #333; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; color: #3498db; text-decoration: none; }
        .flash { background: #2ecc71; color: white; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: bold; }
        .product-image { width: 80px; height: 80px; background: #ddd; display: flex; align-items: center; justify-content: center; border-radius: 4px; font-size: 12px; color: #999; }
        .product-name { font-weight: bold; color: #333; }
        .product-price { color: #e74c3c; font-weight: bold; }
        input[type="number"] { width: 60px; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-update { background: #3498db; color: white; }
        .btn-remove { background: #e74c3c; color: white; }
        .btn-clear { background: #95a5a6; color: white; }
        .btn-checkout { background: #27ae60; color: white; font-size: 16px; padding: 12px 30px; }
        .total-section { text-align: right; margin-top: 20px; }
        .total-label { font-size: 24px; font-weight: bold; color: #333; }
        .total-price { font-size: 32px; font-weight: bold; color: #e74c3c; }
        .empty-cart { text-align: center; padding: 60px 20px; color: #999; }
        .actions { margin-top: 30px; display: flex; justify-content: space-between; align-items: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/e-commerce-app/public/products">← Lanjut Belanja</a>
            <a href="/e-commerce-app/public/dashboard">Dashboard</a>
        </div>

        <h1>🛒 Keranjang Belanja</h1>

        <?php if(isset($_SESSION['flash'])): ?>
            <div class="flash">
                <?php 
                echo $_SESSION['flash']; 
                unset($_SESSION['flash']);
                ?>
            </div>
        <?php endif; ?>

        <?php if(empty($cart)): ?>
            <div class="empty-cart">
                <h2>Keranjang masih kosong</h2>
                <p>Belum ada produk di keranjang. Yuk belanja sekarang!</p>
                <br>
                <a href="/e-commerce-app/public/products" class="btn btn-checkout">Mulai Belanja</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cart as $productId => $item): ?>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <div class="product-image">
                                        <?php echo $item['image'] ?? 'No Image'; ?>
                                    </div>
                                    <div class="product-name"><?php echo htmlspecialchars($item['name']); ?></div>
                                </div>
                            </td>
                            <td class="product-price">
                                Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <form method="POST" action="/e-commerce-app/public/cart/update" style="display: inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit" class="btn btn-update">Update</button>
                                </form>
                            </td>
                            <td class="product-price">
                                Rp <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <form method="POST" action="/e-commerce-app/public/cart/remove" style="display: inline;">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <button type="submit" class="btn btn-remove" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-label">Total Belanja:</div>
                <div class="total-price">Rp <?php echo number_format($total, 0, ',', '.'); ?></div>
            </div>

            <div class="actions">
                <form method="POST" action="/e-commerce-app/public/cart/clear">
                    <button type="submit" class="btn btn-clear" onclick="return confirm('Kosongkan keranjang?')">Kosongkan Keranjang</button>
                </form>
                
                <a href="/e-commerce-app/public/checkout" class="btn btn-checkout">Lanjut ke Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>