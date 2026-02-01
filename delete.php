<?php
// delete.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['imageUrl'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No image URL provided'
    ]);
    exit;
}

$imageUrl = $data['imageUrl'];

// Extract filename from URL
$parsedUrl = parse_url($imageUrl);
$path = $parsedUrl['path'];

// Remove the base path to get relative path
$basePath = dirname($_SERVER['PHP_SELF']);
if ($basePath !== '/') {
    $path = str_replace($basePath, '', $path);
}

// Remove leading slash if exists
if (strpos($path, '/') === 0) {
    $path = substr($path, 1);
}

// Check if file exists
if (file_exists($path)) {
    if (unlink($path)) {
        echo json_encode([
            'success' => true,
            'message' => 'File deleted successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to delete file'
        ]);
    }
} else {
    echo json_encode([
        'success' => true,
        'message' => 'File not found (already deleted)'
    ]);
}
?>