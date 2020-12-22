<?php session_start(); //starting the session to access the cart?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!--bootstrap scripts-->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><!--bootstrap CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" >
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
        <link rel="stylesheet" href="../footer/muhammad.css"> <!--linking footer css-->
        <link rel="stylesheet" href="index.css"> <!--linking location page css-->
        <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.min.js'></script>
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.css' type='text/css' />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Sansita+Swashed&display=swap" rel="stylesheet"> <!--linking google font-->
        <style>
            /*additional styling for footer */
        .footer .footer-content h2 {
            padding-top: 30px;
            padding-bottom: 20px;
        }
        </style>       
    </head>
    <body style="font-family: 'Sansita Swashed', cursive;">
        <?php 
            require_once("../ShoppingCart/components/header.php"); //import the header
        ?>
        <h1>
         Store Locator 
        </h1>
        <h1>
            Use the Map below to find grocery stores near you!
        </h1>
        <div class = "row"> <!--container for map and location listings. uses bootstrap class for responsiveness-->
            <div class = "column2">
                <div id="map" class="map pad2">
                    <script>
                        //below is a javascript feature
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var lon = parseFloat(position.coords.longitude);
                            var lat = parseFloat(position.coords.latitude);
                            mapboxgl.accessToken = 'pk.eyJ1IjoiYXBpY29kaW5nIiwiYSI6ImNrZ3d6N2plYzAyaGoycW16Z21teWY0bHoifQ.v4F1ym2KrUWmJ1-87odWwQ';
                            var map = new mapboxgl.Map({
                            container: 'map', // Container ID
                            style: 'mapbox://styles/mapbox/streets-v11', // Map style to use
                            center: [lon, lat], // Starting position [lng, lat]  // call the function and have it return the latitude and longitude
                            zoom: 12, // Starting zoom level
                        });
                            var marker = new mapboxgl.Marker() // initialize a new marker
                                .setLngLat([lon, lat]) // Marker [lng, lat] coordinates
                                .addTo(map);

                            var geocoder = new MapboxGeocoder({ // Initialize the geocoder
                                accessToken: mapboxgl.accessToken, // Set the access token
                                mapboxgl: mapboxgl, // Set the mapbox-gl instance
                                marker: false, // Do not use the default marker style
                                placeholder: 'Search for grocery stores in your local area', // Placeholder text for the search bar
                                proximity: {
                                    longitude: lon,
                                    latitude: lat
                                } // Coordinates of the user
                                });

                            // Add the geocoder to the map
                            map.addControl(geocoder);

                            // After the map style has loaded on the page,
                            // add a source layer and default styling for a single point
                            map.on('load', function() {
                                map.addSource('single-point', {
                                type: 'geojson',
                                data: {
                                    type: 'FeatureCollection',
                                    features: []
                                }
                                });

                                map.addLayer({
                                id: 'point',
                                source: 'single-point',
                                type: 'circle',
                                paint: {
                                    'circle-radius': 10,
                                    'circle-color': '#448ee4'
                                }
                                });

                                // Listen for the `result` event from the Geocoder
                                // `result` event is triggered when a user makes a selection
                                // Add a marker at the result's coordinates
                                geocoder.on('result', function(ev) {
                                map.getSource('single-point').setData(ev.result.geometry);
                    
                                });
                                geocoder.on('results', function(results) {
                                var response = results;
                                var output = ""
                                var b = true;
                                var displayString = "";
                                for (var i = 0; i < response['features'].length; i++){
                                    for (var j =0; j < response['query'].length;j++){
                                        if (!JSON.stringify(!response['features'][i]['place_name'].includes(response['query'][j]))) {
                                            b = false;
                                        }
                                        //check if the name has the search item
                                    }
                                    
                        
                                    if (b){
                                        var output = output + response['features'][i]['place_name'] +"<br></br>";
                                        console.log(response['features'][i]['place_name']);
                                        document.getElementById("printHere").innerHTML = output;
                                    }

                        
                                }
                                });
                            });
                            
                        });
            
                    </script>
                </div>
            </div>
    
        
            <div class = "column" id = "resultBar" >
                <div class="listing pad2">
                    <h1 style = "font-family: 'Sansita Swashed', cursive; color: #DDDED6;">Listing Of Locations </h1>
                    <br>
                    <p id="printHere" style = "font-family: 'Open Sans', sans-serif;"></p>
                </div>
            </div>
        </div>
    </div>
    <main></main>
    <?php require_once("../footer/footer-bootstrap.php"); //import the footer ?>
</body>
</html>