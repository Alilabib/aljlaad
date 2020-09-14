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
            <h3 class="block-title">البنرات</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Regular -->
            <h2 class="content-heading border-bottom mb-4 pb-2">إضافة</h2>
            <div class="row items-push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                       
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-username">الإسم <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-username" name="name_ar" placeholder="الإسم" @isset($data)
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
                        <label for="val-email"> المحتوي <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_ar" rows="5" placeholder="المحتوي">@isset($data)
                            {{$data->desc_ar}}
                                @endisset</textarea>
                    </div>

                    <div class="form-group">
                        <label for="val-suggestions"> المحتوي بالإنجليزية <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_en" rows="5" placeholder="المحتوي  بالإنجليزية">@isset($data)
                            {{$data->desc_en}}
                                @endisset</textarea>
                    </div>

                    <div class="form-group">
                        <label for="val-password"> الصورة <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="val-password" name="image" placeholder="الصورة">
                        @isset($data)
                        <div class="col-md-4 animated fadeIn">
                            <div class="options-container fx-item-zoom-in">
                                <img class="img-fluid options-item" src="{{asset('storage/uploads/slider/'. $data->img)}}">
                            </div>
                        </div>
                       @endisset
                    </div>
                    
                    <div class="form-group">
                        <label for="val-skill">يتبع <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" id="type">
                            <option value=""> إختر  </option>
                            <option value="image" @isset($data)
                            @if($data->type == 'image')
                                selected
                            @endif
                            @endisset>لا يوجد  </option>
                            <option value="link" @isset($data)
                            @if($data->type == 'link')
                                selected
                            @endif
                            @endisset> لينك    </option>
                            <option value="company" @isset($data)
                            @if($data->type == 'company')
                                selected
                            @endif
                            @endisset> شركة    </option>                 
                        </select>
                    </div>

                    <div class="form-group" id="link">
                        <label for="val-username">  اللينك  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="link" id="val-username" name="val-username" placeholder="اللينك" @isset($data)
                        value="{{$data->link}}"
                            @endisset>
                    </div>

                    <div class="form-group" id="company">
                        <label for="val-skill">الشركة <span class="text-danger">*</span></label>
                        <select class="form-control" id="val-skill" name="category_id">
                            <option value=""> من فضلك إختر</option>
                            @forelse ($categories as $item)
                        <option value="{{$item->id}}" @isset($data)
                                @if($item->id == $data->category_id)
                                    selected
                                @endif
                                @endisset
                                >{{$item->name_ar}}</option>
                            @empty
                                
                            @endforelse
                        </select>
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

    @section('js')
        <script>
            $('document').ready(function(){
                $('#link').hide();
                $('#company').hide();
                $('#type').change(function(){

                    if($(this).val() == 'link'){
                        $('#link').show();
                        $('#company').hide();
                    }else if($(this).val() == 'company'){
                        $('#link').hide();
                        $('#company').show();
                    }else{
                     $('#link').hide();
                     $('#company').hide();
                    }
                });      
            });
        </script>
    @endsection
