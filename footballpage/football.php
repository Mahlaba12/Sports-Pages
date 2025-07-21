<?php
function createCard($team) {
    return "<div class='card'>
        <img src='{$team['image_url']}' alt='{$team['team_name']}' width='100%'>
        <h4>{$team['team_name']}</h4>
        <p>" . ($team['team_description'] ?? '') . "</p>
    </div>";
}

function createFixtureRow($fix) {
    return "<tr>
        <td>{$fix['home_team']}</td>
        <td>vs</td>
        <td>{$fix['away_team']}</td>
        <td>{$fix['date']}</td>
        <td>{$fix['time']}</td>
        <td>{$fix['venue']}</td>
        <td>{$fix['referee']}</td>
    </tr>";
}

function createResultRow($res) {
    return "<tr>
        <td>{$res['home_team']}</td>
        <td>{$res['home_score']} - {$res['away_score']}</td>
        <td>{$res['away_team']}</td>
        <td>{$res['date']}</td>
    </tr>";
}

function createStandingTable($teams) {
    $html = "<table border='1'><tr>
        <th>Team</th><th>Played</th><th>W</th><th>D</th><th>L</th>
        <th>GF</th><th>GA</th><th>GD</th><th>Points</th>
    </tr>";
    foreach ($teams as $team) {
        $html .= "<tr>
            <td>{$team['team_name']}</td>
            <td>{$team['played']}</td>
            <td>{$team['wins']}</td>
            <td>{$team['draws']}</td>
            <td>{$team['losses']}</td>
            <td>{$team['goals_for']}</td>
            <td>{$team['goals_against']}</td>
            <td>{$team['goal_difference']}</td>
            <td>{$team['points']}</td>
        </tr>";
    }
    return $html . "</table>";
}

function createPlayerCard($player) {
    return "<div class='card'>
        <h4>{$player['name']}</h4>
        <p>Position: {$player['position']}</p>
        <p>Team: {$player['team_name']}</p>
    </div>";
}

$teamsData = json_decode(file_get_contents('mens_teams.json'), true);
$fixturesData = json_decode(file_get_contents('mens_sports_fixtures.json'), true);
$resultsData = json_decode(file_get_contents('mens_sports_results.json'), true);
$standingsData = json_decode(file_get_contents('mens_sports_standings.json'), true);
$playersData = json_decode(file_get_contents('players.json'), true);

$teams = $teamsData['football_teams'] ?? [];
$fixtures = $fixturesData['fixtures'] ?? [];
$results = $resultsData['results'] ?? [];
$standings = $standingsData['standings'] ?? [];
$players = $playersData['players'] ?? [];

?>



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
  padding: 14px 20px;
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

<h2>Men's Football Teams</h2>
<div id="mens-teams">
    <?php foreach ($teams as $team) echo createCard($team); ?>
</div>

<h2>Upcoming Fixtures</h2>
<table>
    <thead>
        <tr><th>Home</th><th></th><th>Away</th><th>Date</th><th>Time</th><th>Venue</th><th>Referee</th></tr>
    </thead>
    <tbody>
        <?php foreach ($fixtures as $fix) echo createFixtureRow($fix); ?>
    </tbody>
</table>

<h2>Past Results</h2>
<table>
    <thead>
        <tr><th>Home</th><th>Score</th><th>Away</th><th>Date</th></tr>
    </thead>
    <tbody>
        <?php foreach ($results as $res) echo createResultRow($res); ?>
    </tbody>
</table>

<h2>Standings</h2>
<div id="standings-men">
    <?= createStandingTable($standings); ?>
</div>

<h2>Players</h2>
<div id="player-men">
    <?php foreach ($players as $player) echo createPlayerCard($player); ?>
</div>
<script src="football.js"></script>

</body>
</html>