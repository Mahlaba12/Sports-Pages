async function loadJSON(file) {
    try {
        const res = await fetch(file);
        return await res.json();
    } catch (e) {
        console.error(`Failed to load ${file}`, e);
        return [];
    }
}

// CARD CREATORS
function createTeamCard(team) {
    return `<div class="team-card">
        <img src="${team.image_url || 'placeholder.jpg'}" alt="${team.team_name}" style="width:100%;border-radius:8px;">
        <h4>${team.team_name}</h4>
        <p>${team.team_description || ''}</p>
    </div>`;
}
function createPlayerCard(player) {
    return `<div class="player-card">
        <h4>${player.name}</h4>
        <p>Position: ${player.position}</p>
        <p>Team: ${player.team_name}</p>
    </div>`;
}
function createGameCard(game) {
    return `<div class="card">
        <strong>${game.home_team} vs ${game.away_team}</strong>
        <div style="margin-top:8px;">
            <span>${game.date || ''} ${game.time ? '@ ' + game.time : ''}</span><br>
            <span>${game.venue || ''}</span>
            ${game.referee ? `<br><span>Ref: ${game.referee}</span>` : ""}
        </div>
    </div>`;
}
function createResultCard(res) {
    return `<div class="result-card">
        <strong>${res.home_team} ${res.home_score} - ${res.away_score} ${res.away_team}</strong>
        <div style="margin-top:6px;">${res.date || ""}</div>
    </div>`;
}
function createStandingTable(teams) {
    let html = `<table>
      <tr><th>Team</th><th>Played</th><th>W</th><th>D</th><th>L</th><th>GF</th><th>GA</th><th>GD</th><th>Points</th></tr>`;
    teams.forEach(team => {
        html += `<tr>
          <td>${team.team_name}</td>
          <td>${team.played}</td>
          <td>${team.wins}</td>
          <td>${team.draws}</td>
          <td>${team.losses}</td>
          <td>${team.goals_for}</td>
          <td>${team.goals_against}</td>
          <td>${team.goal_difference}</td>
          <td>${team.points}</td>
        </tr>`;
    });
    return html + `</table>`;
}

// RENDER FUNCTIONS
async function renderPage() {
    // Load all data
    const mensTeamsJSON = await loadJSON('basketball_mens_teams.json');
    const womensTeamsJSON = await loadJSON('basketball_womens_teams.json');
    const mensFixturesJSON = await loadJSON('basketball_mens_fixtures.json');
    const womensFixturesJSON = await loadJSON('basketball_womens_fixtures.json');
    const mensResultsJSON = await loadJSON('basketball_mens_results.json');
    const womensResultsJSON = await loadJSON('basketball_womens_results.json');
    const mensStandingsJSON = await loadJSON('basketball_mens_standings.json');
    const womensStandingsJSON = await loadJSON('basketball_womens_standings.json');
    const mensPlayersJSON = await loadJSON('basketball_mens_players.json');
    const womensPlayersJSON = await loadJSON('basketball_womens_players.json');

    // Extract arrays
    const mensTeams = mensTeamsJSON.teams || [];
    const womensTeams = womensTeamsJSON.teams || [];
    const mensFixtures = mensFixturesJSON.fixtures || [];
    const womensFixtures = womensFixturesJSON.fixtures || [];
    const mensResults = mensResultsJSON.results || [];
    const womensResults = womensResultsJSON.results || [];
    const mensStandings = mensStandingsJSON.standings || [];
    const womensStandings = womensStandingsJSON.standings || [];
    const mensPlayers = mensPlayersJSON.players || [];
    const womensPlayers = womensPlayersJSON.players || [];

    // Render initial data
    renderTeams(mensTeams, womensTeams);
    renderPlayers(mensPlayers, womensPlayers);
    renderUpcomingGames([...mensFixtures, ...womensFixtures]);
    renderPastGames([...mensResults, ...womensResults]);
    renderStandings(mensStandings, womensStandings);

    // Set up filtering & search
    setupFilters({mensTeams, womensTeams, mensPlayers, womensPlayers});
}

// RENDER SECTIONS
function renderTeams(men, women) {
    document.getElementById('mens-teams').innerHTML = men.map(createTeamCard).join('');
    document.getElementById('womens-teams').innerHTML = women.map(createTeamCard).join('');
}
function renderPlayers(men, women) {
    document.getElementById('player-men').innerHTML = men.map(createPlayerCard).join('');
    document.getElementById('player-women').innerHTML = women.map(createPlayerCard).join('');
}
function renderUpcomingGames(games) {
    document.getElementById('upcoming-list').innerHTML = games.map(createGameCard).join('');
}
function renderPastGames(results) {
    document.getElementById('past-reslt').innerHTML = results.map(createResultCard).join('');
}
function renderStandings(men, women) {
    document.getElementById('standings-men').innerHTML = createStandingTable(men);
    document.getElementById('standings-women').innerHTML = createStandingTable(women);
}

// FILTERS
function setupFilters({mensTeams, womensTeams, mensPlayers, womensPlayers}) {
    const search = document.getElementById('search');
    const leagueFilter = document.getElementById('league-filter');
    // Populate league filter
    const leagues = [
        {id:"", name:"All Leagues"},
        {id:"men", name:"Men's League"},
        {id:"women", name:"Women's League"}
    ];
    leagueFilter.innerHTML = leagues.map(l => `<option value="${l.id}">${l.name}</option>`).join('');

    function applyFilters() {
        const league = leagueFilter.value;
        const searchTerm = (search.value || "").toLowerCase();

        // Filter teams
        let filteredMenTeams = mensTeams, filteredWomenTeams = womensTeams;
        if (searchTerm) {
            filteredMenTeams = filteredMenTeams.filter(t => t.team_name.toLowerCase().includes(searchTerm));
            filteredWomenTeams = filteredWomenTeams.filter(t => t.team_name.toLowerCase().includes(searchTerm));
        }
        if (league === "men") filteredWomenTeams = [];
        if (league === "women") filteredMenTeams = [];
        renderTeams(filteredMenTeams, filteredWomenTeams);

        // Filter players
        let filteredMenPlayers = mensPlayers, filteredWomenPlayers = womensPlayers;
        if (searchTerm) {
            filteredMenPlayers = filteredMenPlayers.filter(p => p.name.toLowerCase().includes(searchTerm));
            filteredWomenPlayers = filteredWomenPlayers.filter(p => p.name.toLowerCase().includes(searchTerm));
        }
        if (league === "men") filteredWomenPlayers = [];
        if (league === "women") filteredMenPlayers = [];
        renderPlayers(filteredMenPlayers, filteredWomenPlayers);
    }
    leagueFilter.addEventListener('change', applyFilters);
    search.addEventListener('input', applyFilters);
}

window.onload = () => {
    renderPage();
};