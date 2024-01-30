<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Location Form</title>
    </head>
    <body>
        <button id="find-me">Show my location</button><br/><br/>
        <a id="map-link" target="_blank"></a>
        <p id="status"></p>
        <form action="{{ route('store_coordinates') }}" method="post" id="locationForm">
            @csrf
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="submit">Submit Location</button>
        </form>

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
                    status.textContent = "";
                    document.getElementById("latitude").value = latitude;
                    document.getElementById("longitude").value = longitude;
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