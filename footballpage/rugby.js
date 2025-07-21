async function loadJSON(file) {
    try {
        const res = await fetch(file);
        return await res.json();
    } catch (e) {
        console.error(`Failed to load ${file}`, e);
        return [];
    }
}

function createCard(team) {
    return `<div class="card">
        <img src="${team.image_url}" alt="${team.team_name}" width="100%">
        <h4>${team.team_name}</h4>
        <p>${team.team_description || ''}</p>
    </div>`;
}

function createFixtureRow(fix) {
    return `<tr>
        <td>${fix.home_team}</td>
        <td>vs</td>
        <td>${fix.away_team}</td>
        <td>${fix.date}</td>
        <td>${fix.time}</td>
        <td>${fix.venue}</td>
        <td>${fix.referee}</td>
    </tr>`;
}

function createResultRow(res) {
    return `<tr>
        <td>${res.home_team}</td>
        <td>${res.home_score} - ${res.away_score}</td>
        <td>${res.away_team}</td>
        <td>${res.date}</td>
    </tr>`;
}

function createStandingTable(teams) {
    let html = `<table><tr><th>Team</th><th>Played</th><th>W</th><th>D</th><th>L</th><th>GF</th><th>GA</th><th>GD</th><th>Points</th></tr>`;
    teams.forEach(team => {
        html += `<tr><td>${team.team_name}</td><td>${team.played}</td><td>${team.wins}</td><td>${team.draws}</td><td>${team.losses}</td>
            <td>${team.goals_for}</td><td>${team.goals_against}</td><td>${team.goal_difference}</td><td>${team.points}</td></tr>`;
    });
    return html + `</table>`;
}

function createPlayerCard(player) {
    return `<div class="card">
        <h4>${player.name}</h4>
        <p>Position: ${player.position}</p>
        <p>Team: ${player.team_name}</p>
    </div>`;
}

async function renderPage() {
    const mensTeamsJSON = await loadJSON('football_teams.json');
    const womensTeamsJSON = await loadJSON('womens_teams.json');
    const mensFixturesJSON = await loadJSON('mens_sports_fixtures.json');
    const womensFixturesJSON = await loadJSON("women's_sports_fixtures.json");
    const mensResultsJSON = await loadJSON('mens_sports_results.json');
    const womensResultsJSON = await loadJSON("women's_sports_results.json");
    const mensStandingsJSON = await loadJSON('mens_sports_standings.json'); // FIXED HERE
    const womensStandingsJSON = await loadJSON("women's_standings.json");
    const mensPlayersJSON = await loadJSON('players.json');
    const womensPlayersJSON = await loadJSON('womens_players.json');

    const mensTeams = mensTeamsJSON.football_teams || [];
    const womensTeams = womensTeamsJSON.football_teams || [];

    const mensFixtures = mensFixturesJSON.fixtures || [];
    const womensFixtures = womensFixturesJSON.fixtures || [];

    const mensResults = mensResultsJSON.results || [];
    const womensResults = womensResultsJSON.results || [];

    const mensStandings = mensStandingsJSON.standings || [];
    const womensStandings = womensStandingsJSON.standings || [];

    const mensPlayers = mensPlayersJSON.players || [];
    const womensPlayers = womensPlayersJSON.players || [];

    // Debug: log data
    console.log({ mensTeams, mensFixtures, mensResults, mensStandings, mensPlayers });

    document.getElementById('mens-teams').innerHTML = mensTeams.map(createCard).join('');
    document.getElementById('womens-teams').innerHTML = womensTeams.map(createCard).join('');

    document.getElementById('upcoming-list').innerHTML = `<table>${mensFixtures.map(createFixtureRow).join('')}</table>`;
    document.getElementById('past-reslt').innerHTML = `<table>${mensResults.map(createResultRow).join('')}</table>`;

    document.getElementById('standings-men').innerHTML = createStandingTable(mensStandings);
    document.getElementById('standings-women').innerHTML = createStandingTable(womensStandings);

    document.getElementById('player-men').innerHTML = mensPlayers.map(createPlayerCard).join('');
    document.getElementById('player-women').innerHTML = womensPlayers.map(createPlayerCard).join('');
}

window.onload = () => {
    renderPage();
};
