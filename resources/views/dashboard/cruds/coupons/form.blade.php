
@if($errors)
@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endforeach
@endif
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">الكوبونات</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Regular -->
            <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
            <div class="row items-push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-username">الإسم  <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control" name="name" id="val-username" name="val-username" placeholder="الإسم" @isset($data)
                        value="{{$data->name}}"
                            @endisset>
                    </div>

                    <div class="form-group">
                        <label for="val-password"> تاريخ الآنتهاء <span class="text-danger">*</span></label>
                        <input type="text" @isset($data)
                    value="{{$data->date}}"
                        @endisset class="js-flatpickr form-control bg-white" id="example-flatpickr-default" name="date" placeholder="Y-m-d">
                    </div>

                    <div class="form-group">
                        <label for="val-username">المبلغ <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="value" id="val-username" name="val-username" placeholder="المبلغ" @isset($data)
                        value="{{$data->value}}"
                            @endisset>
                    </div>


                </div>
            </div>
            <!-- END Regular -->



            <!-- Submit -->
            <div class="row items-push">
                <div class="col-lg-7 offset-lg-4">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </div>
            <!-- END Submit -->
        </div>
    </div>
    @section('css')
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="{{asset('/')}}js/plugins/flatpickr/flatpickr.min.css">

    @endsection

    @section('js')
    <script src="{{asset('/')}}js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('/')}}js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="{{asset('/')}}js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="{{asset('/')}}js/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{asset('/')}}js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="{{asset('/')}}js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="{{asset('/')}}js/plugins/dropzone/dropzone.min.js"></script>
    <script src="{{asset('/')}}js/plugins/flatpickr/flatpickr.min.js"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
    <script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>

    @endsection
