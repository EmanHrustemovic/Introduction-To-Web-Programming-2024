function generatePlayerList(players) {
  var playerListHTML = '';
  players.forEach(function(player) {
      playerListHTML += '<tr><td>' + player + '</td></tr>';
  });
  return playerListHTML;
}

function generateTeamTable(team) {
  var teamTableHTML = '<table bgcolor="lightgrey" width="160" border="1px">';
  teamTableHTML += '<tr class="first-table" bgcolor="grey">';
  teamTableHTML += '<th width="100">' + team.name + '</th>';
  teamTableHTML += '<td><img src="' + team.logoSrc + '" width="40" height="40"></td>';
  teamTableHTML += '</tr>';
  teamTableHTML += generatePlayerList(team.players);
  teamTableHTML += '</table>';
  return teamTableHTML;
}

function renderTeams(teams) {
  var matchesScheduleElement = document.querySelector('.matches-schedule .container .row');
  teams.forEach(function(team) {
      var colDiv = document.createElement('div');
      colDiv.className = 'col-md-2';
      colDiv.innerHTML = generateTeamTable(team);
      matchesScheduleElement.appendChild(colDiv);
  });
}


var apiUrl = "./json/Teams Page.json";

fetch(apiUrl)
  .then(function(response) {
      return response.json();
  })
  .then(function(data) {
      renderTeams(data.matchesSchedule.teams);
  })
  .catch(function(error) {
      console.log('Error fetching data from API:', error);
  });
