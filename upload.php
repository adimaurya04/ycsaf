<?php
// upload.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create uploads directory if it doesn't exist
$uploadsDir = 'uploads/';
if (!file_exists($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

// Create subdirectories for different types
$type = $_POST['type'] ?? 'photo';
$typeDirs = [
    'photo' => 'photos/',
    'memory' => 'memories/',
    'journey' => 'journey/',
    'header-bg' => 'backgrounds/'
];

$subDir = $typeDirs[$type] ?? 'other/';
$fullDir = $uploadsDir . $subDir;

if (!file_exists($fullDir)) {
    mkdir($fullDir, 0755, true);
}

// Check if file was uploaded
if (!isset($_FILES['image'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No file uploaded'
    ]);
    exit;
}

$file = $_FILES['image'];

// Validate file
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode([
        'success' => false,
        'message' => 'Upload error: ' . $file['error']
    ]);
    exit;
}

// Check file size (max 5MB)
if ($file['size'] > 5 * 1024 * 1024) {
    echo json_encode([
        'success' => false,
        'message' => 'File too large (max 5MB)'
    ]);
    exit;
}

// Check file type
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
if (!in_array($file['type'], $allowedTypes)) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid file type. Only JPG, PNG, GIF, WebP allowed.'
    ]);
    exit;
}

// Generate unique filename
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid() . '_' . time() . '.' . $extension;
$filepath = $fullDir . $filename;

// Move uploaded file
if (move_uploaded_file($file['tmp_name'], $filepath)) {
    // Generate URL for the uploaded file
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $baseUrl = dirname($_SERVER['PHP_SELF']);
    $baseUrl = str_replace('\\', '/', $baseUrl); // Fix Windows paths
    
    // Remove trailing slash if exists
    if (substr($baseUrl, -1) === '/') {
        $baseUrl = substr($baseUrl, 0, -1);
    }
    
    $imageUrl = $protocol . $host . $baseUrl . '/' . $filepath;
    
    echo json_encode([
        'success' => true,
        'message' => 'File uploaded successfully',
        'filename' => $filename,
        'filepath' => $filepath,
        'imageUrl' => $imageUrl,
        'type' => $type
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save file'
    ]);
}
?>