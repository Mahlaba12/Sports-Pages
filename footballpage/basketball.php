<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball</title>
    <link rel="stylesheet" href="basketball.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(120deg, #f0f4fc 0%, #f7e7ff 100%);
            color: #232946;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        aside {
            background: #232946;
            color: #fff;
            width: 240px;
            min-width: 180px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 0;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        aside h1 {
            font-size: 2.1rem;
            font-weight: 700;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }
        nav.sidebar-nav {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        nav.sidebar-nav a {
            color: #eebbc3;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 20px 0 0 20px;
            transition: background 0.2s, color 0.2s;
            font-size: 1.08rem;
        }
        nav.sidebar-nav a.active, nav.sidebar-nav a:hover {
            background: #eebbc3;
            color: #232946;
        }
        main {
            flex: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .hero {
            background: url('basketball-court.jpg') center/cover no-repeat;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: left;
            padding: 40px 60px;
            border-radius: 0 0 40px 0;
            box-shadow: 0 6px 18px rgba(35,41,70,0.08);
            margin-bottom: 32px;
            color: #fff;
            position: relative;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(35,41,70,0.72);
            z-index: 0;
            border-radius: 0 0 40px 0;
        }
        .hero h2 {
            position: relative;
            z-index: 1;
            font-size: 2.7rem;
            font-weight: 700;
            margin: 0;
        }
        .hero p {
            margin: 12px 0 0;
            position: relative;
            z-index: 1;
            font-size: 1.12rem;
        }
        .filters-bar {
            display: flex;
            gap: 20px;
            margin: 40px 60px 20px;
            align-items: center;
            flex-wrap: wrap;
        }
        .filters-bar input, .filters-bar select {
            padding: 12px 18px;
            border-radius: 8px;
            border: 1.5px solid #b8c1ec;
            font-size: 1rem;
            outline: none;
            background: #fff;
            transition: border 0.2s;
        }
        .filters-bar input:focus, .filters-bar select:focus {
            border-color: #eebbc3;
        }
        section {
            background: #fff;
            margin: 0 60px 32px 60px;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(35,41,70,0.10);
            padding: 32px 28px 24px;
        }
        section h2 {
            margin-top: 0;
            font-size: 1.6rem;
            color: #232946;
            letter-spacing: 1px;
            margin-bottom: 22px;
            border-left: 5px solid #eebbc3;
            padding-left: 12px;
        }
        .card-grid, .player-grid, .team-grid, .result-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .card, .team-card, .player-card, .result-card {
            background: #eebbc3;
            border-radius: 14px;
            padding: 18px 16px;
            box-shadow: 0 2px 12px rgba(232,187,195,0.18);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover, .team-card:hover, .player-card:hover, .result-card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 18px rgba(232,187,195,0.35);
        }
        .standings-table {
            overflow-x: auto;
            margin-top: 16px;
        }
        .standings-table table {
            width: 100%;
            border-collapse: collapse;
            background: #f8f8ff;
            border-radius: 12px;
            overflow: hidden;
        }
        .standings-table th, .standings-table td {
            padding: 12px 10px;
            text-align: left;
        }
        .standings-table th {
            background: #b8c1ec;
            color: #232946;
            font-weight: 700;
        }
        .standings-table tr:nth-child(even) td {
            background: #eebbc3;
        }
        footer {
            margin: 40px 0 0 0;
            padding: 20px 0;
            background: #232946;
            color: #eebbc3;
            text-align: center;
            font-size: 1rem;
            border-radius: 24px 24px 0 0;
            letter-spacing: 1px;
        }
        /* Responsive */
        @media (max-width: 900px) {
            .container { flex-direction: column; }
            aside { width: 100%; min-width: 0; flex-direction: row; justify-content: center; height: auto; padding: 18px 0; }
            main { padding: 0; }
            .hero, .filters-bar, section { margin-left: 16px; margin-right: 16px; }
        }
        @media (max-width: 600px) {
            .hero, .filters-bar, section { margin: 0 5px 20px 5px; padding: 14px 7px 10px; }
            aside h1 { font-size: 1.2rem; }
        }
    </style>
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