<?php
$page_title = "Contact Us";
require_once 'header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);
    
    // Process the form (save to database or send email)
    $success = true; // Change this to actual processing result
    
    if ($success) {
        $success_message = "Thank you, $name! We'll contact you soon.";
    }
}
?>

<div class="content-section" style="max-width: 800px; margin: 40px auto; padding: 40px;">
    <h1 style="color: #e67e22; text-align: center; margin-bottom: 30px;">CONTACT US</h1>
    
    <?php if (isset($success_message)): ?>
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <?php echo $success_message; ?>
    </div>
    <?php endif; ?>
    
    <form method="POST" style="margin-top: 30px;">
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Name</label>
            <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Email</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Phone</label>
            <input type="tel" name="phone" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Message</label>
            <textarea name="message" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; min-height: 150px;"></textarea>
        </div>
        
        <button type="submit" class="btn" style="width: 100%; padding: 12px; font-size: 16px;">SEND MESSAGE</button>
    </form>
    
    <div style="margin-top: 40px;">
        <h2 style="color: #2c3e50;">OUR LOCATION</h2>
        <p>123 Equipment Street, Tech City, TC 12345</p>
        <p>Email: info@equipmentsphere.com</p>
        <p>Phone: (123) 456-7890</p>
    </div>
</div>

<?php require_once 'footer.php'; ?>
