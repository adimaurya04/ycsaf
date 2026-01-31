<?php
// save-config.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the raw POST data
$input = file_get_contents('php://input');

// Decode JSON data
$data = json_decode($input, true);

if ($data === null) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid JSON data'
    ]);
    exit;
}

// File path for config.json
$configFile = 'config.json';

// Backup old config file if exists
if (file_exists($configFile)) {
    $backupFile = 'backups/config_backup_' . date('Y-m-d_H-i-s') . '.json';
    
    // Create backups directory if it doesn't exist
    if (!file_exists('backups/')) {
        mkdir('backups/', 0755, true);
    }
    
    copy($configFile, $backupFile);
}

// Save data to config.json
try {
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
    if (file_put_contents($configFile, $jsonData)) {
        // Set proper permissions
        chmod($configFile, 0644);
        
        echo json_encode([
            'success' => true,
            'message' => 'Config saved successfully',
            'timestamp' => date('Y-m-d H:i:s'),
            'backup' => isset($backupFile) ? $backupFile : null
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to write config file'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>