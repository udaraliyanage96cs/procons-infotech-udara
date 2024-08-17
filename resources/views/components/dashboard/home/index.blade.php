    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer>
    </script>
    @if (Auth::User()->role == 'admin')
        <form id="location-filter-form" class="mt-3">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" step="0.0000001" min="-90"
                        max="90">
                </div>
                <div class="form-group col-md-3">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" step="0.0000001"
                        min="-180" max="180">
                </div>
                <div class="form-group col-md-3">
                    <label for="radius">Radius (km)</label>
                    <input type="text" class="form-control" id="radius" name="radius">
                </div>
                <div class="form-group col-md-3 d-flex align-items-end justify-content-end">
                    <button type="button" class="btn btn-primary" id="filter-btn">Filter</button>
                </div>
            </div>

        </form>
        <hr>
    @endif
    <div id="map" style="height: 75vh; width: 100%;"></div>
    <!-- Modal HTML -->
    <div class="modal fade" id="markerModal" tabindex="-1" aria-labelledby="markerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="markerModalLabel">Marker Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_image mb-2 justify-content-start">
                        <img id="modalImage" src="" alt="Report Image" class="img-fluid">
                    </div>
                    <p><strong>Plant Name:</strong> <span id="modalPlantName"></span></p>
                    <p><strong>Latitude:</strong> <span id="modalLatitude"></span></p>
                    <p><strong>Longitude:</strong> <span id="modalLongitude"></span></p>
                    <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map;
        var markers = [];

        function initMap() {
            var defaultLocation = {
                lat: 6.927079,
                lng: 79.861244
            };
            map = new google.maps.Map(document.getElementById('map'), { // use the global `map` variable
                zoom: 6,
                center: defaultLocation
            });

            var locations = @json($reports);

            addMarkers(locations); // Add initial markers
        }

        function addMarkers(locations) {
            // Clear existing markers
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // Add new markers
            locations.forEach(function(location) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(location.latitude),
                        lng: parseFloat(location.longitude)
                    },
                    map: map,
                    title: location.plant_name
                });
                markers.push(marker);
                marker.addListener('click', function() {
                    var imageUrl = location.photo === 'defimage.png' ?
                        '{{ asset('../../assets/img/defimage.png') }}' : '{{ asset('storage/reports') }}/' +
                        location.photo;
                    document.getElementById('modalImage').src = imageUrl;
                    document.getElementById('modalPlantName').innerText = location.plant_name;
                    document.getElementById('modalLatitude').innerText = location.latitude;
                    document.getElementById('modalLongitude').innerText = location.longitude;
                    document.getElementById('modalDescription').innerText = location.description ||
                        'No description available';

                    var myModal = new bootstrap.Modal(document.getElementById('markerModal'));
                    myModal.show();
                });
            });
        }


        function isValidLatitude(latitude) {
            return latitude >= -90 && latitude <= 90;
        }

        function isValidLongitude(longitude) {
            return longitude >= -180 && longitude <= 180;
        }

        function isValidRadius(radius) {
            return radius > 0;
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#filter-btn').on('click', function(e) {
            e.preventDefault();
            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            var radius = $('#radius').val();

            if (!isValidLatitude(latitude)) {
                alert('Please enter a valid latitude between -90 and 90.');
                return;
            }

            if (!isValidLongitude(longitude)) {
                alert('Please enter a valid longitude between -180 and 180.');
                return;
            }

            if (!isValidRadius(radius)) {
                alert('Please enter a valid radius greater than 0.');
                return;
            }

            $.ajax({
                url: '/dashboard/reports/filter',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    latitude: latitude,
                    longitude: longitude,
                    radius: radius
                },
                success: function(response) {
                    console.log(response);
                    addMarkers(response.reports);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
