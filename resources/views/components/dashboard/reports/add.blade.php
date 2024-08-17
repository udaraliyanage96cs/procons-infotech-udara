<div class="alartbox">
    @if ($errors->any())
        @if (implode('', $errors->all(':message')) == 'success')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true" id="success-alert">
                <div class="toast-header bg-success">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Report Added Succesfully!</div>
            </div>
        @elseif(implode('', $errors->all(':message')) == 'error')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                id="success-alert">
                <div class="toast-header bg-danger">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Report Adding Faild!</div>
            </div>
        @elseif(implode('', $errors->all(':message')) == 'exsists')
            <div class="bs-toast toast fade show" role="alert" aria-live="assertive" aria-atomic="true"
                id="success-alert">
                <div class="toast-header bg-danger">
                    <div class="me-auto fw-semibold">Eco Track Alerts</div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Reported Plant Already Exsists!</div>
            </div>
        @endif
    @endif
</div>

<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Report</h4>
        </div>
        <div class="card-body">
            <form class="form form-horizontal" id="brandForm" action="/dashboard/reports/add" method="post"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-body">
                    <div class="row ">
                        <div class="col-md-12 form-group mb-3">
                            <label class="form-label">Plant Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Plant Name"
                                required>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="number" class="form-control" name="lat" placeholder="Enter Latitude"
                                    step="0.0000001" min="-90" max="90" required>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="number" class="form-control" name="lang" placeholder="Enter Longitude"
                                    step="0.0000001" min="-180" max="180" required>
                            </div>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="basic-default-message" class="form-control" name="desc"></textarea>
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <div class="imgbox">
                                <img src="{{ asset('../../assets/img/defimage.png') }}" alt=""
                                    id="imagePreview">
                                <input type="file" name="file" id="file" class="btn btn-success mt-4"
                                    value="Upload Image" accept="image/*">
                            </div>
                        </div>


                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="reset" class="btn btn-label-secondary"
                                style="margin-right: 20px">Clear</button>
                            <button type="submit" name="AddHEXfile" value="add"
                                class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#file').change(function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            $('#imagePreview').attr('src', reader.result);
        }

        reader.readAsDataURL(file);
    });
</script>
