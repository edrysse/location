<?php
require 'vendor/autoload.php';

use Cloudinary\Cloudinary;

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'divk85kwd',
        'api_key'    => '816387772954842',
        'api_secret' => 'I8W6M6NyB6N8r9fRb2UJzrnqC4M'
    ]
]);

try {
    $ping = $cloudinary->adminApi()->ping();
    print_r($ping);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
