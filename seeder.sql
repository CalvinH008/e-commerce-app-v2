-- ===================================
-- DUMMY DATA SEEDER for E-Commerce
-- ===================================


-- Insert Products - Laptops
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('ASUS ROG Zephyrus G14', 18999000, 'Gaming laptop dengan prosesor Intel i9, RTX 4090, layar 4K 120Hz', 12, 'asus-rog-g14.jpg', NOW(), NOW()),
('MacBook Pro 16 M3 Max', 22999000, 'Laptop profesional dengan chip M3 Max, 36GB RAM, SSD 1TB', 8, 'macbook-pro-m3.jpg', NOW(), NOW()),
('Dell XPS 15', 19999000, 'Laptop premium dengan i9-13900H, RTX 4080, layar OLED 3.5K', 10, 'dell-xps-15.jpg', NOW(), NOW()),
('Lenovo ThinkPad X1 Extreme', 17999000, 'Workstation mobile dengan i9, RTX 4070, display 3.2K', 7, 'thinkpad-x1.jpg', NOW(), NOW()),
('HP Omen 16', 15999000, 'Gaming laptop dengan RTX 4070 Ti, i9-13900H, 240Hz', 15, 'hp-omen-16.jpg', NOW(), NOW()),
('MSI Raider GE78', 17499000, 'Powerhouse gaming dengan RTX 4090, i9-13950HX, 240Hz', 9, 'msi-raider.jpg', NOW(), NOW()),
('Acer Swift 3', 7999000, 'Laptop tipis dan ringan untuk productivity, Ryzen 5, 8GB RAM', 25, 'acer-swift-3.jpg', NOW(), NOW()),
('ASUS VivoBook 15', 6499000, 'Laptop budget-friendly dengan i5, 8GB RAM, 512GB SSD', 30, 'asus-vivobook.jpg', NOW(), NOW());

-- Insert Products - Processors
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('Intel Core i9-13900K', 7499000, 'Prosesor desktop flagship dengan 24 core, TDP 125W', 18, 'i9-13900k.jpg', NOW(), NOW()),
('AMD Ryzen 9 7950X3D', 7299000, 'Prosesor high-end dengan 16-core, 3D V-Cache technology', 14, 'ryzen-9-7950x3d.jpg', NOW(), NOW()),
('Intel Core i7-13700K', 4499000, 'Mid-range prosessor 8-core/16-thread untuk gaming', 22, 'i7-13700k.jpg', NOW(), NOW()),
('AMD Ryzen 7 7700X', 4299000, 'Prosesor 8-core AM5 dengan performa gaming superior', 20, 'ryzen-7-7700x.jpg', NOW(), NOW());

-- Insert Products - Graphics Cards
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('NVIDIA RTX 4090', 19999000, 'GPU flagship dengan 24GB GDDR6X, ideal untuk gaming extreme', 5, 'rtx-4090.jpg', NOW(), NOW()),
('NVIDIA RTX 4080', 13999000, 'GPU high-end dengan 16GB GDDR6X untuk 4K gaming', 8, 'rtx-4080.jpg', NOW(), NOW()),
('AMD Radeon RX 7900 XTX', 12999000, 'GPU RDNA 3 flagship dengan 24GB VRAM', 6, 'rx-7900xtx.jpg', NOW(), NOW()),
('NVIDIA RTX 4070', 8999000, 'GPU mid-range reliable untuk 1440p gaming', 12, 'rtx-4070.jpg', NOW(), NOW()),
('NVIDIA RTX 4060', 4499000, 'Entry-level GPU dengan 8GB VRAM untuk 1080p gaming', 20, 'rtx-4060.jpg', NOW(), NOW());

-- Insert Products - Memory/RAM
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('Corsair Dominator Platinum 32GB DDR5 6000MHz', 3999000, 'High-speed DDR5 RAM dengan RGB lighting premium', 35, 'corsair-dom-32gb.jpg', NOW(), NOW()),
('G.Skill Trident Z5 32GB DDR5', 3699000, 'DDR5 6000MHz dengan timing CAS 30 yang kompetitif', 28, 'gskill-trident-32gb.jpg', NOW(), NOW()),
('Kingston Fury Beast 16GB DDR4 3600MHz', 899000, 'DDR4 budget-friendly dengan performa solid', 50, 'kingston-fury-16gb.jpg', NOW(), NOW()),
('Crucial Ballistix 32GB DDR4 3600MHz', 1599000, 'DDR4 berkualitas untuk gaming dan workstation', 42, 'crucial-ballistix-32gb.jpg', NOW(), NOW());

-- Insert Products - Storage
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('Samsung 990 Pro 4TB NVMe SSD', 4999000, 'SSD tercepat dengan PCIe 4.0, ideal untuk content creator', 16, 'samsung-990pro-4tb.jpg', NOW(), NOW()),
('WD Black SN850X 2TB', 2699000, 'NVMe SSD PCIe 4.0 performa tinggi untuk gaming', 24, 'wd-black-2tb.jpg', NOW(), NOW()),
('Crucial P5 Plus 1TB', 1199000, 'SSD NVMe PCIe 4.0 dengan kecepatan hingga 6.6GB/s', 38, 'crucial-p5-plus-1tb.jpg', NOW(), NOW()),
('Seagate Barracuda Pro 8TB', 2499000, 'HDD enterprise untuk storage besar dan backup', 12, 'seagate-barracuda-8tb.jpg', NOW(), NOW());

-- Insert Products - Motherboards
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('ASUS ROG STRIX Z790-E Gaming WiFi', 6499000, 'Motherboard flagship LGA1700 dengan PCIe 5.0', 10, 'asus-rog-z790-e.jpg', NOW(), NOW()),
('MSI MEG Z790 ACE', 5999000, 'High-end Z790 dengan power delivery premium', 8, 'msi-meg-z790.jpg', NOW(), NOW()),
('ASUS ROG STRIX X870-E Gaming WiFi', 5799000, 'Motherboard AM5 flagship dengan socket terbaru', 11, 'asus-x870-e.jpg', NOW(), NOW()),
('MSI MAG B850 Tomahawk WiFi', 2999000, 'Motherboard B850 value dengan fitur lengkap', 19, 'msi-mag-b850.jpg', NOW(), NOW());

-- Insert Products - Power Supply
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('Corsair RM1000e 1000W', 2899000, 'PSU modular 80+ Gold untuk sistem high-end', 14, 'corsair-rm1000e.jpg', NOW(), NOW()),
('EVGA SuperNOVA 850 GA 850W', 1999000, 'PSU reliable 80+ Gold dengan 10 tahun warranty', 21, 'evga-850ga.jpg', NOW(), NOW()),
('Seasonic Prime 650W', 1599000, 'PSU berkualitas 80+ Gold untuk gaming mid-range', 28, 'seasonic-prime-650w.jpg', NOW(), NOW());

-- Insert Products - Cases
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('NZXT H7 Flow RGB', 1899000, 'Case gaming dengan airflow premium dan RGB lighting', 16, 'nzxt-h7-flow.jpg', NOW(), NOW()),
('Corsair 5000T RGB', 2999000, 'Premium case dengan tempered glass 4 sisi', 9, 'corsair-5000t.jpg', NOW(), NOW()),
('Lian Li Lancool 215 Mesh', 599000, 'Case budget-friendly dengan mesh front panel', 35, 'lian-li-lancool-215.jpg', NOW(), NOW());

-- Insert Products - Cooling
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('Noctua NH-D15 Chromax', 1299000, 'CPU cooler air terbaik dengan 2 fan 140mm', 18, 'noctua-nh-d15.jpg', NOW(), NOW()),
('CORSAIR iCUE H170i ELITE LCD', 2499000, 'AIO liquid cooler 420mm dengan LCD screen', 12, 'corsair-aio-420mm.jpg', NOW(), NOW()),
('be quiet! Dark Rock Pro 4', 1099000, 'Air cooler silet dengan performa excellent', 22, 'be-quiet-dark-rock.jpg', NOW(), NOW());

-- Insert Products - Monitors
INSERT INTO `products` (`name`, `price`, `description`, `stock`, `image`, `created_at`, `updated_at`) VALUES
('ASUS ROG Swift 360Hz 27"', 12999000, 'Gaming monitor 1440p 360Hz untuk esports extreme', 7, 'asus-rog-360hz.jpg', NOW(), NOW()),
('LG UltraWide 38" 160Hz', 14999000, 'Ultrawide gaming dan workstation monitor', 5, 'lg-ultrawide-38.jpg', NOW(), NOW()),
('DELL U2725D 27" 4K IPS', 4999000, 'Professional monitor 4K untuk content creator', 11, 'dell-u2725d.jpg', NOW(), NOW()),
('BenQ EW2480 24" 60Hz', 1599000, 'Monitor budget 1080p eye-care terjangkau', 30, 'benq-ew2480.jpg', NOW(), NOW());

-- End of seeder
