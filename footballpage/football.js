fetch("data.json")
    .then(response => response.json())
    .then(data => {
        const leagueFilter = document.getElementById("league-filter");
        leagueFilter.addEventListener("change", function() {
            const selectedLeague = this.value;
            const teams = document.querySelectorAll(".team-card");

            teams.forEach(team => {
                if (team.dataset.league === selectedLeague || selectedLeague === "") {
                    team.style.display = "block";
                } else {
                    team.style.display = "none";
                }
            });
        });
    });