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
            <h3 class="block-title">  الشركات</h3>
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
                        <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="الإسم" @isset($data)
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
                        <label for="val-skill">يدعم التوصيل السريع  <span class="text-danger">*</span></label>
                        <select class="form-control" id="val-skill" name="express_delivery">
                            <option value=""> إختر  </option>
                            <option value="0" @isset($data)
                            @if($data->express_delivery == "0")
                            selected
                            @endif
                                @endisset>لا يدعم  </option>

                            <option value="1" @isset($data)
                            @if($data->express_delivery == "1")
                            selected
                            @endif
                                @endisset> يدعم  </option>                 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="val-skill">القسم <span class="text-danger">*</span></label>
                        <select class="form-control" id="val-skill" name="category_id">
                            <option value=""> إختر القسم </option>
                            @forelse ($categories as $item)
                        <option value="{{$item->id}}" @isset($data)
                            @if($data->category_id == $item->id)
                            selected
                            @endif
                                @endisset>{{$item->name_ar}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="val-skill">المدن <span class="text-danger">*</span></label>
                        <select class="form-control js-select2" id="val-skill" name="city_id">
                            <option value=""> من فضلك إختر</option>
                            @forelse ($cities as $item)
                             <option value="{{$item->id}}" @isset($data)
                                @if($item->id == $data->city_id)
                                    selected
                                @endif
                                @endisset
                                >{{$item->name_ar}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="val-username">  الحد الآدني للطلب  <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" name="min" id="val-username" name="val-username" placeholder=" الحد الآدني للطلب" @isset($data)
                        value="{{$data->min}}"
                            @endisset>
                    </div>

                    <div class="form-group">
                        <label for="val-suggestions">الوصف <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_ar" rows="5" placeholder="وصف الشركة">@isset($data)
                            {{$data->desc_ar}}
                                @endisset</textarea>
                    </div>

                    <div class="form-group">
                        <label for="val-suggestions">الوصف بالإنجليزية <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_en" rows="5" placeholder="وصف الشركة بالانجليزية">@isset($data)
                            {{$data->desc_en}}
                                @endisset</textarea>
                    </div>

                    <div class="form-group">
                        <label for="val-password"> الصورة <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="val-password" name="image" placeholder="الصورة">
                    </div>

                    <div class="form-group">
                        <label for="val-password"> صورة الخلفية <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="val-password" name="back_image" placeholder="الصورة">
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
