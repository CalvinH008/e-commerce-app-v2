<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { margin-bottom: 30px; color: #333; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .product-image { width: 100%; height: 200px; background: #ddd; border-radius: 4px; margin-bottom: 15px; display: flex; align-items: center; justify-content: center; color: #999; }
        .product-name { font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #333; }
        .product-price { font-size: 20px; color: #e74c3c; font-weight: bold; margin-bottom: 10px; }
        .product-stock { font-size: 14px; color: #666; margin-bottom: 15px; }
        .btn-detail { display: inline-block; background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; transition: background 0.2s; }
        .btn-detail:hover { background: #2980b9; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; color: #3498db; text-decoration: none; }
    </style>    
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/e-commerce-app/public/">Home</a>
            <a href="/e-commerce-app/public/products">Produk</a>
            <?php if(isset($_SESSION['user'])):?>
                <a href="/e-commerce-app/public/dashboard">Dashboard</a>
                <?php if($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/e-commerce-app/public/admin/dashboard">Admin</a>
                <?php endif; ?>
                <a href="/e-commerce-app/public/logout">Logout</a>
                <?php else: ?>
                    <a href="/e-commerce-app/public/login">Login</a>
                    <a href="/e-commerce-app/public/register">Register</a>
                <?php endif; ?>
        </div>

            <h1>Daftar Produk</h1>

            <div class="products-grid">
                <?php foreach($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?= $product['image'] ?? 'No Image'; ?> 
                        </div>
                        <div class="product-name"><?= htmlspecialchars($product['name']); ?></div>
                        <div class="product-price"><?= number_format($product['price'], 0,',','.'); ?></div>
                        <div class="product-stock"><?= $product['stock']; ?></div>
                        <a href="/e-commerce-app/public/product/detail?id=<?php echo $product['id']; ?>" class="btn-detail">Lihat Detail</a>
                    </div>    
                <?php endforeach; ?>
            </div>        
    </div>
</body>
</html>