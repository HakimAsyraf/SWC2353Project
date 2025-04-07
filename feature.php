<?php
$page_title = "Equipment Categories";
require_once 'header.php';

// Get equipment types with their descriptions from database
$equipment_categories = [];
try {
    $stmt = $conn->prepare("SELECT type, description FROM equipment GROUP BY type");
    $stmt->execute();
    $result = $stmt->get_result();
    $equipment_categories = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    // Fallback data with types and descriptions
    $equipment_categories = [
        ['type' => 'Sports Equipment', 'description' => 'Equipment for various sports activities'],
        ['type' => 'Photography', 'description' => 'Cameras and accessories for professional photography'],
        ['type' => 'Electronics', 'description' => 'Computers and electronic devices'],
        ['type' => 'Science Equipment', 'description' => 'Laboratory and scientific instruments'],
        ['type' => 'Engineering', 'description' => 'Tools and machines for engineering projects']
    ];
}

// Function to get emoji for equipment type
function getEquipmentEmoji($type) {
    $emojiMap = [
        'Sports Equipment' => '🏀',
        'Photography' => '📷',
        'Electronics' => '💻',
        'Science Equipment' => '🔬',
        'Engineering' => '🛠️',
        'Lab Equipment' => '🧪'
    ];
    return $emojiMap[$type] ?? '📦'; // Default emoji
}

// Reorder categories for the desired layout
$ordered_categories = [];
foreach ($equipment_categories as $category) {
    if ($category['type'] == 'Science Equipment' || $category['type'] == 'Engineering') {
        $ordered_categories[1][] = $category; // Middle row
    } else {
        $ordered_categories[0][] = $category; // Top row
    }
}
// If we have more than 5 categories, the rest would go to $ordered_categories[2] for bottom row
?>

<div class="content-section" style="max-width: 1200px; margin: 40px auto; padding: 40px;">
    <h1 style="color: #e67e22; text-align: center; margin-bottom: 30px;">EQUIPMENT CATEGORIES</h1>
    
    <!-- Top row (3 items) -->
    <div class="equipment-row" style="display: flex; justify-content: center; gap: 30px; margin-bottom: 30px;">
        <?php foreach ($ordered_categories[0] as $category): ?>
        <div class="equipment-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px;">
            <div style="font-size: 3rem; text-align: center; margin-bottom: 15px;">
                <?php echo getEquipmentEmoji($category['type']); ?>
            </div>
            <h3 style="color: #2c3e50; text-align: center;"><?php echo htmlspecialchars($category['type']); ?></h3>
            <p style="text-align: center;"><?php echo htmlspecialchars($category['description']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Middle row (2 items) -->
    <div class="equipment-row" style="display: flex; justify-content: center; gap: 30px; margin-bottom: 30px;">
        <?php foreach ($ordered_categories[1] as $category): ?>
        <div class="equipment-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px;">
            <div style="font-size: 3rem; text-align: center; margin-bottom: 15px;">
                <?php echo getEquipmentEmoji($category['type']); ?>
            </div>
            <h3 style="color: #2c3e50; text-align: center;"><?php echo htmlspecialchars($category['type']); ?></h3>
            <p style="text-align: center;"><?php echo htmlspecialchars($category['description']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Bottom row (if more than 5 categories exist) -->
    <?php if (isset($ordered_categories[2])): ?>
    <div class="equipment-row" style="display: flex; justify-content: center; gap: 30px;">
        <?php foreach ($ordered_categories[2] as $category): ?>
        <div class="equipment-card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px;">
            <div style="font-size: 3rem; text-align: center; margin-bottom: 15px;">
                <?php echo getEquipmentEmoji($category['type']); ?>
            </div>
            <h3 style="color: #2c3e50; text-align: center;"><?php echo htmlspecialchars($category['type']); ?></h3>
            <p style="text-align: center;"><?php echo htmlspecialchars($category['description']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>
