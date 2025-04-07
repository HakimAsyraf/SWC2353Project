<?php
// Start session and connect to database
require_once 'config.php';

// Fetch featured equipment from database
$featuredItems = [];
try {
    $stmt = $conn->prepare("SELECT * FROM equipment WHERE featured = 1 LIMIT 4");
    $stmt->execute();
    $featuredItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EquipmentSphere - Your 24/7 Equipment Solution</title>
    <style>
        /* Main Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        
        /* Navigation */
        .navbar {
            background-color: #2c3e50;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #e67e22;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('images/equipment-hero.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        
        .hero h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        
        /* Features Section */
        .features {
            padding: 60px 20px;
            text-align: center;
            background-color: #f9f9f9;
        }
        
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: #e67e22;
            margin-bottom: 20px;
        }
        
        /* Featured Equipment */
        .equipment {
            padding: 60px 20px;
            text-align: center;
        }
        
        .equipment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 40px auto;
        }
        
        .equipment-card {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.3s;
        }
        
        .equipment-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .equipment-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .equipment-info {
            padding: 20px;
        }
        
        /* Footer */
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: white;
            text-decoration: none;
        }
        
        .social-links {
            margin-top: 20px;
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.2rem;
        }
        
        .copyright {
            margin-top: 20px;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.7);
        }
        
        /* Button */
        .btn {
            display: inline-block;
            background-color: #e67e22;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #d35400;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="index.php" class="logo">EquipmentSphere</a>
        <div class="nav-links">
            <a href="about.php">About Us</a>
            <a href="features.php">Features Item</a>
            <a href="contact.php">Contact</a>
            <a href="signup.php">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Your 24/7 Needed Equipment</h1>
        <p>Quality equipment rentals for all your needs, available whenever you need them</p>
        <a href="signup.php" class="btn">Start Borrowing</a>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2>Why Choose EquipmentSphere?</h2>
        <div class="features-container">
            <div class="feature-card">
                <div class="feature-icon">⏰</div>
                <h3>24/7 Service</h3>
                <p>We'll be there for you. Same day or next day delivery? We've got you covered</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Affordable</h3>
                <p>Transparent pricing, no hidden costs. Multiple payment options available</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🛠️</div>
                <h3>Variety of Choices</h3>
                <p>Select any items that suits your needs from our extensive inventory</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📍</div>
                <h3>Real-time Tracking</h3>
                <p>Track your equipment with no issues and know exactly when it will arrive</p>
            </div>
        </div>
    </section>

    <!-- Featured Equipment (Dynamic from database) -->
    <section class="equipment">
        <h2>Featured Equipment</h2>
        <div class="equipment-grid">
            <?php if (!empty($featuredItems)): ?>
                <?php foreach ($featuredItems as $item): ?>
                    <div class="equipment-card">
                        <img src="<?php echo htmlspecialchars($item['image_url'] ?? 'images/default-equipment.jpg'); ?>" 
                             alt="<?php echo htmlspecialchars($item['name']); ?>" 
                             class="equipment-img">
                        <div class="equipment-info">
                            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p><?php echo htmlspecialchars($item['short_description']); ?></p>
                            <a href="equipment-details.php?id=<?php echo $item['id']; ?>" class="btn">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No featured equipment available at this time.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-links">
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms of Service</a>
        </div>
        
        <div>
            <select aria-label="Language selector">
                <option>English</option>
                <option>Español</option>
                <option>Français</option>
            </select>
        </div>
        
        <div class="social-links">
            <a href="#" aria-label="Facebook">📘</a>
            <a href="#" aria-label="Twitter">🐦</a>
            <a href="#" aria-label="Instagram">📷</a>
        </div>
        
        <p class="copyright">© EquipmentSphere <?php echo date('Y'); ?>. All Rights Reserved.</p>
    </footer>
</body>
</html>
