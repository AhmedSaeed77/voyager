<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>location</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>How to Get Current User Location with JS</h1><br/>
            <button id="find-me">Show my location</button><br/><br/>
            <div class="card">
                <div class="card-body">
                    <a id="map-link" target="_blank"></a>
                    <p id="status"></p>
                </div>
            </div>
        </div>

        <script>
            function geoFindMe()
            {
                const status = document.querySelector("#status");
                const mapLink = document.querySelector("#map-link");

                mapLink.href = "";
                mapLink.textContent = "";

                function success(position)
                {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    status.textContent = "";
                    mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
                    mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
                }

                function error()
                {
                    status.textContent = "Unable to retrieve your location";
                }

                if (!navigator.geolocation)
                {
                    status.textContent = "Geolocation is not supported by your browser";
                }
                else
                {
                    status.textContent = "Locating…";
                    navigator.geolocation.getCurrentPosition(success, error);
                }
            }

            document.querySelector("#find-me").addEventListener("click", geoFindMe);

        </script>
    </body>
</html>