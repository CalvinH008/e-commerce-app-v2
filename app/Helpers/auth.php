<?php

/**
 * Dapatkan base path aplikasi
 */
function base_path($path = '') {
    $base = '/e-commerce-app/public';
    return $base . ($path ? '/' . trim($path, '/') : '');
}

/**
 * Sanitasi input untuk mencegah XSS
 */
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validasi harga
 */
function validatePrice($price) {
    return is_numeric($price) && $price > 0;
}

/**
 * Validasi stok
 */
function validateStock($stock) {
    return is_numeric($stock) && $stock >= 0;
}
