<?php
// Include database configuration
require_once 'config.php';

// Get total votes
$totalQuery = "SELECT COUNT(*) as total FROM votes";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalVotes = $totalRow['total'];

// Get voting results
$resultsQuery = "
    SELECT 
        pt.id,
        pt.name,
        pt.image,
        COUNT(v.id) as vote_count
    FROM 
        candidates pt
    LEFT JOIN 
        votes v ON pt.id = v.candidate_id
    GROUP BY 
        pt.id, pt.name, pt.image
    ORDER BY 
        vote_count DESC
";
$resultsData = $conn->query($resultsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Sports Voting System</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vote.css">
    <script src="https://kit.fontawesome.com/3b0c1a0317.js" crossorigin="anonymous"></script>
</head>
<body class="results-page">
    <div class="hero-bg"></div>
    <div class="container">

        <main>
            <section class="results-section">
                <div class="section-header">
                    <h2>Live Results</h2>
                    <div class="results-stats">
                        <div class="stat-item">
                            <i class="fas fa-vote-yea"></i>
                            <div class="stat-value"><?php echo $totalVotes; ?></div>
                            <div class="stat-label">Total Votes</div>
                        </div>
                    </div>
                </div>
                
                <div class="results-container">
                    <?php
                    if ($resultsData && $resultsData->num_rows > 0) {
                        while ($row = $resultsData->fetch_assoc()) {
                            $votePercent = $totalVotes > 0 ? round(($row['vote_count'] / $totalVotes) * 100, 1) : 0;

                            echo '<div class="result-card">';
                            echo '<div class="result-rank"></div>';
                            echo '<div class="result-image">';
                            echo '<img src="' . $row['image'] . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '</div>';
                            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                            echo '<div class="vote-stats">';
                            echo '<span class="vote-number">' . $row['vote_count'] . '</span> votes';
                            echo '<span class="vote-percentage">' . $votePercent . '%</span>';
                            echo '</div>';
                            echo '<div class="vote-bar">';
                            echo '<div class="vote-fill" data-width="' . $votePercent . '" style="width: 0%"></div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="no-results">';
                        echo '<i class="fas fa-info-circle"></i>';
                        echo '<p>No votes have been cast yet. Be the first to vote!</p>';
                        echo '<a href="index.php" class="btn-primary">Cast Your Vote <i class="fas fa-chevron-right"></i></a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </section>

            <section class="comments-section">
                <div class="section-header">
                    <h2>Recent Comments</h2>
                    <p class="section-desc">See what others are saying about their favorite sports stars</p>
                </div>
                <div id="comments-container">
                    <div class="comments-loading">
                        <div class="spinner"></div>
                        <p>Loading comments...</p>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 University of Johannesburg. All rights reserved.</p>
        </footer>
    </div>

    <script src="results.js"></script>
</body>
</html>
