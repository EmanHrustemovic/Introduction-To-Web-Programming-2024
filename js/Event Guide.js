document.addEventListener("DOMContentLoaded", function() {
    function toggleActiveCity() {
        document.querySelectorAll(".cities .city").forEach(function(city) {
            city.classList.remove("active");
        });

        this.classList.add("active");
    }

    function fetchCityData(cityName) {
        fetch(`./json/Event Guide.json/${cityName}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
    var cityElements = document.querySelectorAll(".cities .city");
    cityElements.forEach(function(city) {
        city.addEventListener("click", function() {
            toggleActiveCity.call(this);
            var cityName = this.textContent.trim(); 
            fetchCityData(cityName);
        });
    });
});

