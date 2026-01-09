<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .product-image { width: 100%; height: 400px; background: #ddd; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 24px; }
        .product-name { font-size: 28px; font-weight: bold; margin-bottom: 15px; color: #333; }
        .product-price { font-size: 32px; color: #e74c3c; font-weight: bold; margin-bottom: 15px; }
        .product-stock { font-size: 16px; color: #666; margin-bottom: 20px; }
        .product-description { line-height: 1.6; color: #555; margin-bottom: 30px; }
        .btn { display: inline-block; padding: 12px 30px; text-decoration: none; border-radius: 4px; margin-right: 10px; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; color: #3498db; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/e-commerce-app/public/products">← Kembali ke Daftar Produk</a>
        </div>

        <div class="product-image">
            <?php echo $product['image'] ?? 'No Image'; ?>
        </div>
        
        <h1 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h1>
        
        <div class="product-price">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></div>
        
        <div class="product-stock">
            <?php if($product['stock'] > 0): ?>
                Stok tersedia: <?php echo $product['stock']; ?> unit
            <?php else: ?>
                <span style="color: red;">Stok habis</span>
            <?php endif; ?>
        </div>
        
        <div class="product-description">
            <h3>Deskripsi Produk:</h3>
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        </div>
        
        <?php if($product['stock'] > 0): ?>
            <a href="#" class="btn btn-primary">Tambah ke Keranjang</a>
        <?php else: ?>
            <button class="btn btn-secondary" disabled>Stok Habis</button>
        <?php endif; ?>
        <a href="/e-commerce-app/public/products" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>