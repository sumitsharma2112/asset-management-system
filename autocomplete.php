<?php
include('config/database.php');

$search_term = isset($_GET['term']) ? $_GET['term'] : '';

if (!empty($search_term)) {
    try {
        $stmt = $pdo->prepare("SELECT asset_id, serial_number, brand, model, category, processor, description, image FROM Assets WHERE serial_number LIKE ? LIMIT 10");
        $stmt->execute(["%$search_term%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $suggestions = [];
        foreach ($results as $row) {
            $suggestions[] = [
                'value' => $row['asset_id'],
                'label' => $row['serial_number'] . ' - ' . $row['brand'] . ' - ' . $row['model'] . ' - ' . $row['category'] . ' - ' . $row['processor'] . ' - ' . $row['description'] . ' - ' . $row['image']
            ];
        }

        echo json_encode($suggestions);
    } catch (PDOException $e) {
        echo json_encode([]);
    }
}
?>
