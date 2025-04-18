<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Sales Form</title>
    <style>
        :root {
            --primary: #5E60CE;
            --secondary: #6930C3;
            --accent: #7400B8;
            --text: #2b2b2b;
            --background: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            padding: 2rem;
        }

        .form-container {
            background: white;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 600px;
            transform: translateY(0);
            animation: formEntrance 0.6s ease-out;
        }

        @keyframes formEntrance {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .form-title {
            color: var(--accent);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 500;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.8rem 1.2rem;
            border: 2px solid #e0e0e0;
            border-radius: 0.8rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 96, 206, 0.2);
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            background: var(--background);
            border-radius: 0.8rem;
            padding: 1rem;
            text-align: center;
            border: 2px dashed #e0e0e0;
        }

        .file-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
        }

        .payment-instructions {
            background: #f3f1ff;
            padding: 1rem;
            border-radius: 0.8rem;
            margin-top: 0.5rem;
            display: none;
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 0.8rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(94, 96, 206, 0.3);
        }

        .file-preview {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 1rem;
            color: var(--primary);
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 1.5rem;
            }
            
            .form-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1 class="form-title">Sell Your Item</h1>
        <form class="sales-form" method="post" action="products.php" id="salesForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Item Title</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="paymentType">Payment Method</label>
                <select id="paymentType" name="paymentType" required>
                    <option value="">Select Payment Method</option>
                    <option value="upi">UPI</option>
                    <option value="bank">Bank Transfer</option>
                </select>
                <div class="payment-instructions" id="paymentInstructions"></div>
                <input type="text" id="paymentDetails" name="paymentDetails" placeholder="enter UPI ID or Bank Details">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>Document Upload (required)</label>
                <div class="file-upload">
                    <input type="file" id="fileUpload" name="fileUpload" accept=".jpg,.jpeg,.png,.pdf,.zip,.doc,.docx" required>
                    <span>Click to upload files (image, pdf, zip, doc)</span>
                    <div class="file-preview" id="docPreview"></div>
                </div>
            </div>

            <div class="form-group">
                <label>Video Upload (optional)</label>
                <div class="file-upload">
                    <input type="file" id="videoUpload" name="videoUpload" accept="video/*">
                    <span>Click to upload video</span>
                    <div class="file-preview" id="videoPreview"></div>
                </div>
            </div>

            <div class="form-group">
                <label for="price">Price (₹)</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <button type="submit" class="submit-btn">Sell Now</button>
            <div class="loading">Processing...</div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const paymentType = document.getElementById('paymentType');
            const paymentInstructions = document.getElementById('paymentInstructions');
            const docInput = document.getElementById('fileUpload');
            const videoInput = document.getElementById('videoUpload');
            const docPreview = document.getElementById('docPreview');
            const videoPreview = document.getElementById('videoPreview');
            const form = document.getElementById('salesForm');
            const loading = document.querySelector('.loading');

            // Payment instructions handler
            paymentType.addEventListener('change', () => {
                const value = paymentType.value;
                paymentInstructions.style.display = 'block';
                paymentInstructions.innerHTML = value === 'upi' 
                    ? 'Please provide your UPI ID: example@upi in payment Details' 
                    : 'Bank Details: Account Name, Account Number, IFSC Code in payment Details';
            });

            // File preview handlers
            docInput.addEventListener('change', () => {
                docPreview.textContent = `${docInput.files.length} document(s) selected`;
            });

            videoInput.addEventListener('change', () => {
                if(videoInput.files.length > 0) {
                    videoPreview.textContent = videoInput.files[0].name;
                }
            });
        });
    </script>
</body>
</html>