document.addEventListener("DOMContentLoaded", function() {
    fetch("./json/Groups Page.json")
    .then(response => response.json())
    .then(data => {
        
    })
    .catch(error => console.error('Error loading data from API:', error));
});


