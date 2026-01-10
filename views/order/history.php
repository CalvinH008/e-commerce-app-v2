<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        h1 { margin-bottom: 30px; color: #333; }
        .nav { margin-bottom: 20px; }
        .nav a { margin-right: 15px; color: #3498db; text-decoration: none; }
        .order-card { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #3498db; }
        .order-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .order-id { font-weight: bold; font-size: 18px; }
        .status { display: inline-block; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cfe2ff; color: #084298; }
        .status.completed { background: #d1e7dd; color: #0f5132; }
        .status.cancelled { background: #f8d7da; color: #842029; }
        .order-total { font-size: 20px; color: #e74c3c; font-weight: bold; margin: 10px 0; }
        .order-date { color: #666; font-size: 14px; }
        .btn { padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 10px; }
        .btn:hover { background: #2980b9; }
        .empty { text-align: center; padding: 60px 20px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="/e-commerce-app/public/products">← Lanjut Belanja</a>
            <a href="/e-commerce-app/public/dashboard">Dashboard</a>
        </div>

        <h1>📦 Riwayat Pesanan</h1>

        <?php if(empty($orders)): ?>
            <div class="empty">
                <h2>Belum ada pesanan</h2>
                <p>Yuk belanja sekarang!</p>
                <br>
                <a href="/e-commerce-app/public/products" class="btn">Mulai Belanja</a>
            </div>
        <?php else: ?>
            <?php foreach($orders as $order): ?>
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">Pesanan #<?php echo $order['id']; ?></div>
                        <span class="status <?php echo $order['status']; ?>">
                            <?php echo strtoupper($order['status']); ?>
                        </span>
                    </div>
                    <div class="order-date">
                        <?php echo date('d F Y, H:i', strtotime($order['created_at'])); ?>
                    </div>
                    <div class="order-total">
                        Total: Rp <?php echo number_format($order['total'], 0, ',', '.'); ?>
                    </div>
                    <a href="/e-commerce-app/public/order/detail?id=<?php echo $order['id']; ?>" class="btn">Lihat Detail</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>