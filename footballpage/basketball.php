<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball</title>
    <link rel="stylesheet" href="basketball.css">
    
</head>
<body>
<div class="container">
    <aside>
        <h1>Basketball</h1>
        <nav class="sidebar-nav">
            <a href="../homepage.html">Home</a>
            <a href="#" class="active">Basketball</a>
            <a href="../sports/sports.html">Sports</a>
            <a href="#">Merch</a>
            <a href="../music/music.html">Music</a>
        </nav>
    </aside>
    <main>
        <div class="hero">
            <div>
                <h2>Welcome to the Basketball Page</h2>
                <p>Discover teams, leagues, games, and more for the latest basketball action!</p>
            </div>
         </div>

        <div class="filters-bar">
            <input type="text" id="search" placeholder="Search team or player...">

            <select id="league-filter">
                <option value="">All Leagues</option>
            </select>
        </div>

        <section id="leagues">
            <h2>Leagues</h2>
            <div id="leagues-list" class="card-grid"></div>
        </section>

        <section id="teams">
            <h2>Teams Participating</h2>
            <div id="mens-teams" class="team-grid"></div>
            <div id="womens-teams" class="team-grid"></div>
        </section>

        <section id="upcoming-games">
            <h2>Upcoming Games</h2>
            <div id="upcoming-list" class="card-grid"></div>
        </section>

        <section id="past-games">
            <h2>Past Games</h2>
            <div id="past-reslt" class="result-list"></div>
        </section>

        <section id="standings">
            <h2>League Standings</h2>
            <div id="standings-men" class="standings-table"></div>
            <div id="standings-women" class="standings-table"></div>
        </section>

        <section id="players">
            <h2>Team Players</h2>
            <div id="player-men" class="player-grid"></div>
            <div id="player-women" class="player-grid"></div>
        </section>

        <footer>
            <p>&copy; 2025 UJ Student Hub. All rights reserved.</p>
        </footer>
    </main>

</div>

<script src="basketball.js"></script>

</body>
</html>