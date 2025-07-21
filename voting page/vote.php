<?php
// Include database configuration
require_once 'config.php';

// Get all players/teams from database
$query = "SELECT * FROM candidates ORDER BY name ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Platform</title>
    <link rel="stylesheet" href="vote.css">
</head>
<body class="voting-page">

    
    <header>
        <h1>Accommodations</h1>
        <nav>
            <a href="../homepage.html">Home</a>
            <a href="#" class="self">Accommodations</a>
            <a href="../sports/sports.html">Sports</a>
            <a href="#">Events</a>
            <a href="../music/music.html">Music</a>
        </nav>
    </header>

    <div class="hero-bg"></div>
    <div class="container">

        <header2>
            <div class="logo">
                <i class="fas fa-trophy"></i>
                <h2>SportsVote</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="vote.php" class="active">Vote</a></li>
                    <li><a href="results.php">Results</a></li>
                    <li><a href="index.html">Home</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="voting-section">
                <div class="section-header">
                    <h2>Cast Your Vote</h2>
                    <p class="section-desc">Select your favorite player or team below and submit your vote!</p>
                </div>

                <form id="voteForm" action="vote.php" method="POST">
                    <div class="form-container">
                        <div class="form-left">
                            <div class="form-group">
                                <label for="voter_name">Your Name</label>
                                <input type="text" id="voter_name" name="voter_name" required placeholder="Enter your name">
                            </div>
                            
                            <div class="form-group">
                                <label for="voter_email">Your Email</label>
                                <input type="email" id="voter_email" name="voter_email" required placeholder="Enter your email">
                            </div>
                            
                            <div class="form-group">
                                <label for="comment">Comment (optional)</label>
                                <textarea id="comment" name="comment" rows="3" placeholder="Share your thoughts..."></textarea>
                            </div>
                        </div>
                        
                        <div class="form-right">
                            <div class="candidates-header">
                                <h3>Select a Player/Team:</h3>
                                <div class="candidate-counter"><span>0</span> Selected</div>
                            </div>
                            
                            <div class="candidates">
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="candidate-card">';
                                        echo '<input type="radio" id="candidate' . $row['id'] . '" name="candidate_id" value="' . $row['id'] . '" required>';
                                        echo '<label for="candidate' . $row['id'] . '">';
                                        echo '<div class="card-content">';
                                        echo '<div class="candidate-image">';
                                        echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                                        echo '<div class="check-icon"><i class="fas fa-check-circle"></i></div>';
                                        echo '</div>';
                                        echo '<div class="candidate-info">';
                                        echo '<h4>' . $row['name'] . '</h4>';
                                        echo '<p>' . $row['description'] . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p class="error">No players or teams available for voting at this time.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-vote">
                        <span>Submit Your Vote</span> 
                        <i class="fas fa-vote-yea"></i>
                    </button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 University of Johannesburg. All rights reserved.</p>
        </footer>
    </div>

    <script src="vote.js"></script>
</body>
</html>