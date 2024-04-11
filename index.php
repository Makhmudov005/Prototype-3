<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROTOTYPE 3</title>
    <link rel="stylesheet" href="main.css">
    <script>
        function fetchWeather(city) {
            var cachedData = localStorage.getItem(city);
            if (cachedData) {
                display(JSON.parse(cachedData));
            } else {
                var url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=" + city + "&appid=2b762a623c4f95e31578d4f66a102bd0";
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        localStorage.setItem(city, JSON.stringify(data));
                        display(data);
                    })
                    .catch(error => {
                        console.error('Error fetching weather data:', error);
                    });
            }
        }

        function display(data) {
            var weatherContainer = document.getElementById('weather');
            weatherContainer.innerHTML = `
                <h1 id="city">${data.name}</h1>
                <h1 id="temp">${data.main.temp}</h1>
                <h1 id="weatherType">${data.weather[0].description}</h1>
                <h1 id="weather_when">${new Date(data.dt * 1000).toLocaleString()}</h1>
            `;
        }

        function handleSubmit(event) {
            event.preventDefault();
            var city = document.getElementById('city1').value;
            fetchWeather(city);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="search">
            <form onsubmit="handleSubmit(event)">
                <input type="text" id="city1" name="city"  placeholder="Enter the city name" spellcheck="false">
                <button type="submit">Search</button>
            </form>
        </div>
        <div id="weather" class="weather"></div>
    </div>

    <?php
        if(isset($_GET["btn"]))
        {
            include "saveData.php";
        }
    ?>  

</body>
</html>
