<?php
require_once 'config.php';
session_start();

// Get car ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id === 0) {
    header("Location: index.php");
    exit();
}

// Fetch car details
$stmt = $pdo->prepare("SELECT * FROM images WHERE id = ?");
$stmt->execute([$id]);
$image = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$image) {
    header("Location: index.php?error=notfound");
    exit();
}

// Calculate total with quantity
$total = 0;
$quantity = 1;

if (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
    $quantity = (int) $_POST['quantity'];
    $_SESSION['quantity'] = $quantity;
} elseif (isset($_SESSION['quantity'])) {
    $quantity = $_SESSION['quantity'];
}

$total = $image['amount'] * $quantity;
$_SESSION['total'] = $total;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($image['car_make']) ?> <?= htmlspecialchars($image['car_model']) ?> - CarSwap</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --secondary: #f59e0b;
            --secondary-light: #fef3c7;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --gray: #64748b;
            --gray-light: #94a3b8;
            --gray-bg: #f1f5f9;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0,0,0,0.06);
            --shadow-hover: 0 12px 40px rgba(0,0,0,0.12);
            --radius: 20px;
            --radius-sm: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-bg);
            color: var(--dark);
            min-height: 100vh;
        }
        
        /* ========== NAVBAR ========== */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.97);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-custom .brand {
            font-weight: 900;
            font-size: 26px;
            color: white;
            text-decoration: none;
            letter-spacing: -1px;
        }
        
        .navbar-custom .brand span {
            color: var(--secondary);
        }
        
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.7) !important;
            font-weight: 500;
            font-size: 14px;
            transition: var(--transition);
            padding: 8px 16px !important;
            border-radius: 8px;
        }
        
        .navbar-custom .nav-link:hover {
            color: white !important;
            background: rgba(255,255,255,0.05);
        }
        
        .navbar-custom .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.08);
        }
        
        /* ========== BREADCRUMB ========== */
        .breadcrumb-custom {
            background: transparent;
            padding: 16px 0;
            margin: 0;
        }
        
        .breadcrumb-custom .breadcrumb-item a {
            color: var(--gray);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .breadcrumb-custom .breadcrumb-item a:hover {
            color: var(--primary);
        }
        
        .breadcrumb-custom .breadcrumb-item.active {
            color: var(--dark);
            font-weight: 600;
        }
        
        /* ========== MAIN CONTENT ========== */
        .details-wrapper {
            padding: 20px 0 60px;
        }
        
        /* Image Gallery */
        .image-gallery {
            position: relative;
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .image-gallery .main-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .image-gallery .main-image:hover {
            transform: scale(1.02);
        }
        
        .image-gallery .badge-top {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--secondary);
            color: var(--dark);
        }
        
        .image-gallery .badge-condition {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(10px);
            color: white;
        }
        
        .image-gallery .gallery-thumbs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            padding: 12px;
            background: #f8fafc;
        }
        
        .image-gallery .gallery-thumbs img {
            width: 100%;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }
        
        .image-gallery .gallery-thumbs img:hover {
            border-color: var(--primary);
            transform: scale(1.05);
        }
        
        /* Product Info Card */
        .product-card {
            background: white;
            border-radius: var(--radius);
            padding: 32px;
            box-shadow: var(--shadow);
            height: 100%;
        }
        
        .product-card .car-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 4px;
        }
        
        .product-card .car-subtitle {
            font-size: 16px;
            color: var(--gray);
            margin-bottom: 16px;
        }
        
        .product-card .car-subtitle i {
            color: var(--secondary);
        }
        
        .product-card .price-section {
            display: flex;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 20px;
            padding: 16px 20px;
            background: var(--primary-light);
            border-radius: var(--radius-sm);
        }
        
        .product-card .price-section .price {
            font-size: 36px;
            font-weight: 900;
            color: var(--primary);
        }
        
        .product-card .price-section .price-label {
            font-size: 14px;
            color: var(--gray);
        }
        
        /* Specifications */
        .specs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin: 20px 0;
        }
        
        .specs-grid .spec-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--gray-bg);
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }
        
        .specs-grid .spec-item:hover {
            background: var(--primary-light);
            transform: translateX(4px);
        }
        
        .specs-grid .spec-item i {
            color: var(--primary);
            font-size: 16px;
            width: 20px;
        }
        
        .specs-grid .spec-item .label {
            font-size: 12px;
            color: var(--gray);
            font-weight: 500;
        }
        
        .specs-grid .spec-item .value {
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
        }
        
        /* Swap Box */
        .swap-box {
            background: var(--secondary-light);
            border: 2px solid #fcd34d;
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            margin: 16px 0;
        }
        
        .swap-box .swap-label {
            font-size: 13px;
            font-weight: 700;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .swap-box .swap-details {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            margin-top: 8px;
        }
        
        .swap-box .swap-details .swap-item {
            display: flex;
            flex-direction: column;
        }
        
        .swap-box .swap-details .swap-item .swap-value {
            font-weight: 700;
            font-size: 16px;
            color: var(--dark);
        }
        
        .swap-box .swap-details .swap-item .swap-label-sm {
            font-size: 12px;
            color: #92400e;
        }
        
        /* Quantity & Cart */
        .quantity-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        
        .quantity-section label {
            font-weight: 600;
            font-size: 14px;
            color: var(--gray);
        }
        
        .quantity-section .qty-input {
            width: 80px;
            padding: 10px 12px;
            border: 2px solid #e2e8f0;
            border-radius: var(--radius-sm);
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            transition: var(--transition);
        }
        
        .quantity-section .qty-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 4px var(--primary-light);
        }
        
        .quantity-section .btn-update {
            padding: 10px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 14px;
            background: var(--dark);
            color: white;
            border: none;
            transition: var(--transition);
        }
        
        .quantity-section .btn-update:hover {
            background: var(--dark-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }
        
        .total-box {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac;
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            margin: 16px 0;
        }
        
        .total-box .total-label {
            font-size: 14px;
            color: var(--gray);
            font-weight: 500;
        }
        
        .total-box .total-amount {
            font-size: 32px;
            font-weight: 900;
            color: #16a34a;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }
        
        .action-buttons .btn {
            padding: 14px 24px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 16px;
            transition: var(--transition);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }
        
        .action-buttons .btn-cart {
            background: var(--primary);
            color: white;
        }
        
        .action-buttons .btn-cart:hover {
            background: var(--primary-dark);
        }
        
        .action-buttons .btn-whatsapp {
            background: #25d366;
            color: white;
        }
        
        .action-buttons .btn-whatsapp:hover {
            background: #1da851;
        }
        
        .action-buttons .btn-heart {
            background: #f1f5f9;
            color: var(--dark);
        }
        
        .action-buttons .btn-heart:hover {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .action-buttons .btn-heart i {
            transition: var(--transition);
        }
        
        .action-buttons .btn-heart:hover i {
            transform: scale(1.2);
        }
        
        /* ========== SOCIAL LOGIN GATE ========== */
        .social-gate-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(20px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .social-gate-overlay .gate-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 24px 80px rgba(0,0,0,0.4);
        }
        
        .social-gate-overlay .gate-card .lock-icon {
            width: 72px;
            height: 72px;
            background: rgba(245, 158, 11, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 2px solid rgba(245, 158, 11, 0.2);
        }
        
        .social-gate-overlay .gate-card .lock-icon i {
            font-size: 28px;
            color: var(--secondary);
        }
        
        .social-gate-overlay .gate-card h2 {
            color: white;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .social-gate-overlay .gate-card p {
            color: rgba(255,255,255,0.6);
            font-size: 15px;
            margin-bottom: 28px;
        }
        
        .social-gate-overlay .gate-card .car-preview {
            background: rgba(255,255,255,0.05);
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .social-gate-overlay .gate-card .car-preview img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            object-fit: cover;
        }
        
        .social-gate-overlay .gate-card .car-preview .preview-info {
            text-align: left;
        }
        
        .social-gate-overlay .gate-card .car-preview .preview-info .name {
            color: white;
            font-weight: 600;
        }
        
        .social-gate-overlay .gate-card .car-preview .preview-info .price {
            color: var(--secondary);
            font-weight: 700;
        }
        
        .social-gate-overlay .gate-card .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            color: rgba(255,255,255,0.15);
            font-size: 13px;
            margin: 20px 0;
        }
        
        .social-gate-overlay .gate-card .divider::before,
        .social-gate-overlay .gate-card .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }
        
        .social-gate-overlay .gate-card .social-btn {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: var(--transition);
            margin-bottom: 10px;
            text-decoration: none;
            cursor: pointer;
        }
        
        .social-gate-overlay .gate-card .social-btn.google {
            background: white;
            color: var(--dark);
        }
        
        .social-gate-overlay .gate-card .social-btn.google:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        
        .social-gate-overlay .gate-card .social-btn.apple {
            background: #1a1a1a;
            color: white;
            border: 1px solid rgba(255,255,255,0.1);
        }
        
        .social-gate-overlay .gate-card .social-btn.apple:hover {
            background: #2a2a2a;
            transform: translateY(-2px);
        }
        
        .social-gate-overlay .gate-card .social-btn.email {
            background: transparent;
            color: white;
            border: 1px solid rgba(255,255,255,0.12);
        }
        
        .social-gate-overlay .gate-card .social-btn.email:hover {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.2);
        }
        
        .social-gate-overlay .gate-card .terms {
            font-size: 12px;
            color: rgba(255,255,255,0.25);
            margin-top: 16px;
        }
        
        .social-gate-overlay .gate-card .terms a {
            color: rgba(255,255,255,0.4);
            text-decoration: none;
        }
        
        .social-gate-overlay .gate-card .terms a:hover {
            color: white;
        }
        
        /* ========== FOOTER ========== */
        .footer {
            background: white;
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
            margin-top: 40px;
        }
        
        .footer small {
            color: var(--gray);
            font-size: 13px;
        }
        
        .footer small a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .footer small a:hover {
            text-decoration: underline;
        }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .image-gallery .main-image {
                height: 350px;
            }
            
            .product-card .car-title {
                font-size: 26px;
            }
            
            .product-card .price-section .price {
                font-size: 28px;
            }
        }
        
        @media (max-width: 768px) {
            .details-wrapper {
                padding: 10px 0 40px;
            }
            
            .product-card {
                padding: 20px;
            }
            
            .image-gallery .main-image {
                height: 280px;
            }
            
            .specs-grid {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }
            
            .specs-grid .spec-item {
                padding: 8px 12px;
                font-size: 13px;
            }
            
            .social-gate-overlay .gate-card {
                padding: 32px 20px;
                margin: 16px;
            }
            
            .social-gate-overlay .gate-card h2 {
                font-size: 22px;
            }
            
            .action-buttons .btn {
                font-size: 14px;
                padding: 12px 20px;
            }
        }
        
        @media (max-width: 480px) {
            .image-gallery .main-image {
                height: 220px;
            }
            
            .product-card .car-title {
                font-size: 22px;
            }
            
            .product-card .price-section .price {
                font-size: 24px;
            }
            
            .product-card .price-section {
                padding: 12px 16px;
            }
            
            .specs-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .quantity-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .quantity-section .qty-input {
                width: 100%;
            }
            
            .total-box .total-amount {
                font-size: 24px;
            }
            
            .swap-box .swap-details {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>

<!-- ========== NAVBAR ========== -->
<nav class="navbar navbar-custom">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
            <a href="index.php" class="brand">Car<span>Swap</span></a>
            
            <ul class="nav d-none d-lg-flex">
                <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
            </ul>
            
            <div class="d-flex align-items-center gap-2">
                <a href="#" class="btn btn-sm btn-outline-light rounded-5 px-3">
                    <i class="fas fa-user"></i> Sign In
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- ========== SOCIAL LOGIN GATE (Uncomment for production) ========== -->
<?php  if (!isset($_SESSION['user_id'])): ?>
<div class="social-gate-overlay" id="socialGate">
    <div class="gate-card">
        <div class="lock-icon">
            <i class="fas fa-lock"></i>
        </div>
        <h2>Sign in to continue</h2>
        <p>View full details and contact the seller</p>
        
        <div class="car-preview">
            <img src="<?= htmlspecialchars($image['image_path']) ?>" alt="Car preview">
            <div class="preview-info">
                <div class="name"><?= htmlspecialchars($image['car_make']) ?> <?= htmlspecialchars($image['car_model']) ?></div>
                <div class="price">₦<?= number_format($image['amount']) ?></div>
            </div>
        </div>
        
        <a href="#" class="social-btn google">
            <i class="fab fa-google"></i> Continue with Google
        </a>
        <a href="#" class="social-btn apple">
            <i class="fab fa-apple"></i> Continue with Apple
        </a>
        <div class="divider">or</div>
        <a href="#" class="social-btn email">
            <i class="fas fa-envelope"></i> Sign in with Email
        </a>
        <p class="terms">By continuing, you agree to our <a href="#">Terms</a> &amp; <a href="#">Privacy Policy</a></p>
    </div>
</div>
<?php endif;  ?>

<!-- ========== MAIN CONTENT ========== -->
<div class="container details-wrapper">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-custom">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="index.php">Listings</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= htmlspecialchars($image['car_make']) ?> <?= htmlspecialchars($image['car_model']) ?>
            </li>
        </ol>
    </nav>
    
    <div class="row g-4">
        
        <!-- ===== LEFT COLUMN - IMAGE GALLERY ===== -->
        <div class="col-lg-6">
            <div class="image-gallery">
                <img src="<?= htmlspecialchars($image['image_path']) ?>" 
                     alt="<?= htmlspecialchars($image['car_make']) ?> <?= htmlspecialchars($image['car_model']) ?>" 
                     class="main-image" id="mainImage">
                
                <span class="badge-top">
                    <i class="fas fa-tag"></i> Available
                </span>
                <span class="badge-condition">
                    <i class="fas fa-check-circle"></i> <?= htmlspecialchars($image['car_condition']) ?>
                </span>
                
                <?php if (!empty($image['image_path2'])): ?>
                <div class="gallery-thumbs">
                    <img src="<?= htmlspecialchars($image['image_path']) ?>" 
                         alt="Thumb 1" onclick="changeImage(this.src)">
                    <img src="<?= htmlspecialchars($image['image_path2']) ?>" 
                         alt="Thumb 2" onclick="changeImage(this.src)">
                    <!-- Add more thumbnails if available -->
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- ===== RIGHT COLUMN - PRODUCT INFO ===== -->
        <div class="col-lg-6">
            <div class="product-card">
                
                <!-- Title -->
                <h1 class="car-title">
                    <?= htmlspecialchars($image['car_make']) ?> <?= htmlspecialchars($image['car_model']) ?>
                </h1>
                <div class="car-subtitle">
                    <i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($image['car_year']) ?> &bull; 
                    <i class="fas fa-palette"></i> <?= htmlspecialchars($image['car_color']) ?> &bull; 
                    <i class="fas fa-tachometer-alt"></i> <?= htmlspecialchars($image['car_condition']) ?>
                </div>
                
                <!-- Price -->
                <div class="price-section">
                    <span class="price">₦<?= number_format($image['amount']) ?></span>
                    <span class="price-label">(Negotiable)</span>
                </div>
                
                <!-- Specifications -->
                <div class="specs-grid">
                    <div class="spec-item">
                        <i class="fas fa-car"></i>
                        <div>
                            <div class="label">Make</div>
                            <div class="value"><?= htmlspecialchars($image['car_make']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-cog"></i>
                        <div>
                            <div class="label">Model</div>
                            <div class="value"><?= htmlspecialchars($image['car_model']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-calendar"></i>
                        <div>
                            <div class="label">Year</div>
                            <div class="value"><?= htmlspecialchars($image['car_year']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-palette"></i>
                        <div>
                            <div class="label">Color</div>
                            <div class="value"><?= htmlspecialchars($image['car_color']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-barcode"></i>
                        <div>
                            <div class="label">VIN</div>
                            <div class="value"><?= htmlspecialchars($image['car_vin']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-tag"></i>
                        <div>
                            <div class="label">Type</div>
                            <div class="value"><?= htmlspecialchars($image['car_type']) ?: 'N/A' ?></div>
                        </div>
                    </div>
                </div>
                
                <!-- Swap Wanted -->
                <?php if (!empty($image['swap_model'])): ?>
                <div class="swap-box">
                    <div class="swap-label">
                        <i class="fas fa-exchange-alt"></i> Wants to swap for
                    </div>
                    <div class="swap-details">
                        <div class="swap-item">
                            <span class="swap-value"><?= htmlspecialchars($image['swap_make']) ?> <?= htmlspecialchars($image['swap_model']) ?></span>
                            <span class="swap-label-sm">Model</span>
                        </div>
                        <div class="swap-item">
                            <span class="swap-value"><?= htmlspecialchars($image['swap_year']) ?></span>
                            <span class="swap-label-sm">Year</span>
                        </div>
                        <div class="swap-item">
                            <span class="swap-value"><?= htmlspecialchars($image['swap_color']) ?></span>
                            <span class="swap-label-sm">Color</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Description -->
                <?php if (!empty($image['description'])): ?>
                <div class="mt-3">
                    <h6 style="font-weight:700; font-size:14px; color:var(--gray); text-transform:uppercase; letter-spacing:0.5px;">
                        <i class="fas fa-align-left"></i> Description
                    </h6>
                    <p style="color:var(--gray); line-height:1.7; font-size:14px;">
                        <?= nl2br(htmlspecialchars($image['description'])) ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <hr>
                
                <!-- Quantity & Total -->
                <form method="POST" action="?id=<?= $id ?>">
                    <div class="quantity-section">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" 
                               class="qty-input" value="<?= $quantity ?>" min="1" max="99">
                        <button type="submit" class="btn-update">
                            <i class="fas fa-sync-alt"></i> Update
                        </button>
                    </div>
                </form>
                
                <div class="total-box">
                    <div class="total-label">Total Price</div>
                    <div class="total-amount">₦<?= number_format($_SESSION['total'] ?? $image['amount']) ?></div>
                </div>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="cart.php?id=<?= $image['id'] ?>" class="btn btn-cart">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </a>
                    <a href="https://wa.me/2348119549038?text=Hi%2C%20I'm%20interested%20in%20the%20<?= urlencode($image['car_make'] . ' ' . $image['car_model']) ?>" 
                       target="_blank" class="btn btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> Buy via WhatsApp
                    </a>
                    <button class="btn btn-heart" onclick="toggleWishlist(this)">
                        <i class="far fa-heart"></i> Save to Wishlist
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- ========== FOOTER ========== -->
<footer class="footer d-flex flex-wrap align-items-center">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <small>&copy; <?= date('Y') ?> CarSwap. All rights reserved.</small>
            <small>Powered by <a href="#" target="_blank">CarSwap</a></small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// ========== IMAGE GALLERY ==========
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

// ========== WISHLIST ==========
function toggleWishlist(btn) {
    const icon = btn.querySelector('i');
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        btn.style.background = '#fee2e2';
        btn.style.color = '#dc2626';
        showToast('Added to wishlist! ❤️');
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        btn.style.background = '#f1f5f9';
        btn.style.color = 'var(--dark)';
        showToast('Removed from wishlist');
    }
}

// ========== TOAST NOTIFICATION ==========
function showToast(message) {
    const existing = document.querySelector('.toast-custom');
    if (existing) existing.remove();
    
    const toast = document.createElement('div');
    toast.className = 'toast-custom';
    toast.innerHTML = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--dark);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        z-index: 9999;
        animation: slideIn 0.5s ease;
        font-family: 'Inter', sans-serif;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100px)';
        toast.style.transition = '0.5s';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// ========== KEYBOARD SHORTCUTS ==========
document.addEventListener('keydown', function(e) {
    // Escape key to close modals
    if (e.key === 'Escape') {
        const gate = document.getElementById('socialGate');
        if (gate) gate.style.display = 'none';
    }
    
    // Arrow keys for gallery navigation (if thumbnails exist)
    if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
        const thumbs = document.querySelectorAll('.gallery-thumbs img');
        if (thumbs.length > 0) {
            const current = document.querySelector('.gallery-thumbs img[style*="border-color: var(--primary)"]');
            let index = 0;
            if (current) {
                index = Array.from(thumbs).indexOf(current);
            }
            if (e.key === 'ArrowRight') {
                index = (index + 1) % thumbs.length;
            } else {
                index = (index - 1 + thumbs.length) % thumbs.length;
            }
            changeImage(thumbs[index].src);
            thumbs.forEach(t => t.style.borderColor = 'transparent');
            thumbs[index].style.borderColor = 'var(--primary)';
        }
    }
});

// ========== AUTO-CLOSE SOCIAL GATE (demo) ==========
// Uncomment to auto-close gate after 2 seconds (for testing)
/*
setTimeout(() => {
    const gate = document.getElementById('socialGate');
    if (gate) gate.style.display = 'none';
}, 2000);
*/
</script>

<style>
    /* Toast animation */
    @keyframes slideIn {
        from { transform: translateX(100px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }
    
    /* Number input arrows */
    .qty-input::-webkit-inner-spin-button,
    .qty-input::-webkit-outer-spin-button {
        opacity: 1;
        height: 30px;
    }
</style>

</body>
</html>