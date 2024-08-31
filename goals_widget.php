<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_signup.php");
    exit();
}

require 'backend/db.php'; // Ensure this file includes database connection setup

$user_id = $_SESSION['user_id'];

// Retrieve user goals
$stmt = $pdo->prepare("SELECT * FROM goals WHERE user_id = ?");
$stmt->execute([$user_id]);
$goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals Widget - FinTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .widget-container {
            padding: 20px;
            border: 1px solid #2d572c;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .widget-container:hover {
            transform: translateY(-5px);
        }

        h2 {
            font-weight: 700;
            font-size: 24px;
            color: #2d572c;
            margin-bottom: 20px;
        }

        .goal-item {
            margin-bottom: 20px;
        }

        .goal-title {
            font-size: 20px;
            color: #2d572c;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .goal-details {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }

        .progress-bar-custom {
            background-color: #2d572c;
            border-radius: 5px;
        }

        .progress-bar-custom span {
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="widget-container">
            <h2>My Financial Goals</h2>
            <?php if (!empty($goals)): ?>
                <?php foreach ($goals as $goal): ?>
                    <?php
                    $progress = ($goal['current_amount'] / $goal['target_amount']) * 100;
                    ?>
                    <div class="goal-item">
                        <h3 class="goal-title"><?= htmlspecialchars($goal['goal_name']); ?></h3>
                        <p class="goal-details">Target Amount: ₹<?= htmlspecialchars(number_format($goal['target_amount'], 2)); ?></p>
                        <p class="goal-details">Current Amount: ₹<?= htmlspecialchars(number_format($goal['current_amount'], 2)); ?></p>
                        <p class="goal-details">Deadline: <?= htmlspecialchars(date('Y-m-d', strtotime("+{$goal['timeframe']} months"))); ?></p>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-custom" role="progressbar" style="width: <?= $progress; ?>%;" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                                <span><?= number_format($progress, 2); ?>%</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No goals set yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
