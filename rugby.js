// script.js
document.addEventListener('DOMContentLoaded', () => {
    fetchResults();
    fetchUpcoming();
    fetchPlayers();
  });
  
  function goBack() {
    window.history.back();
  }
  
  async function fetchResults() {
    const resultsList = document.getElementById('results-list');
    const loader = document.getElementById('results-loader');
    resultsList.innerHTML = '';
    loader.style.display = 'block';
  
    try {
      const response = await fetch('https://api.example.com/results');
      if (!response.ok) throw new Error('API error');
      const data = await response.json();
      loader.style.display = 'none';
  
      data.results.forEach(game => {
        const li = document.createElement('li');
        li.textContent = `${game.date} vs ${game.opponent}: ${game.score}`;
        resultsList.appendChild(li);
      });
    } catch (error) {
      console.error("Failed to fetch results", error);
      loader.style.display = 'none';
      resultsList.innerHTML = '<li>Error loading results.</li>';
    }
  }
  
  async function fetchUpcoming() {
    const upcomingList = document.getElementById('upcoming-list');
    const loader = document.getElementById('upcoming-loader');
    upcomingList.innerHTML = '';
    loader.style.display = 'block';
  
    try {
      const response = await fetch('https://api.example.com/upcoming');
      if (!response.ok) throw new Error('API error');
      const data = await response.json();
      loader.style.display = 'none';
  
      data.games.forEach(game => {
        const li = document.createElement('li');
        li.textContent = `${game.date} vs ${game.opponent}`;
        upcomingList.appendChild(li);
      });
    } catch (error) {
      console.error("Failed to fetch upcoming games", error);
      loader.style.display = 'none';
      upcomingList.innerHTML = '<li>Error loading upcoming games.</li>';
    }
  }
  
  async function fetchPlayers() {
    const playerList = document.getElementById('player-list');
    playerList.innerHTML = '';
  
    try {
      const response = await fetch('https://api.example.com/players');
      if (!response.ok) throw new Error('API error');
      const data = await response.json();
  
      data.players.forEach(player => {
        const li = document.createElement('li');
        li.textContent = `${player.name} - ${player.position}`;
        playerList.appendChild(li);
      });
    } catch (error) {
      console.error("Failed to fetch players", error);
      playerList.innerHTML = '<li>Error loading player roster.</li>';
    }
  }
  
  
  