<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Product Listing Portal</title>
    <style>
        /* Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #5E60CE, #6930C3, #7400B8);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* Container & Typography */
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .text-center {
            text-align: center;
            margin-bottom: 2rem;
        }

        h1, h3, h4 {
            color: #fff;
            margin-bottom: 1rem;
        }

        /* Card Styles */
        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #5E60CE, #6930C3);
            color: #fff;
            font-size: 1.3rem;
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #4a4a4a;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #5E60CE;
            outline: none;
        }

        /* Image Preview */
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .image-preview {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Upload Zone */
        .upload-zone {
            border: 3px dashed rgba(94, 96, 206, 0.5);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .upload-zone:hover {
            border-color: #5E60CE;
            background: rgba(255, 255, 255, 1);
        }

        /* Video Upload Section */
        #videoUploadSection {
            margin-top: 1.5rem;
            transition: all 0.3s ease;
        }

        .hidden {
            display: none;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5E60CE, #6930C3, #7400B8);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <h1>Digital Product Listing</h1>
            <p style="color: #fff;">Create your digital product listing below</p>
        </div>

        <form id="productForm" action="selling.php" method="POST" enctype="multipart/form-data">
            <!-- Product Media Section -->
            <div class="card">
                <div class="card-header">
                    <h3>Product Media</h3>
                </div>
                <div class="card-body">
                    <div class="upload-zone" id="uploadZone">
                        <div style="color: #666;">
                            <p style="font-size: 2rem;">&#8679;</p>
                            <p>Drag & drop files or click to upload</p>
                            <small>(Max 5 images, PNG/JPG format)</small>
                        </div>
                    </div>
                    <input type="file" name="productImages[]" id="fileInput" hidden multiple accept="image/*">
                    <div class="image-preview-container" id="imagePreview"></div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="card">
                <div class="card-header">
                    <h3>Product Information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Product Title</label>
                        <input type="text" class="form-control" name="productTitle" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select class="form-select" name="category" required>
                            <option>Social Media Account</option>
                            <option>Game Account</option>
                            <option>PDF Document</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Platform</label>
                        <select class="form-select" name="platform" id="platformSelect" required>
                            <option>Facebook</option>
                            <option>Instagram</option>
                            <option>FreeFire</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" step="0.01" name="price" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" name="description" required></textarea>
                    </div>

                    <!-- Conditional Video Upload -->
                    <div id="videoUploadSection" class="hidden">
                        <div class="form-group">
                            <label class="form-label">Verification Video</label>
                            <input type="file" class="form-control" 
                                   accept="video/mp4" 
                                   name="proofVideo" 
                                   id="videoInput" notrequired>
                            <small class="form-text">MP4 format, 10-30 seconds duration (required for social media)</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Publish Listing</button>
            </div>
        </form>
    </div>

    <script>
        // Image Upload Handling
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');

        // Handle click on upload zone
        uploadZone.addEventListener('click', () => fileInput.click());

        // Handle file selection
        fileInput.addEventListener('change', function(e) {
            imagePreview.innerHTML = '';
            const files = Array.from(e.target.files).slice(0, 5);
            
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = 'image-preview';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    
                    div.appendChild(img);
                    imagePreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        // Platform Change Handler
        const platformSelect = document.getElementById('platformSelect');
        const videoSection = document.getElementById('videoUploadSection');
        const videoInput = document.getElementById('videoInput');

        const socialMediaPlatforms = ['Facebook', 'Instagram'];

        function handlePlatformChange() {
            if (socialMediaPlatforms.includes(platformSelect.value)) {
                videoSection.classList.remove('hidden');
                videoInput.setAttribute('required', 'required');
            } else {
                videoSection.classList.add('hidden');
                videoInput.removeAttribute('required');
                videoInput.value = ''; // Clear existing selection
            }
        }

        // Initial check
        handlePlatformChange();

        // Event listener for platform changes
        platformSelect.addEventListener('change', handlePlatformChange);

        // Video Validation
        videoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const video = document.createElement('video');
            video.preload = 'metadata';
            
            video.onloadedmetadata = () => {
                if (video.duration < 10 || video.duration > 30) {
                    alert('Video must be between 10-30 seconds');
                    e.target.value = '';
                }
            };
            
            video.src = URL.createObjectURL(file);
        });
    </script>
</body>
</html>