<?php
session_start();
require_once 'config.php';

$search = $_GET['search'] ?? "";
$sql = "SELECT * FROM images WHERE 
    (car_color LIKE '%$search%' OR 
     car_condition LIKE '%$search%' OR 
     car_model LIKE '%$search%' OR 
     car_vin LIKE '%$search%' OR 
     swap_color LIKE '%$search%') 
    ORDER BY upload_date DESC";
$stmt = $pdo->query($sql);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['username'] = $user["username"];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarSwap - Swap Your Dream Car</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #f59e0b;
            --dark: #0f172a;
            --dark-light: #1e293b;
            --gray: #64748b;
            --light: #f8fafc;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #0f172a;
        }
        
        /* ========== NAVBAR ========== */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-custom .brand {
            font-weight: 800;
            font-size: 28px;
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
            transition: 0.3s;
            padding: 8px 16px !important;
        }
        
        .navbar-custom .nav-link:hover {
            color: white !important;
        }
        
        .navbar-custom .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
        }
        
        .search-form {
            position: relative;
        }
        
        .search-form input {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            width: 280px;
            font-size: 14px;
            transition: 0.3s;
        }
        
        .search-form input::placeholder {
            color: rgba(255,255,255,0.4);
        }
        
        .search-form input:focus {
            background: rgba(255,255,255,0.12);
            border-color: var(--secondary);
            outline: none;
        }
        
        .search-form button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--secondary);
            border: none;
            color: #0f172a;
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            transition: 0.3s;
        }
        
        .search-form button:hover {
            background: #d97706;
            color: white;
        }
        
        .btn-auth {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
            text-decoration: none;
        }
        
        .btn-login {
            background: transparent;
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .btn-login:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        
        .btn-register {
            background: var(--secondary);
            color: #0f172a;
            border: none;
        }
        
        .btn-register:hover {
            background: #d97706;
            color: #0f172a;
        }
        
        /* ========== HERO SECTION ========== */
        .hero-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            padding: 80px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .hero-section .hero-badge {
            display: inline-block;
            background: rgba(245, 158, 11, 0.15);
            color: var(--secondary);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        
        .hero-section h1 {
            font-size: 56px;
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 16px;
        }
        
        .hero-section h1 span {
            color: var(--secondary);
        }
        
        .hero-section p {
            color: rgba(255,255,255,0.7);
            font-size: 18px;
            max-width: 500px;
            line-height: 1.6;
        }
        
        .hero-search-box {
            background: white;
            padding: 8px;
            border-radius: 60px;
            display: flex;
            gap: 8px;
            max-width: 500px;
            margin-top: 30px;
        }
        
        .hero-search-box input {
            flex: 1;
            border: none;
            padding: 14px 24px;
            border-radius: 50px;
            font-size: 15px;
            outline: none;
        }
        
        .hero-search-box button {
            background: var(--secondary);
            border: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            color: #0f172a;
            transition: 0.3s;
        }
        
        .hero-search-box button:hover {
            background: #d97706;
            transform: scale(1.02);
        }
        
        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 40px;
        }
        
        .hero-stats .stat {
            color: white;
        }
        
        .hero-stats .stat .number {
            font-size: 28px;
            font-weight: 800;
            color: var(--secondary);
        }
        
        .hero-stats .stat .label {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
        }
        
        /* ========== FILTER BAR ========== */
        .filter-bar {
            background: white;
            padding: 16px 24px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            margin-top: -40px;
            position: relative;
            z-index: 10;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }
        
        .filter-bar .filter-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .filter-bar select {
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            background: #f8fafc;
            cursor: pointer;
        }
        
        .filter-bar .results-count {
            font-size: 14px;
            color: var(--gray);
        }
        
        /* ========== CARDS GRID ========== */
        .cards-section {
            padding: 40px 0 60px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .section-header h2 {
            font-weight: 700;
            font-size: 28px;
        }
        
        .section-header .view-all {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        .car-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        }
        
        .car-card .card-image-wrapper {
            position: relative;
            padding-top: 66%;
            background: #f1f5f9;
            overflow: hidden;
        }
        
        .car-card .card-image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }
        
        .car-card:hover .card-image-wrapper img {
            transform: scale(1.05);
        }
        
        .car-card .card-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(5px);
            color: white;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .car-card .card-swap-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: var(--secondary);
            color: #0f172a;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
        }
        
        .car-card .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .car-card .card-title {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 4px;
        }
        
        .car-card .card-subtitle {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 12px;
        }
        
        .car-card .card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 16px;
            margin-bottom: 12px;
            font-size: 13px;
        }
        
        .car-card .card-details .detail {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--gray);
        }
        
        .car-card .card-details .detail i {
            color: var(--secondary);
            font-size: 12px;
        }
        
        .car-card .card-price {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            margin: 8px 0 12px;
        }
        
        .car-card .card-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
        }
        
        .car-card .card-actions .btn {
            flex: 1;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            padding: 10px;
        }
        
        .car-card .card-actions .btn-primary {
            background: var(--primary);
            border: none;
        }
        
        .car-card .card-actions .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .car-card .card-actions .btn-outline {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: var(--gray);
        }
        
        .car-card .card-actions .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .car-card .upload-date {
            font-size: 11px;
            color: var(--gray);
            margin-top: 8px;
        }
        
        /* ========== SWAP INDICATOR ========== */
        .swap-section {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 10px;
            margin: 8px 0 12px;
            border: 1px dashed #e2e8f0;
        }
        
        .swap-section .swap-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .swap-section .swap-details {
            font-size: 13px;
            color: var(--gray);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        
        /* ========== EMPTY STATE ========== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-state i {
            font-size: 64px;
            color: #e2e8f0;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .empty-state p {
            color: var(--gray);
        }
        
        /* ========== FOOTER ========== */
        .footer {
            background: #0f172a;
            color: rgba(255,255,255,0.6);
            padding: 40px 0 20px;
            margin-top: 40px;
        }
        
        .footer .footer-brand {
            font-size: 24px;
            font-weight: 800;
            color: white;
        }
        
        .footer .footer-brand span {
            color: var(--secondary);
        }
        
        .footer .footer-links {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .footer .footer-links a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        
        .footer .footer-links a:hover {
            color: white;
        }
        
        .footer .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-top: 20px;
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
        }
        
        /* ========== MODAL STYLES ========== */
        .modal-content {
            background: #0f172a;
            color: white;
            border: 1px solid rgba(255,255,255,0.05);
        }
        
        .modal-content .modal-header {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .modal-content .form-control {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            padding: 12px 16px;
        }
        
        .modal-content .form-control:focus {
            background: rgba(255,255,255,0.08);
            border-color: var(--secondary);
        }
        
        .modal-content .form-control::placeholder {
            color: rgba(255,255,255,0.3);
        }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .hero-section h1 {
                font-size: 40px;
            }
            
            .search-form input {
                width: 200px;
            }
            
            .navbar-custom .nav-link {
                padding: 8px 12px !important;
                font-size: 13px;
            }
            
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0 80px;
                text-align: center;
            }
            
            .hero-section p {
                margin: 0 auto;
            }
            
            .hero-search-box {
                flex-direction: column;
                border-radius: 16px;
                background: transparent;
                padding: 0;
            }
            
            .hero-search-box input {
                border-radius: 50px;
            }
            
            .hero-search-box button {
                border-radius: 50px;
            }
            
            .hero-stats {
                justify-content: center;
            }
            
            .navbar-custom .brand {
                font-size: 22px;
            }
            
            .search-form input {
                width: 160px;
                font-size: 13px;
                padding: 8px 14px;
            }
            
            .section-header h2 {
                font-size: 22px;
            }
        }
        
        @media (max-width: 576px) {
            .hero-section h1 {
                font-size: 30px;
            }
            
            .car-card .card-details {
                grid-template-columns: 1fr 1fr;
                font-size: 12px;
            }
            
            .car-card .card-price {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<!-- ========== NAVBAR ========== -->
<nav class="navbar-custom">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <!-- Brand -->
            <a href="#" class="brand">Car<span>Swap</span></a>
            
            <!-- Search -->
            <form method="get" class="search-form">
                <input type="text" name="search" placeholder="Search cars, models..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
            </form>
            
            <!-- Nav Links -->
            <ul class="nav d-none d-lg-flex">
                <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
            </ul>
            
            <!-- Auth Buttons -->
            <div class="d-flex gap-2">
                <button class="btn-auth btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fas fa-sign-in-alt"></i> Log In
                </button>
                <button class="btn-auth btn-register" data-bs-toggle="modal" data-bs-target="#regModal">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- ========== HERO SECTION ========== -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="fas fa-exchange-alt"></i> Swap Marketplace
                </div>
                <h1>Find Your <span>Dream Car</span> & Swap Today</h1>
                <p>Browse thousands of cars available for swap. List your car and get the perfect match.</p>
                
                <form method="get" class="hero-search-box">
                    <input type="text" name="search" placeholder="Search by model, make, or color..." value="<?= htmlspecialchars($search) ?>">
                    <button type="submit"><i class="fas fa-arrow-right"></i> Search</button>
                </form>
                
                <div class="hero-stats">
                    <div class="stat">
                        <div class="number"><?= count($images) ?></div>
                        <div class="label">Listings Available</div>
                    </div>
                    <div class="stat">
                        <div class="number">1.2k+</div>
                        <div class="label">Happy Swaps</div>
                    </div>
                    <div class="stat">
                        <div class="number">98%</div>
                        <div class="label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <!-- Hero image or illustration can go here -->
                 <img src="images/ferrari.gif" alt="a car"/>
            </div>
        </div>
    </div>
</section>

<!-- ========== FILTER BAR ========== -->
<div class="container">
    <div class="filter-bar">
        <div class="filter-group">
            <select>
                <option>All Conditions</option>
                <option>New</option>
                <option>Used</option>
                <option>Certified Pre-Owned</option>
            </select>
            <select>
                <option>All Years</option>
                <option>2020-2025</option>
                <option>2015-2019</option>
                <option>2010-2014</option>
            </select>
            <select>
                <option>All Colors</option>
                <option>Black</option>
                <option>White</option>
                <option>Red</option>
                <option>Blue</option>
            </select>
        </div>
        <div class="results-count">
            <i class="fas fa-car"></i> <?= count($images) ?> results found
        </div>
    </div>
</div>

<!-- ========== CARDS SECTION ========== -->
<section class="cards-section">
    <div class="container">
        <div class="section-header">
            <h2>Available for Swap</h2>
            <a href="#" class="view-all">View all <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div class="row g-4">
            <?php if (count($images) > 0): ?>
                <?php foreach ($images as $image): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="car-card">
                            <!-- Image -->
                            <div class="card-image-wrapper">
                                <img src="<?= htmlspecialchars($image['image_path']) ?>" alt="<?= htmlspecialchars($image['car_model']) ?>">
                                <span class="card-badge"><i class="fas fa-tag"></i> <?= htmlspecialchars($image['car_condition']) ?></span>
                                <span class="card-swap-badge"><i class="fas fa-exchange-alt"></i> Swap</span>
                            </div>
                            
                            <div class="card-body">
                                <!-- Title -->
                                <div class="card-title"><?= htmlspecialchars($image['car_make']) ?> <?= htmlspecialchars($image['car_model']) ?></div>
                                <div class="card-subtitle"><?= htmlspecialchars($image['car_year']) ?> • <?= htmlspecialchars($image['car_color']) ?></div>
                                
                                <!-- Details -->
                                <div class="card-details">
                                    <span class="detail"><i class="fas fa-palette"></i> <?= htmlspecialchars($image['car_color']) ?></span>
                                    <span class="detail"><i class="fas fa-calendar"></i> <?= htmlspecialchars($image['car_year']) ?></span>
                                    <span class="detail"><i class="fas fa-barcode"></i> <?= substr(htmlspecialchars($image['car_vin']), -6) ?></span>
                                    <span class="detail"><i class="fas fa-tachometer-alt"></i> Good</span>
                                </div>
                                
                                <!-- Price -->
                                <div class="card-price">₦<?= number_format(htmlspecialchars($image['amount'])) ?></div>
                                
                                <!-- Swap Wanted -->
                                <?php if (!empty($image['swap_model'])): ?>
                                    <div class="swap-section">
                                        <div class="swap-label"><i class="fas fa-exchange-alt"></i> Wants to swap for:</div>
                                        <div class="swap-details">
                                            <span><?= htmlspecialchars($image['swap_make']) ?> <?= htmlspecialchars($image['swap_model']) ?></span>
                                            <span><?= htmlspecialchars($image['swap_year']) ?></span>
                                            <span><?= htmlspecialchars($image['swap_color']) ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Actions -->
                                <div class="card-actions">
                                    <a href="details.php?id=<?= $image['id'] ?>" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="delete.php?id=<?= $image['id'] ?>" class="btn btn-outline" onclick="return confirm('Delete this listing?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                
                                <div class="upload-date">
                                    <i class="far fa-clock"></i> Posted <?= date('M d, Y', strtotime($image['upload_date'])) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-car"></i>
                        <h3><?= isset($_GET['search']) ? 'No results found' : 'No listings yet' ?></h3>
                        <p><?= isset($_GET['search']) ? 'Try adjusting your search terms' : 'Be the first to list your car for swap!' ?></p>
                        <?php if (isset($_GET['search'])): ?>
                            <a href="?" class="btn btn-primary">Clear search</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ========== FOOTER ========== -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="footer-brand">Car<span>Swap</span></div>
                <p style="font-size: 14px; margin-top: 8px;">Swap your car with ease. Join our community today.</p>
            </div>
            <div class="col-md-8">
                <div class="footer-links justify-content-md-end">
                    <a href="#">Home</a>
                    <a href="#">Shop</a>
                    <a href="#">FAQs</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?= date('Y') ?> CarSwap. All rights reserved.
        </div>
    </div>
</footer>

<!-- ========== LOGIN MODAL ========== -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-sign-in-alt"></i> Welcome Back</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Log In</button>
                    <div class="text-center mt-3">
                        <a href="#" style="color: rgba(255,255,255,0.5); font-size: 14px;">Forgot password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ========== REGISTER MODAL ========== -->
<div class="modal fade" id="regModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-plus"></i> Create Account</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="register.php">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Create a strong password" required>
                    </div>
                    <button type="submit" class="btn btn-register w-100 text-dark">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Optional: Animate on scroll -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Any interactive JS here
        console.log('CarSwap loaded successfully!');
    });
</script>
</body>
</html>