<div class="alartbox">
    @if ($errors->any())
        @if (implode('', $errors->all(':message')) == 'deleted')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true" id="success-alert">
                <div class="toast-header bg-success">
                    <img src="../../assets/img/avatars/menu.png" class="d-block w-px-20 h-auto rounded-circle me-2"
                        alt="">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Report Deleted Successfully!</div>
            </div>
        @elseif(implode('', $errors->all(':message')) == 'notfound')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                id="success-alert">
                <div class="toast-header bg-warning">
                    <img src="../../assets/img/avatars/menu.png" class="d-block w-px-20 h-auto rounded-circle me-2"
                        alt="">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Report Not Found!.</div>
            </div>
        @elseif(implode('', $errors->all(':message')) == 'approved')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                id="success-alert">
                <div class="toast-header bg-success">
                    <img src="../../assets/img/avatars/menu.png" class="d-block w-px-20 h-auto rounded-circle me-2"
                        alt="">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Report Approved Successfully!</div>
            </div>
        @elseif(implode('', $errors->all(':message')) == 'noaccess')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                id="success-alert">
                <div class="toast-header bg-danger">
                    <img src="../../assets/img/avatars/menu.png" class="d-block w-px-20 h-auto rounded-circle me-2"
                        alt="">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Access Denide!</div>
            </div>
        @endif
    @endif
</div>


@if (Auth::User()->role != 'admin')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item mr-1">
                    <a class="btn btn-success" href="/dashboard/reports/add"><i class='bx bxs-add-to-queue'></i> Add
                        Report</a>
                </li>
            </ul>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-header">
        <h4 class="card-title">All Reports ({{ count($reports) }})</h4>
        @if (Auth::User()->role == 'admin')
            <form id="location-filter-form" class="mt-3">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" step="0.0000001"
                            min="-90" max="90">
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
        <div class="mb-3 mt-3">
            <input type="text" class="form-control" id="search" placeholder="Seach Anything In The Table">
        </div>
        <div class="table-responsive">
            <table class="table table-striped mt-4" id="devtable">
                <thead class="table-dark">
                    <tr role="row">
                        <th>ID</th>
                        <th>IMAGE</th>
                        <th>PLANT NAME</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>DESCRIPTION</th>
                        <th>STATUS</th>
                        <th>USER</th>
                        <th>SUBMITTED AT</th>
                        <th class="justify-content-end">ACTION</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">
                    @if (count($reports) > 0)
                        @foreach ($reports as $report)
                            <tr role="row" class="trow">
                                <td>{{ $report->id }}</td>
                                <td>
                                    @if ($report->photo == 'defimage.png')
                                        <img src="{{ asset('../../assets/img/defimage.png') }}" alt=""
                                            class="d-block rounded-3 plant-img">
                                    @else
                                        <img src="{{ asset('storage/reports/' . $report->photo) }}" alt=""
                                            class="d-block rounded-3 plant-img">
                                    @endif
                                </td>
                                <td>{{ $report->plant_name }}</td>
                                <td>{{ $report->latitude }}</td>
                                <td>{{ $report->longitude }}</td>
                                <td>{{ Str::words($report->description, 10, '...') }}</td>
                                <td>{{ $report->status == 0 ? 'Pending' : 'Verified' }}</td>
                                <td>{{ $report->name }}</td>
                                <td>{{ $report->created_at }}</td>
                                <td class="text-right text-nowrap  justify-content-end pr-0">
                                    <button type="submit" value="73" class="btn btn-icon btn-info mr-1 mb-1"
                                        name="SubOwner_delete" data-bs-toggle="modal" data-toggle="tooltip"
                                        data-placement="top" title="View Report"
                                        data-bs-target="#pricingModal-{{ $report->id }}"><i class="bx bx-show"></i>
                                    </button>
                                    @if (Auth::User()->role == 'admin')
                                        <a class="btn btn-icon @if ($report->status == '0') btn-success @else btn-danger @endif glow mr-1 mb-1"
                                            data-toggle="tooltip" data-placement="top" title="Approve Report"
                                            href="/dashboard/reports/approve/{{ $report->id }}">
                                            @if ($report->status == 0)
                                                <i class='bx bxs-lock-alt'></i>
                                            @else
                                                <i class='bx bxs-lock-open'></i>
                                            @endif
                                        </a>
                                    @endif
                                    @if (Auth::User()->role != 'admin')
                                        <a class="btn btn-icon btn-success glow mr-1 mb-1" data-toggle="tooltip"
                                            data-placement="top" title="Edit Report"
                                            href="/dashboard/reports/edit/{{ $report->id }}"><i
                                                class='bx bx-edit-alt'></i></a>
                                        <button type="submit" value="73"
                                            class="btn btn-icon btn-danger mr-1 mb-1" data-toggle="tooltip"
                                            data-placement="top" title="Delete Report" name="SubOwner_delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addNewCCModal-{{ $report->id }}"><i
                                                class="bx bx-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @if (Auth::User()->role != 'admin')
                                <div class="modal fade" id="addNewCCModal-{{ $report->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div
                                        class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc modal-dialog-centered ">
                                        <div class="modal-content p-3 p-md-5 ">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3>Warning</h3>
                                                    <p>Are you Sure You Want To Delete This Report ?</p>
                                                    <p>{{ $report->id }} - {{ $report->plant_name }}</p>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 text-center mt-4">
                                                        <a href="/dashboard/reports/delete/{{ $report->id }}"
                                                            class="btn btn-danger me-sm-3 me-1">Delete</a>
                                                        <button type="reset"
                                                            class="btn btn-label-secondary btn-reset"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="modal fade" id="pricingModal-{{ $report->id }}"tabindex="-1"
                                aria-labelledby="markerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="markerModalLabel">Report Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal_image mb-2 justify-content-start">
                                                @if ($report->photo == 'defimage.png')
                                                    <img src="{{ asset('../../assets/img/defimage.png') }}"
                                                        alt="" class="d-block rounded-3 ">
                                                @else
                                                    <img src="{{ asset('storage/reports/' . $report->photo) }}"
                                                        alt="" class="d-block rounded-3  ">
                                                @endif
                                            </div>
                                            <p><strong>Plant Name:</strong> <span
                                                    id="modalPlantName">{{ $report->plant_name }}</span></p>
                                            <p><strong>Description:</strong> <span
                                                    id="modalDescription">{{ $report->description }}</span></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr role="row">
                            <td style="--bs-table-accent-bg:#fff !important">No Data Available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#success-alert").fadeTo(5000, 500).slideUp(500, function() {
        $("#success-alert").slideUp(500);
    });

    $("#search").val("{{ request('search') }}");

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $(".trow").hide();
        $(".trow").filter(function() {
            var isMatch = $(this).text().toLowerCase().indexOf(value) > -1;
            return isMatch;
        }).show();
    });


    function isValidLatitude(lat) {
        return lat >= -90 && lat <= 90;
    }

    function isValidLongitude(lng) {
        return lng >= -180 && lng <= 180;
    }

    function isValidRadius(radius) {
        return radius > 0 && !isNaN(radius);
    }

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
                // Clear the current reports in the table
                $('#devtable tbody').empty();

                // Loop through the filtered reports and append them to the table
                response.reports.forEach(function(report) {
                    let reportRow = `
                        <tr role="row" class="trow">
                            <td>${report.id}</td>
                            <td>
                                <img src="{{ asset('storage/reports') }}/${report.photo}" alt=""
                                    class="d-block rounded-3 plant-img">
                            </td>
                            <td>${report.plant_name}</td>
                            <td>${report.latitude}</td>
                            <td>${report.longitude}</td>
                            <td>${report.description ? report.description.substring(0, 50) + '...' : ''}</td>
                            <td>${report.status == 0 ? 'Pending' : 'Verified'}</td>
                            <td>${report.name}</td>
                            <td>${report.created_at}</td>
                            <td class="text-right text-nowrap  justify-content-end pr-0">
                                <button type="submit" value="${report.id}" class="btn btn-icon btn-info mr-1 mb-1"
                                    name="SubOwner_delete" data-bs-toggle="modal"
                                    data-bs-target="#pricingModal-${report.id}">
                                    <i class="bx bx-show"></i>
                                </button>
                                @if (Auth::User()->role == 'admin')
                                    <a class="btn btn-icon ${report.status == 0 ? 'btn-success' : 'btn-danger'} glow mr-1 mb-1"
                                        href="/dashboard/reports/approve/${report.id}">
                                        <i class='bx ${report.status == 0 ? 'bxs-lock-alt' : 'bxs-lock-open'}'></i>
                                    </a>
                                @endif
                                @if (Auth::User()->role != 'admin')
                                    <a class="btn btn-icon btn-success glow mr-1 mb-1"
                                        href="/dashboard/reports/edit/${report.id}">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    <button type="submit" value="${report.id}" class="btn btn-icon btn-danger mr-1 mb-1"
                                        name="SubOwner_delete" data-bs-toggle="modal"
                                        data-bs-target="#addNewCCModal-${report.id}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    `;

                    $('#devtable tbody').append(reportRow);
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
