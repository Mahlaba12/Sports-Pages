<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football</title>
    <link rel="stylesheet" href="football.css">
    <style>
        
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f9fafb;
  color: #222;
  line-height: 1.6;
  padding: 0 20px 40px;
}

header {
    background-image: linear-gradient(rgba(255, 111, 0, 0.5), rgba(255, 94, 0, 0.5)), url(nav.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 60px;
}
header h1 {
  font-weight: 700;
  letter-spacing: 1.5px;
  margin-bottom: 10px;
}

#main-nav {
  display: flex;
  justify-content: center;
  gap: 28px;
  flex-wrap: wrap;
}

#main-nav a {
  color: white;
  text-decoration: none;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 8px;
  transition: background-color 0.3s ease;
  letter-spacing: 0.05em;
}

#main-nav a:hover,
#main-nav .self {
  background-color: #003080;
  box-shadow: 0 4px 10px rgba(0, 48, 128, 0.5);
}

/* SECONDARY NAV */

#section-nav {
  margin: 25px auto 40px;
  background: #ffffff;
  max-width: 900px;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(0,0,0,0.1);
  display: flex;
  justify-content: center;
  gap: 24px;
  padding: 12px 15px;
  flex-wrap: wrap;
}

#section-nav a {
  color: #004aad;
  font-weight: 600;
  text-decoration: none;
  padding: 8px 16px;
  border-radius: 6px;
  transition: background-color 0.25s ease, color 0.25s ease;
  font-size: 0.95rem;
}

#section-nav a:hover {
  background-color: #004aad;
  color: white;
  box-shadow: 0 3px 8px rgba(0,74,173,0.6);
}

#search,
#league-filter {
  display: block;
  margin: 10px auto 30px;
  max-width: 400px;
  width: 100%;
  padding: 12px 18px;
  font-size: 1rem;
  border: 2px solid #004aad;
  border-radius: 10px;
  outline-offset: 3px;
  transition: border-color 0.3s ease;
}

#search:focus,
#league-filter:focus {
  border-color: #003080;
  box-shadow: 0 0 8px #003080aa;
}

section {
  max-width: 960px;
  margin: 0 auto 50px;
  background: white;
  padding: 25px 30px;
  border-radius: 14px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.07);
}

section h2 {
  font-size: 1.8rem;
  margin-bottom: 22px;
  color: #004aad;
  letter-spacing: 0.03em;
  border-bottom: 3px solid #004aad;
  padding-bottom: 8px;
}

/* GRID CONTAINERS */

.team-grid,
.player-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 18px;
}

.standings-table {
  overflow-x: auto;
}

.result-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.team-card,
.player-card,
.result-card {
  background: #e9f0ff;
  padding: 8px 14px;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,74,173,0.15);
  transition: transform 0.3s ease;
}

.team-card:hover,
.player-card:hover,
.result-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 18px rgba(0,74,173,0.3);
}

@media (max-width: 650px) {
  #main-nav,
  #section-nav {
    flex-direction: column;
    gap: 12px;
  }

  section {
    padding: 20px;
  }
}

    </style>
</head>
<body>
<header>
    <h1>Accommodations</h1>
    <nav id="main-nav">
        <a href="../homepage.html">Home</a>
        <a href="#" class="self">Accommodations</a>
        <a href="../sports/sports.html">Sports</a>
        <a href="#">Merch</a>
        <a href="../music/music.html">Music</a>
    </nav>
</header>

<div>
    <nav id="section-nav">
        <a href="#leagues">Leagues</a>
        <a href="#teams">Teams</a>
        <a href="#upcoming-games">Matches</a>
        <a href="#past-games">Results</a>
        <a href="#standings">Standings</a>
        <a href="#players">Players</a>
    </nav>
</div>

<input type="text" id="search" placeholder="Search team or player...">
<select id="league-filter">
    <option value="">All Leagues</option>
</select>

<section id="teams">
    <h2>Teams Participating</h2>
    <div id="mens-teams" class="team-grid"></div>
    <div id="womens-teams" class="team-grid"></div>
</section>

<section id="leagues">
    <h2>Leagues</h2>
    <div id="leagues-list"></div>
</section>

<section id="upcoming-games">
    <h2>Upcoming Games</h2>
    <div id="upcoming-list"></div>
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


<script src="basketball.js"></script>

</body>
</html>