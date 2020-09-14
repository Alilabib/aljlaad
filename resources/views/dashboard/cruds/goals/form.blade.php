
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
            <h3 class="block-title">هدف العميل </h3>
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
                        <label for="val-username">الإسم <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name_ar" id="val-username" name="val-username" placeholder="الإسم" @isset($data)
                        value="{{$data->name_ar}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-username">  الإسم بالإنجليزية <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name_en" id="val-username" name="val-username" placeholder="الإسم بالإنجليزية" @isset($data)
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
                        {{-- <label for="val-username"> المنتج <span class="text-danger">*</span></label> --}}
                        <select class="form-control" name="product_id">
                            <option value=""> إختر المنتج</option>
        
                            @foreach($products as $item)
                            <option value={{$item->id}} @isset($data)
                                @if ($data->product_id == $item->id)
                                selected
                            @endif
                            @endisset >{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="val-username">المرحلة الاولي <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="first_range" id="val-username" name="val-username" placeholder="المرحلة الاولي " @isset($data)
                        value="{{$data->first_range}}"
                            @endisset>
                    </div>

                    <div class="form-group">
                        <label for="val-username">المرحلة الثانيه <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="second_range" id="val-username" name="val-username" placeholder="المرحلة الثانيه " @isset($data)
                        value="{{$data->second_range}}"
                            @endisset>
                    </div>

                    <div class="form-group">
                        <label for="val-username">المرحلة النهائية <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="last_range" id="val-username" name="val-username" placeholder="المرحلة النهائية " @isset($data)
                        value="{{$data->last_range}}"
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

