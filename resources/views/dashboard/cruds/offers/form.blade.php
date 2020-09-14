
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
            <h3 class="block-title">العروض</h3>
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
                        <label for="val-username">العنوان الخارجي <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name_ar" id="val-username" name="val-username" placeholder="العنوان الخارجي" @isset($data)
                        value="{{$data->title_ar}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-username">  العنوان الخارجي بالإنجليزية <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name_en" id="val-username" name="val-username" placeholder="العنوان الخارجي بالإنجليزية" @isset($data)
                        value="{{$data->title_en}}"
                            @endisset>
                    </div>


                    <div class="form-group">
                        <label for="val-username">العنوان <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name_ar" id="val-username" name="val-username" placeholder="العنوان" @isset($data)
                        value="{{$data->name_ar}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-username">  العنوان بالإنجليزية <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name_en" id="val-username" name="val-username" placeholder="العنوان بالإنجليزية" @isset($data)
                        value="{{$data->name_en}}"
                            @endisset>
                    </div>

                    <div class="form-group">
                        <label for="val-suggestions">الوصف <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_ar" rows="5" placeholder="وصف القسم">@isset($data)
                            {{$data->desc_ar}}
                                @endisset</textarea>
                    </div>
                    <div class="form-group">
                        <label for="val-suggestions"> الوصف بالإنجليزية <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_en" rows="5" placeholder="وصف القسم بالإنجليزية">@isset($data)
                            {{$data->desc_en}}
                                @endisset</textarea>
                    </div>
                    <div class="form-group">
                        <label for="val-password"> الصورة الخارجية <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="val-password" name="image" placeholder="الصورة">
                        @isset($data)
                        <div class="col-md-4 animated fadeIn">
                            <div class="options-container fx-item-zoom-in">
                                <img class="img-fluid options-item" src="{{asset('storage/uploads/offer/'. $data->img)}}">
                            </div>
                        </div>
                       @endisset
                    </div>

                    <div class="form-group">
                        <label for="val-password"> صورة الخلفية <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="val-password" name="back_image" placeholder="الصورة">
                        @isset($data)
                        <div class="col-md-4 animated fadeIn">
                            <div class="options-container fx-item-zoom-in">
                                <img class="img-fluid options-item" src="{{asset('storage/uploads/offer/'. $data->back_img)}}">
                            </div>
                        </div>
                       @endisset
                    </div>

                    <div class="form-group">
                        <label for="val-username">السعر <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="price" id="val-username" name="val-username" placeholder="السعر" @isset($data)
                        value="{{$data->price}}"
                            @endisset>
                    </div>

                    <div class="form-group">
                        <label for="val-username">نسبة الخصم <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="presentage" id="val-username" name="val-username" placeholder="نسبة الخصم" @isset($data)
                        value="{{$data->presentage}}"
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
