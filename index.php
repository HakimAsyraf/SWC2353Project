<?php
$page_title = "Home";
require_once 'header.php';
?>

    <!-- Hero Section -->
    <div class="container">
        <h1>Your 24/7 Needed Equipment</h1>
        <p>Quality equipment rentals for all your needs, available whenever you need them</p>
        <a href="admin.php" class="button">Start Borrowing</a>
    </div>

    <!-- Features Section -->
    <div class="container">
        <h2>Why Choose EquipmentSphere?</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div style="background: white; padding: 20px; border-radius: 8px;">
                <h3>24/7 Service</h3>
                <p>We'll be there for you. Same day or next day delivery? We've got you covered</p>
            </div>
            <div style="background: white; padding: 20px; border-radius: 8px;">
                <h3>Affordable</h3>
                <p>Transparent pricing, no hidden costs. Multiple payment options available</p>
            </div>
            <div style="background: white; padding: 20px; border-radius: 8px;">
                <h3>Variety of Choices</h3>
                <p>Select any items that suits your needs from our extensive inventory</p>
            </div>
            <div style="background: white; padding: 20px; border-radius: 8px;">
                <h3>Real-time Tracking</h3>
                <p>Track your equipment with no issues and know exactly when it will arrive</p>
            </div>
        </div>
    </div>

<?php require_once 'footer.php'; ?>
