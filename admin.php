<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Birthday Website</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --admin-blue: #4361ee;
            --admin-dark: #2b2d42;
            --success: #00b894;
            --warning: #fdcb6e;
            --danger: #ff7675;
            --light: #f8f9fa;
            --gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            min-height: 90vh;
        }

        /* Admin Header */
        .admin-header {
            background: var(--admin-dark);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .admin-header h1 {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-header h1 i {
            color: var(--success);
        }

        .admin-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .view-site-btn, .save-btn, .reset-btn, .export-btn, .load-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .view-site-btn {
            background: var(--admin-blue);
            color: white;
            text-decoration: none;
        }

        .save-btn {
            background: var(--success);
            color: white;
        }

        .load-btn {
            background: #00cec9;
            color: white;
        }

        .reset-btn {
            background: var(--warning);
            color: #333;
        }

        .export-btn {
            background: #6c5ce7;
            color: white;
        }

        .view-site-btn:hover, .save-btn:hover, .reset-btn:hover, .export-btn:hover, .load-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Admin Tabs */
        .admin-tabs {
            display: flex;
            background: var(--light);
            border-bottom: 2px solid #e9ecef;
            overflow-x: auto;
        }

        .admin-tab {
            padding: 18px 30px;
            background: none;
            border: none;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            color: var(--gray);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            border-bottom: 3px solid transparent;
        }

        .admin-tab:hover {
            background: #e9ecef;
            color: var(--admin-dark);
        }

        .admin-tab.active {
            color: var(--admin-blue);
            border-bottom-color: var(--admin-blue);
            background: white;
        }

        /* Admin Content */
        .admin-content {
            padding: 30px;
            min-height: 600px;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tab-title {
            color: var(--admin-dark);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tab-title i {
            color: var(--admin-blue);
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--admin-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--admin-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        /* File Upload Styles */
        .file-upload-area {
            border: 3px dashed #ddd;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .file-upload-area:hover {
            border-color: var(--admin-blue);
            background: #eef5ff;
        }

        .file-upload-area i {
            font-size: 3rem;
            color: var(--admin-blue);
            margin-bottom: 15px;
        }

        .file-upload-area h3 {
            color: var(--admin-dark);
            margin-bottom: 10px;
        }

        .file-upload-area p {
            color: #666;
            margin-bottom: 15px;
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        .upload-btn {
            background: var(--admin-blue);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background: #3a56d4;
            transform: translateY(-2px);
        }

        /* Progress Bar */
        .progress-container {
            margin-top: 20px;
            display: none;
        }

        .progress-bar {
            width: 100%;
            height: 10px;
            background: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            height: 100%;
            background: var(--success);
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-text {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }

        /* Uploaded Files */
        .uploaded-files {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 20px;
        }

        .uploaded-file {
            width: 120px;
            text-align: center;
        }

        .uploaded-file img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #e9ecef;
            margin-bottom: 8px;
        }

        .uploaded-file p {
            font-size: 0.8rem;
            color: #666;
            word-break: break-all;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 250px;
        }

        /* Image Preview */
        .image-preview-container {
            margin-top: 15px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .image-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
            border-color: var(--admin-blue);
        }

        /* Item Management */
        .item-list {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            max-height: 400px;
            overflow-y: auto;
            border: 2px solid #e9ecef;
        }

        .item-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--admin-blue);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateX(5px);
        }

        .item-card .item-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .item-card .item-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .item-actions {
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        .edit-btn, .delete-btn, .add-btn {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: var(--warning);
            color: #333;
        }

        .edit-btn:hover {
            background: #f9c74f;
        }

        .delete-btn {
            background: var(--danger);
            color: white;
        }

        .delete-btn:hover {
            background: #ff5252;
        }

        .add-btn {
            background: var(--success);
            color: white;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background: #00a085;
            transform: translateY(-2px);
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--light);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--admin-blue);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: var(--admin-blue);
            margin-bottom: 15px;
        }

        .stat-card h3 {
            color: var(--admin-dark);
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--admin-blue);
        }

        /* Notifications */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .notification.success {
            background: var(--success);
        }

        .notification.error {
            background: var(--danger);
        }

        .notification.warning {
            background: var(--warning);
            color: #333;
        }

        /* Loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            flex-direction: column;
            color: white;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--admin-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body { padding: 10px; }
            .admin-header { flex-direction: column; text-align: center; padding: 20px; }
            .admin-actions { flex-wrap: wrap; justify-content: center; }
            .admin-tabs { padding: 0; }
            .admin-tab { padding: 15px; font-size: 0.9rem; }
            .admin-content { padding: 20px; }
            .form-row { flex-direction: column; }
            .item-card { flex-direction: column; align-items: flex-start; }
            .item-actions { align-self: flex-end; }
            .stats-grid { grid-template-columns: 1fr; }
            .file-upload-area { padding: 20px 10px; }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <p id="loadingText">Loading...</p>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification" style="display: none;"></div>

    <div class="admin-container">
        <!-- Admin Header -->
        <div class="admin-header">
            <h1>
                <i class="fas fa-crown"></i>
                Birthday Website Admin Panel
            </h1>
            <div class="admin-actions">
                <a href="index.html" target="_blank" class="view-site-btn">
                    <i class="fas fa-eye"></i> View Site
                </a>
                <button class="load-btn" onclick="loadFromConfig()">
                    <i class="fas fa-sync"></i> Load Config
                </button>
                <button class="save-btn" onclick="saveToConfig()">
                    <i class="fas fa-save"></i> Save Config
                </button>
                <button class="export-btn" onclick="exportConfig()">
                    <i class="fas fa-download"></i> Export
                </button>
                <button class="reset-btn" onclick="resetToDefault()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </div>

        <!-- Admin Tabs -->
        <div class="admin-tabs">
            <button class="admin-tab active" onclick="openTab('dashboard')">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </button>
            <button class="admin-tab" onclick="openTab('header')">
                <i class="fas fa-heading"></i> Header
            </button>
            <button class="admin-tab" onclick="openTab('memories')">
                <i class="fas fa-images"></i> Memories
            </button>
            <button class="admin-tab" onclick="openTab('notes')">
                <i class="fas fa-envelope"></i> Love Note
            </button>
            <button class="admin-tab" onclick="openTab('journey')">
                <i class="fas fa-road"></i> Journey
            </button>
            <button class="admin-tab" onclick="openTab('photos')">
                <i class="fas fa-camera"></i> Photos
            </button>
            <button class="admin-tab" onclick="openTab('special')">
                <i class="fas fa-gift"></i> Special
            </button>
            <button class="admin-tab" onclick="openTab('footer')">
                <i class="fas fa-music"></i> Footer
            </button>
        </div>

        <!-- Admin Content -->
        <div class="admin-content">
            <!-- Dashboard Tab -->
            <div id="dashboard-tab" class="tab-content active">
                <h2 class="tab-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-images"></i>
                        <h3>Memories</h3>
                        <div class="stat-number" id="memoriesCount">0</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-camera"></i>
                        <h3>Photos</h3>
                        <div class="stat-number" id="photosCount">0</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-road"></i>
                        <h3>Journey Items</h3>
                        <div class="stat-number" id="journeyCount">0</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>Last Updated</h3>
                        <div style="font-size: 1.2rem; color: var(--admin-dark);" id="lastUpdatedTime">Never</div>
                    </div>
                </div>

                <div style="background: #eef5ff; padding: 25px; border-radius: 15px; margin-top: 30px;">
                    <h3><i class="fas fa-upload"></i> Photo Upload Instructions</h3>
                    <p style="margin: 15px 0; color: var(--admin-dark);">
                        <strong>How to upload photos:</strong>
                    </p>
                    <ul style="margin: 10px 0 0 20px; color: #666; line-height: 1.8;">
                        <li>Go to "Photos" tab</li>
                        <li>Click on "Upload Photo" area</li>
                        <li>Select image from your computer</li>
                        <li>Photo will be uploaded to server</li>
                        <li>Click "Save Config" to update website</li>
                    </ul>
                </div>

                <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                    <h3><i class="fas fa-info-circle"></i> Instructions</h3>
                    <ul style="margin: 15px 0 0 20px; color: var(--admin-dark); line-height: 1.8;">
                        <li>Click on any tab to edit that section</li>
                        <li>Use "Add New" buttons to add content</li>
                        <li>Click "Save Config" to save changes to file</li>
                        <li>Use "View Site" to see the website</li>
                        <li>Export data for backup</li>
                    </ul>
                </div>
            </div>

            <!-- Header Tab -->
            <div id="header-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-heading"></i> Header Settings</h2>
                
                <div class="form-group">
                    <label for="main-title"><i class="fas fa-heading"></i> Main Title</label>
                    <input type="text" id="main-title" placeholder="Happy Birthday">
                </div>
                
                <div class="form-group">
                    <label for="sub-title"><i class="fas fa-subscript"></i> Sub Title</label>
                    <input type="text" id="sub-title" placeholder="My Dearest Love">
                </div>
                
                <div class="form-group">
                    <label for="birthday-person"><i class="fas fa-user"></i> Birthday Person's Name</label>
                    <input type="text" id="birthday-person" placeholder="Enter name">
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-image"></i> Background Image</label>
                    <div class="file-upload-area" onclick="document.getElementById('header-bg-upload').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h3>Upload Background Image</h3>
                        <p>Click here or drag & drop image</p>
                        <p style="font-size: 0.9rem; color: #888;">Recommended size: 1200x800px</p>
                        <input type="file" id="header-bg-upload" accept="image/*" onchange="uploadHeaderBackground(event)">
                    </div>
                    
                    <div class="progress-container" id="header-bg-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" id="header-bg-progress-fill"></div>
                        </div>
                        <div class="progress-text" id="header-bg-progress-text">0%</div>
                    </div>
                    
                    <div class="image-preview-container">
                        <img id="main-bg-preview" class="image-preview" src="" alt="Preview" onerror="this.style.display='none'">
                    </div>
                </div>
            </div>

            <!-- Memories Tab -->
            <div id="memories-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-images"></i> Memories Management</h2>
                
                <button class="add-btn" onclick="addNewMemory()">
                    <i class="fas fa-plus"></i> Add New Memory
                </button>
                
                <div class="item-list" id="memoriesList">
                    <!-- Memories will load here -->
                </div>
                
                <div id="memoryForm" style="display: none; margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                    <h3 style="margin-bottom: 20px; color: var(--admin-dark);">
                        <i class="fas fa-edit"></i> 
                        <span id="memoryFormTitle">Add New Memory</span>
                    </h3>
                    
                    <div class="form-group">
                        <label><i class="fas fa-image"></i> Memory Image</label>
                        <div class="file-upload-area" onclick="document.getElementById('memory-image-upload').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h3>Upload Memory Image</h3>
                            <p>Click here to select image</p>
                            <input type="file" id="memory-image-upload" accept="image/*" onchange="previewMemoryImage(event)">
                        </div>
                        
                        <div class="progress-container" id="memory-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" id="memory-progress-fill"></div>
                            </div>
                            <div class="progress-text" id="memory-progress-text">0%</div>
                        </div>
                        
                        <div class="image-preview-container">
                            <img id="memory-img-preview" class="image-preview" src="" alt="Preview" onerror="this.style.display='none'">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="memory-title">Memory Title</label>
                            <input type="text" id="memory-title" placeholder="First Date">
                        </div>
                        <div class="form-group">
                            <label for="memory-date">Date</label>
                            <input type="date" id="memory-date">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="memory-desc">Description</label>
                        <textarea id="memory-desc" placeholder="Describe this memory..."></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-top: 20px;">
                        <button class="save-btn" onclick="saveMemory()" style="flex: 1;">
                            <i class="fas fa-save"></i> Save Memory
                        </button>
                        <button class="reset-btn" onclick="cancelMemory()" style="flex: 1;">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Notes Tab -->
            <div id="notes-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-envelope"></i> Love Note</h2>
                
                <div class="form-group">
                    <label for="love-note"><i class="fas fa-heart"></i> Your Love Note</label>
                    <textarea id="love-note" placeholder="Write your love note here..."></textarea>
                </div>
                
                <div style="background: #fffdf5; padding: 20px; border-radius: 5px; font-family: 'Georgia', serif; line-height: 1.8; margin-top: 20px;">
                    <h3 style="color: var(--admin-dark); margin-bottom: 15px;">Preview:</h3>
                    <p id="love-note-preview">Your love note will appear here...</p>
                </div>
            </div>

            <!-- Journey Tab -->
            <div id="journey-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-road"></i> Journey Timeline</h2>
                
                <button class="add-btn" onclick="addNewJourney()">
                    <i class="fas fa-plus"></i> Add New Milestone
                </button>
                
                <div class="item-list" id="journeyList">
                    <!-- Journey items will load here -->
                </div>
                
                <div id="journeyForm" style="display: none; margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                    <h3 style="margin-bottom: 20px; color: var(--admin-dark);">
                        <i class="fas fa-edit"></i> 
                        <span id="journeyFormTitle">Add New Milestone</span>
                    </h3>
                    
                    <div class="form-group">
                        <label><i class="fas fa-image"></i> Journey Image</label>
                        <div class="file-upload-area" onclick="document.getElementById('journey-image-upload').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h3>Upload Journey Image</h3>
                            <p>Click here to select image</p>
                            <input type="file" id="journey-image-upload" accept="image/*" onchange="previewJourneyImage(event)">
                        </div>
                        
                        <div class="progress-container" id="journey-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" id="journey-progress-fill"></div>
                            </div>
                            <div class="progress-text" id="journey-progress-text">0%</div>
                        </div>
                        
                        <div class="image-preview-container">
                            <img id="journey-img-preview" class="image-preview" src="" alt="Preview" onerror="this.style.display='none'">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="journey-title">Milestone Title</label>
                            <input type="text" id="journey-title" placeholder="Our First Meeting">
                        </div>
                        <div class="form-group">
                            <label for="journey-date">Date</label>
                            <input type="date" id="journey-date">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="journey-desc">Description</label>
                        <textarea id="journey-desc" placeholder="Describe this milestone..."></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 15px; margin-top: 20px;">
                        <button class="save-btn" onclick="saveJourney()" style="flex: 1;">
                            <i class="fas fa-save"></i> Save Milestone
                        </button>
                        <button class="reset-btn" onclick="cancelJourney()" style="flex: 1;">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>

            <!-- Photos Tab -->
            <div id="photos-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-camera"></i> Photo Gallery</h2>
                
                <div class="form-group">
                    <label><i class="fas fa-upload"></i> Upload New Photo</label>
                    <div class="file-upload-area" onclick="document.getElementById('photo-upload').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <h3>Upload Photo to Gallery</h3>
                        <p>Click here or drag & drop photo</p>
                        <p style="font-size: 0.9rem; color: #888;">Supported: JPG, PNG, GIF, WebP (Max 5MB)</p>
                        <input type="file" id="photo-upload" accept="image/*" onchange="handlePhotoUpload(event)">
                    </div>
                    
                    <div class="progress-container" id="photo-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" id="photo-progress-fill"></div>
                        </div>
                        <div class="progress-text" id="photo-progress-text">0%</div>
                    </div>
                    
                    <div class="uploaded-files" id="uploadedPhotosPreview">
                        <!-- Uploaded photos preview -->
                    </div>
                </div>
                
                <div style="margin: 30px 0; padding: 20px; background: #eef5ff; border-radius: 10px;">
                    <h3><i class="fas fa-images"></i> Gallery Photos</h3>
                    <p style="margin: 10px 0; color: #666;">Total photos: <span id="totalPhotosCount">0</span></p>
                </div>
                
                <div class="item-list" id="photosList">
                    <!-- Photos will load here -->
                </div>
            </div>

            <!-- Special Tab -->
            <div id="special-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-gift"></i> Special Surprise</h2>
                
                <div class="form-group">
                    <label for="special-title"><i class="fas fa-heading"></i> Special Note Title</label>
                    <input type="text" id="special-title" placeholder="A Surprise...">
                </div>
                
                <div class="form-group">
                    <label for="special-message"><i class="fas fa-envelope"></i> Special Message</label>
                    <textarea id="special-message" placeholder="Write your special message..."></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="special-button"><i class="fas fa-hand-pointer"></i> Button Text</label>
                        <input type="text" id="special-button" placeholder="Click here 🎁">
                    </div>
                    <div class="form-group">
                        <label for="special-alert"><i class="fas fa-bell"></i> Alert Message</label>
                        <input type="text" id="special-alert" placeholder="Surprise! I love you!">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="real-gift"><i class="fas fa-box-open"></i> Real Gift Description (Optional)</label>
                    <textarea id="real-gift" placeholder="Describe the real gift..."></textarea>
                </div>
            </div>

            <!-- Footer Tab -->
            <div id="footer-tab" class="tab-content">
                <h2 class="tab-title"><i class="fas fa-music"></i> Footer Settings</h2>
                
                <div class="form-group">
                    <label for="footer-text"><i class="fas fa-text"></i> Footer Text</label>
                    <input type="text" id="footer-text" placeholder="🎵 Play our song">
                </div>
                
                <div class="form-group">
                    <label for="audio-url"><i class="fas fa-music"></i> Audio URL (Optional)</label>
                    <input type="text" id="audio-url" placeholder="https://example.com/song.mp3">
                    <p style="margin-top: 8px; color: #666; font-size: 0.9rem;">
                        <i class="fas fa-info-circle"></i> 
                        Leave empty if you don't want background music
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Default data structure
        const defaultData = {
            header: {
                title: "Happy Birthday",
                subtitle: "My Dearest Love",
                background: "https://png.pngtree.com/png-clipart/20240619/original/pngtree-blank-paper-text-box-template-design-with-love-icon-suitable-for-png-image_15369747.png",
                birthdayPerson: ""
            },
            loveNote: "My Love,<br><br>Happy Birthday! Looking back at all our time together, I realize how lucky I am. You are the calm in my chaos and the smile on my face.<br><br>This year, I wish you all the happiness in the world. I love you endlessly.<br><br>Yours forever.",
            memories: [],
            journey: [],
            photos: [],
            specialNote: {
                title: "A Surprise...",
                message: "I wanted to do something special for you.<br>Click below! ✨",
                button: "Click here 🎁",
                alert: "Your surprise is a big hug and lots of love! (and maybe a real gift later!)",
                realGift: ""
            },
            footer: {
                text: "🎵 Play our song",
                audio: ""
            },
            lastUpdated: "Never"
        };

        // Current website data
        let websiteData = { ...defaultData };

        // State variables
        let editingMemoryId = null;
        let editingJourneyId = null;
        let currentUploadType = null;
        let uploadedImageUrl = null;

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i> ${message}`;
            notification.className = `notification ${type}`;
            notification.style.display = 'flex';
            
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        // Show loading overlay
        function showLoading(message = 'Loading...') {
            document.getElementById('loadingText').textContent = message;
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        // Hide loading overlay
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Safe function to update form field value
        function safeSetValue(elementId, value) {
            const element = document.getElementById(elementId);
            if (element) {
                element.value = value || '';
            }
        }

        // Safe function to update innerHTML
        function safeSetHTML(elementId, html) {
            const element = document.getElementById(elementId);
            if (element) {
                element.innerHTML = html || '';
            }
        }

        // Safe function to update textContent
        function safeSetText(elementId, text) {
            const element = document.getElementById(elementId);
            if (element) {
                element.textContent = text || '';
            }
        }

        // Safe function to update src
        function safeSetSrc(elementId, src) {
            const element = document.getElementById(elementId);
            if (element) {
                element.src = src || '';
                if (src) {
                    element.style.display = 'block';
                }
            }
        }

        // Load data from config.json
        async function loadFromConfig() {
            showLoading('Loading data from config.json...');
            
            try {
                const response = await fetch('config.json?t=' + new Date().getTime());
                
                if (!response.ok) {
                    if (response.status === 404) {
                        // Config file doesn't exist, create default
                        await createDefaultConfig();
                        websiteData = { ...defaultData };
                    } else {
                        throw new Error('Failed to load config.json');
                    }
                } else {
                    const data = await response.json();
                    websiteData = { ...defaultData, ...data };
                }
                
                // Update form with loaded data
                updateFormData();
                updateStats();
                
                hideLoading();
                showNotification('Data loaded successfully from config.json!', 'success');
                
            } catch (error) {
                hideLoading();
                console.error('Load error:', error);
                showNotification('Error loading config.json. Using default data.', 'warning');
                
                // Use default data
                websiteData = { ...defaultData };
                updateFormData();
                updateStats();
            }
        }

        // Create default config.json if it doesn't exist
        async function createDefaultConfig() {
            try {
                const response = await fetch('save-config.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(defaultData)
                });
                
                if (!response.ok) {
                    console.warn('Could not create config file.');
                }
            } catch (error) {
                console.warn('Could not create config file:', error);
            }
        }

        // Upload image to server
        async function uploadImage(file, type = 'photo') {
            return new Promise((resolve, reject) => {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('type', type);
                
                // Show progress bar
                const progressBar = document.getElementById(`${type}-progress-fill`);
                const progressText = document.getElementById(`${type}-progress-text`);
                const progressContainer = document.getElementById(`${type}-progress`);
                
                if (progressContainer) {
                    progressContainer.style.display = 'block';
                }
                
                const xhr = new XMLHttpRequest();
                
                xhr.upload.onprogress = function(event) {
                    if (event.lengthComputable) {
                        const percentComplete = (event.loaded / event.total) * 100;
                        if (progressBar) {
                            progressBar.style.width = percentComplete + '%';
                        }
                        if (progressText) {
                            progressText.textContent = Math.round(percentComplete) + '%';
                        }
                    }
                };
                
                xhr.onload = function() {
                    if (progressContainer) {
                        setTimeout(() => {
                            progressContainer.style.display = 'none';
                        }, 1000);
                    }
                    
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                resolve(response.imageUrl);
                            } else {
                                reject(response.message || 'Upload failed');
                            }
                        } catch (e) {
                            reject('Invalid server response');
                        }
                    } else {
                        reject('Upload failed with status: ' + xhr.status);
                    }
                };
                
                xhr.onerror = function() {
                    if (progressContainer) {
                        progressContainer.style.display = 'none';
                    }
                    reject('Network error during upload');
                };
                
                xhr.open('POST', 'upload.php');
                xhr.send(formData);
            });
        }

        // Delete image from server
        async function deleteImage(imageUrl) {
            try {
                const response = await fetch('delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ imageUrl: imageUrl })
                });
                
                const result = await response.json();
                return result.success;
            } catch (error) {
                console.error('Delete error:', error);
                return false;
            }
        }

        // Handle photo upload
        async function handlePhotoUpload(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Check file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showNotification('File too large! Max size is 5MB.', 'error');
                return;
            }
            
            // Check file type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                showNotification('Invalid file type! Please upload JPG, PNG, GIF or WebP.', 'error');
                return;
            }
            
            try {
                showNotification('Uploading photo...', 'warning');
                
                const imageUrl = await uploadImage(file, 'photo');
                
                // Add to photos array
                websiteData.photos.push(imageUrl);
                
                // Update photo list
                loadPhotosList();
                updateStats();
                
                // Show preview
                showUploadedPhotoPreview(imageUrl);
                
                showNotification('Photo uploaded successfully!', 'success');
                
            } catch (error) {
                showNotification('Upload failed: ' + error, 'error');
                console.error('Upload error:', error);
            }
        }

        // Show uploaded photo preview
        function showUploadedPhotoPreview(imageUrl) {
            const previewContainer = document.getElementById('uploadedPhotosPreview');
            if (previewContainer) {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'uploaded-file';
                fileDiv.innerHTML = `
                    <img src="${imageUrl}" alt="Uploaded Photo">
                    <p>Uploaded</p>
                `;
                previewContainer.appendChild(fileDiv);
            }
        }

        // Upload header background
        async function uploadHeaderBackground(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            try {
                showNotification('Uploading background image...', 'warning');
                
                const imageUrl = await uploadImage(file, 'header-bg');
                
                // Update background image
                websiteData.header.background = imageUrl;
                safeSetSrc('main-bg-preview', imageUrl);
                
                showNotification('Background image uploaded successfully!', 'success');
                
            } catch (error) {
                showNotification('Upload failed: ' + error, 'error');
            }
        }

        // Preview memory image before upload
        async function previewMemoryImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                safeSetSrc('memory-img-preview', e.target.result);
                uploadedImageUrl = null; // Reset uploaded image
            };
            reader.readAsDataURL(file);
            
            // Auto-upload the image
            try {
                showNotification('Uploading memory image...', 'warning');
                
                const imageUrl = await uploadImage(file, 'memory');
                uploadedImageUrl = imageUrl;
                
                // Update the image URL field
                safeSetSrc('memory-img-preview', imageUrl);
                
                showNotification('Memory image uploaded successfully!', 'success');
                
            } catch (error) {
                showNotification('Upload failed: ' + error, 'error');
            }
        }

        // Preview journey image before upload
        async function previewJourneyImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                safeSetSrc('journey-img-preview', e.target.result);
                uploadedImageUrl = null; // Reset uploaded image
            };
            reader.readAsDataURL(file);
            
            // Auto-upload the image
            try {
                showNotification('Uploading journey image...', 'warning');
                
                const imageUrl = await uploadImage(file, 'journey');
                uploadedImageUrl = imageUrl;
                
                // Update the image URL field
                safeSetSrc('journey-img-preview', imageUrl);
                
                showNotification('Journey image uploaded successfully!', 'success');
                
            } catch (error) {
                showNotification('Upload failed: ' + error, 'error');
            }
        }

        // Update data from form fields
        function updateDataFromForms() {
            // Update timestamp
            websiteData.lastUpdated = new Date().toLocaleString();
            
            // Update from form fields using safe functions
            websiteData.header.title = document.getElementById('main-title')?.value || defaultData.header.title;
            websiteData.header.subtitle = document.getElementById('sub-title')?.value || defaultData.header.subtitle;
            websiteData.header.birthdayPerson = document.getElementById('birthday-person')?.value || defaultData.header.birthdayPerson;

            websiteData.loveNote = document.getElementById('love-note')?.value || defaultData.loveNote;

            websiteData.specialNote.title = document.getElementById('special-title')?.value || defaultData.specialNote.title;
            websiteData.specialNote.message = document.getElementById('special-message')?.value || defaultData.specialNote.message;
            websiteData.specialNote.button = document.getElementById('special-button')?.value || defaultData.specialNote.button;
            websiteData.specialNote.alert = document.getElementById('special-alert')?.value || defaultData.specialNote.alert;
            websiteData.specialNote.realGift = document.getElementById('real-gift')?.value || defaultData.specialNote.realGift;

            websiteData.footer.text = document.getElementById('footer-text')?.value || defaultData.footer.text;
            websiteData.footer.audio = document.getElementById('audio-url')?.value || defaultData.footer.audio;
        }

        // Update form fields with current data
        function updateFormData() {
            // Header
            safeSetValue('main-title', websiteData.header.title);
            safeSetValue('sub-title', websiteData.header.subtitle);
            safeSetValue('birthday-person', websiteData.header.birthdayPerson);
            safeSetSrc('main-bg-preview', websiteData.header.background);

            // Love Note
            safeSetValue('love-note', websiteData.loveNote);
            safeSetHTML('love-note-preview', websiteData.loveNote);

            // Special Note
            safeSetValue('special-title', websiteData.specialNote.title);
            safeSetValue('special-message', websiteData.specialNote.message);
            safeSetValue('special-button', websiteData.specialNote.button);
            safeSetValue('special-alert', websiteData.specialNote.alert);
            safeSetValue('real-gift', websiteData.specialNote.realGift);

            // Footer
            safeSetValue('footer-text', websiteData.footer.text);
            safeSetValue('audio-url', websiteData.footer.audio);

            // Update lists
            loadMemoriesList();
            loadJourneyList();
            loadPhotosList();
        }

        // Update statistics
        function updateStats() {
            safeSetText('memoriesCount', websiteData.memories?.length || 0);
            safeSetText('photosCount', websiteData.photos?.length || 0);
            safeSetText('totalPhotosCount', websiteData.photos?.length || 0);
            safeSetText('journeyCount', websiteData.journey?.length || 0);
            safeSetText('lastUpdatedTime', websiteData.lastUpdated || 'Never');
        }

        // Save data to config.json using PHP
        async function saveToConfig() {
            showLoading('Saving data to config.json...');
            
            // Update data from form fields
            updateDataFromForms();
            
            try {
                const response = await fetch('save-config.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(websiteData)
                });
                
                if (response.ok) {
                    const result = await response.json();
                    if (result.success) {
                        hideLoading();
                        showNotification('Data saved successfully to config.json!', 'success');
                        updateStats();
                    } else {
                        hideLoading();
                        showNotification('Error saving data: ' + result.message, 'error');
                    }
                } else {
                    hideLoading();
                    showNotification('Server error: ' + response.status, 'error');
                }
                
            } catch (error) {
                hideLoading();
                console.error('Save error:', error);
                showNotification('Error saving to server: ' + error.message, 'error');
                
                // Fallback: Offer to download config file
                if (confirm('Server save failed. Download config file instead?')) {
                    exportConfig();
                }
            }
        }

        // Export config as JSON file
        function exportConfig() {
            updateDataFromForms();
            
            const dataStr = JSON.stringify(websiteData, null, 2);
            const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
            const exportFileDefaultName = 'config.json';
            
            const linkElement = document.createElement('a');
            linkElement.setAttribute('href', dataUri);
            linkElement.setAttribute('download', exportFileDefaultName);
            document.body.appendChild(linkElement);
            linkElement.click();
            document.body.removeChild(linkElement);
            
            showNotification('config.json file downloaded!', 'success');
        }

        // Reset to default
        async function resetToDefault() {
            if (confirm('Are you sure you want to reset all content to default? This will delete all uploaded photos.')) {
                try {
                    // Delete all uploaded photos from server
                    if (websiteData.photos && websiteData.photos.length > 0) {
                        showNotification('Deleting uploaded photos...', 'warning');
                        
                        for (const photo of websiteData.photos) {
                            if (photo.includes('uploads/')) {
                                await deleteImage(photo);
                            }
                        }
                    }
                    
                    // Delete memory images
                    if (websiteData.memories && websiteData.memories.length > 0) {
                        for (const memory of websiteData.memories) {
                            if (memory.img && memory.img.includes('uploads/')) {
                                await deleteImage(memory.img);
                            }
                        }
                    }
                    
                    // Delete journey images
                    if (websiteData.journey && websiteData.journey.length > 0) {
                        for (const item of websiteData.journey) {
                            if (item.img && item.img.includes('uploads/')) {
                                await deleteImage(item.img);
                            }
                        }
                    }
                    
                    websiteData = { ...defaultData };
                    updateFormData();
                    updateStats();
                    showNotification('Reset to default successful! All uploaded files deleted.', 'success');
                    
                } catch (error) {
                    console.error('Reset error:', error);
                    showNotification('Error during reset: ' + error.message, 'error');
                }
            }
        }

        // Tab navigation
        function openTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.admin-tab').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            const tabElement = document.getElementById(`${tabName}-tab`);
            if (tabElement) {
                tabElement.classList.add('active');
            }
            
            // Mark tab button as active
            const buttons = document.querySelectorAll('.admin-tab');
            buttons.forEach(btn => {
                if (btn.textContent.includes(tabName.charAt(0).toUpperCase() + tabName.slice(1)) || 
                    btn.querySelector('i').className.includes(tabName)) {
                    btn.classList.add('active');
                }
            });
        }

        // MEMORIES MANAGEMENT
        function loadMemoriesList() {
            const container = document.getElementById('memoriesList');
            if (!container) return;
            
            container.innerHTML = '';
            
            if (!websiteData.memories || websiteData.memories.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; font-style: italic; padding: 20px;">No memories added yet. Click "Add New Memory" to get started.</p>';
                return;
            }
            
            websiteData.memories.forEach(memory => {
                const item = document.createElement('div');
                item.className = 'item-card';
                item.innerHTML = `
                    <div class="item-info">
                        <img src="${memory.img}" alt="${memory.title}" class="item-img" onerror="this.src='https://via.placeholder.com/100?text=Memory'">
                        <div style="flex: 1;">
                            <h4 style="margin: 0; color: var(--admin-dark);">${memory.title}</h4>
                            <p style="color: #666; font-size: 0.9rem; margin: 5px 0;">${memory.date || 'No date'}</p>
                            <p style="color: #777; font-size: 0.9rem; margin: 0;">${(memory.description || '').substring(0, 80)}...</p>
                        </div>
                    </div>
                    <div class="item-actions">
                        <button class="edit-btn" onclick="editMemory(${memory.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="delete-btn" onclick="deleteMemory(${memory.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addNewMemory() {
            editingMemoryId = null;
            uploadedImageUrl = null;
            safeSetText('memoryFormTitle', 'Add New Memory');
            
            const memoryForm = document.getElementById('memoryForm');
            if (memoryForm) {
                memoryForm.style.display = 'block';
            }
            
            safeSetValue('memory-title', '');
            safeSetValue('memory-date', new Date().toISOString().split('T')[0]);
            safeSetValue('memory-desc', '');
            safeSetSrc('memory-img-preview', '');
            
            const memoryProgress = document.getElementById('memory-progress');
            if (memoryProgress) {
                memoryProgress.style.display = 'none';
            }
            
            // Scroll to form
            if (memoryForm) {
                memoryForm.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function editMemory(id) {
            const memory = websiteData.memories?.find(m => m.id === id);
            if (memory) {
                editingMemoryId = id;
                uploadedImageUrl = memory.img;
                safeSetText('memoryFormTitle', 'Edit Memory');
                
                const memoryForm = document.getElementById('memoryForm');
                if (memoryForm) {
                    memoryForm.style.display = 'block';
                }
                
                safeSetValue('memory-title', memory.title);
                safeSetValue('memory-date', memory.date);
                safeSetValue('memory-desc', memory.description);
                safeSetSrc('memory-img-preview', memory.img);
                
                const memoryProgress = document.getElementById('memory-progress');
                if (memoryProgress) {
                    memoryProgress.style.display = 'none';
                }
                
                // Scroll to form
                if (memoryForm) {
                    memoryForm.scrollIntoView({ behavior: 'smooth' });
                }
            }
        }

        async function saveMemory() {
            const title = document.getElementById('memory-title')?.value;
            const date = document.getElementById('memory-date')?.value;
            const desc = document.getElementById('memory-desc')?.value;

            if (!title || !date) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }

            let imageUrl = uploadedImageUrl;
            if (!imageUrl && editingMemoryId) {
                // Keep existing image if editing
                const existingMemory = websiteData.memories?.find(m => m.id === editingMemoryId);
                imageUrl = existingMemory ? existingMemory.img : '';
            }

            if (!imageUrl) {
                showNotification('Please upload an image for the memory', 'error');
                return;
            }

            if (editingMemoryId) {
                // Update existing memory
                const index = websiteData.memories?.findIndex(m => m.id === editingMemoryId) || -1;
                if (index !== -1) {
                    // Delete old image if changed
                    if (websiteData.memories[index].img !== imageUrl && websiteData.memories[index].img.includes('uploads/')) {
                        await deleteImage(websiteData.memories[index].img);
                    }
                    
                    websiteData.memories[index] = {
                        id: editingMemoryId,
                        img: imageUrl,
                        title,
                        date,
                        description: desc
                    };
                }
            } else {
                // Add new memory
                const newId = websiteData.memories && websiteData.memories.length > 0 ? 
                    Math.max(...websiteData.memories.map(m => m.id)) + 1 : 1;
                
                if (!websiteData.memories) {
                    websiteData.memories = [];
                }
                
                websiteData.memories.push({
                    id: newId,
                    img: imageUrl,
                    title,
                    date,
                    description: desc
                });
            }

            loadMemoriesList();
            updateStats();
            
            const memoryForm = document.getElementById('memoryForm');
            if (memoryForm) {
                memoryForm.style.display = 'none';
            }
            
            showNotification('Memory saved successfully!', 'success');
        }

        async function deleteMemory(id) {
            if (!confirm('Are you sure you want to delete this memory?')) return;

            const memory = websiteData.memories?.find(m => m.id === id);
            if (memory) {
                // Delete image from server if it was uploaded
                if (memory.img && memory.img.includes('uploads/')) {
                    await deleteImage(memory.img);
                }
                
                websiteData.memories = websiteData.memories?.filter(m => m.id !== id) || [];
                loadMemoriesList();
                updateStats();
                showNotification('Memory deleted successfully!', 'success');
            }
        }

        function cancelMemory() {
            const memoryForm = document.getElementById('memoryForm');
            if (memoryForm) {
                memoryForm.style.display = 'none';
            }
        }

        // JOURNEY MANAGEMENT - FIXED VERSION
        function loadJourneyList() {
            const container = document.getElementById('journeyList');
            if (!container) return;
            
            container.innerHTML = '';
            
            if (!websiteData.journey || websiteData.journey.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; font-style: italic; padding: 20px;">No journey items added yet. Click "Add New Milestone" to get started.</p>';
                return;
            }
            
            websiteData.journey.forEach(item => {
                const journeyItem = document.createElement('div');
                journeyItem.className = 'item-card';
                journeyItem.innerHTML = `
                    <div class="item-info">
                        <img src="${item.img}" alt="${item.title}" class="item-img" onerror="this.src='https://via.placeholder.com/100?text=Journey'">
                        <div style="flex: 1;">
                            <h4 style="margin: 0; color: var(--admin-dark);">${item.title}</h4>
                            <p style="color: #666; font-size: 0.9rem; margin: 5px 0;">${item.date || 'No date'}</p>
                            <p style="color: #777; font-size: 0.9rem; margin: 0;">${(item.description || '').substring(0, 80)}...</p>
                        </div>
                    </div>
                    <div class="item-actions">
                        <button class="edit-btn" onclick="editJourney(${item.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="delete-btn" onclick="deleteJourney(${item.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                `;
                container.appendChild(journeyItem);
            });
        }

        function addNewJourney() {
            editingJourneyId = null;
            uploadedImageUrl = null;
            safeSetText('journeyFormTitle', 'Add New Milestone');
            
            const journeyForm = document.getElementById('journeyForm');
            if (journeyForm) {
                journeyForm.style.display = 'block';
            }
            
            safeSetValue('journey-title', '');
            safeSetValue('journey-date', new Date().toISOString().split('T')[0]);
            safeSetValue('journey-desc', '');
            safeSetSrc('journey-img-preview', '');
            
            const journeyProgress = document.getElementById('journey-progress');
            if (journeyProgress) {
                journeyProgress.style.display = 'none';
            }
            
            // Scroll to form
            if (journeyForm) {
                journeyForm.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function editJourney(id) {
            const item = websiteData.journey?.find(j => j.id === id);
            if (item) {
                editingJourneyId = id;
                uploadedImageUrl = item.img;
                safeSetText('journeyFormTitle', 'Edit Milestone');
                
                const journeyForm = document.getElementById('journeyForm');
                if (journeyForm) {
                    journeyForm.style.display = 'block';
                }
                
                safeSetValue('journey-title', item.title);
                safeSetValue('journey-date', item.date);
                safeSetValue('journey-desc', item.description);
                safeSetSrc('journey-img-preview', item.img);
                
                const journeyProgress = document.getElementById('journey-progress');
                if (journeyProgress) {
                    journeyProgress.style.display = 'none';
                }
                
                // Scroll to form
                if (journeyForm) {
                    journeyForm.scrollIntoView({ behavior: 'smooth' });
                }
            }
        }

        async function saveJourney() {
            const title = document.getElementById('journey-title')?.value;
            const date = document.getElementById('journey-date')?.value;
            const desc = document.getElementById('journey-desc')?.value;

            if (!title || !date) {
                showNotification('Please fill in all required fields', 'error');
                return;
            }

            let imageUrl = uploadedImageUrl;
            if (!imageUrl && editingJourneyId) {
                // Keep existing image if editing
                const existingItem = websiteData.journey?.find(j => j.id === editingJourneyId);
                imageUrl = existingItem ? existingItem.img : '';
            }

            if (!imageUrl) {
                showNotification('Please upload an image for the milestone', 'error');
                return;
            }

            if (editingJourneyId) {
                // Update existing journey item
                const index = websiteData.journey?.findIndex(j => j.id === editingJourneyId) || -1;
                if (index !== -1) {
                    // Delete old image if changed
                    if (websiteData.journey[index].img !== imageUrl && websiteData.journey[index].img.includes('uploads/')) {
                        await deleteImage(websiteData.journey[index].img);
                    }
                    
                    websiteData.journey[index] = {
                        id: editingJourneyId,
                        img: imageUrl,
                        title,
                        date,
                        description: desc
                    };
                }
            } else {
                // Add new journey item
                const newId = websiteData.journey && websiteData.journey.length > 0 ? 
                    Math.max(...websiteData.journey.map(j => j.id)) + 1 : 1;
                
                if (!websiteData.journey) {
                    websiteData.journey = [];
                }
                
                websiteData.journey.push({
                    id: newId,
                    img: imageUrl,
                    title,
                    date,
                    description: desc
                });
            }

            loadJourneyList();
            updateStats();
            
            const journeyForm = document.getElementById('journeyForm');
            if (journeyForm) {
                journeyForm.style.display = 'none';
            }
            
            showNotification('Milestone saved successfully!', 'success');
        }

        async function deleteJourney(id) {
            if (!confirm('Are you sure you want to delete this milestone?')) return;

            const item = websiteData.journey?.find(j => j.id === id);
            if (item) {
                // Delete image from server if it was uploaded
                if (item.img && item.img.includes('uploads/')) {
                    await deleteImage(item.img);
                }
                
                websiteData.journey = websiteData.journey?.filter(j => j.id !== id) || [];
                loadJourneyList();
                updateStats();
                showNotification('Milestone deleted successfully!', 'success');
            }
        }

        function cancelJourney() {
            const journeyForm = document.getElementById('journeyForm');
            if (journeyForm) {
                journeyForm.style.display = 'none';
            }
        }

        // PHOTOS MANAGEMENT
        function loadPhotosList() {
            const container = document.getElementById('photosList');
            if (!container) return;
            
            container.innerHTML = '';
            
            if (!websiteData.photos || websiteData.photos.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; font-style: italic; padding: 20px;">No photos added yet. Upload photos using the upload area above.</p>';
                return;
            }
            
            websiteData.photos.forEach((photo, index) => {
                const item = document.createElement('div');
                item.className = 'item-card';
                item.innerHTML = `
                    <div class="item-info">
                        <img src="${photo}" alt="Photo ${index + 1}" class="item-img" onerror="this.src='https://via.placeholder.com/100?text=Photo'">
                        <div style="flex: 1;">
                            <h4 style="margin: 0; color: var(--admin-dark);">Photo ${index + 1}</h4>
                            <p style="color: #666; font-size: 0.9rem; margin: 5px 0; word-break: break-all;">${photo.substring(0, 80)}...</p>
                        </div>
                    </div>
                    <div class="item-actions">
                        <button class="delete-btn" onclick="deletePhoto(${index})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        async function deletePhoto(index) {
            if (!confirm('Are you sure you want to delete this photo?')) return;

            const photoUrl = websiteData.photos?.[index];
            if (!photoUrl) return;
            
            // Delete from server if it was uploaded
            if (photoUrl.includes('uploads/')) {
                await deleteImage(photoUrl);
            }
            
            websiteData.photos.splice(index, 1);
            loadPhotosList();
            updateStats();
            showNotification('Photo deleted successfully!', 'success');
        }

        // Initialize
        window.onload = function() {
            // Load data when page loads
            loadFromConfig();
            
            // Set default tab as active
            openTab('dashboard');
        };
    </script>
</body>
</html>