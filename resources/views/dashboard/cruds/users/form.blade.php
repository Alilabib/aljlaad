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
            <h3 class="block-title">المستخدمين</h3>
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
                        <input type="text" class="form-control" id="val-username" name="name" placeholder="الإسم" @isset($data)
                        value="{{$data->name}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-username">رقم الهاتف <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-username" name="phone" placeholder="رقم الهاتف" @isset($data)
                        value="{{$data->phone}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-email">البريد الإلكتروني <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-email" name="email" placeholder="البريد الآلكتروني " @isset($data)
                        value="{{$data->email}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-password">الرقم السري <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="الرقم السري">
                    </div>
                    <div class="form-group">
                        <label for="val-username"> المدينة <span class="text-danger">*</span></label>
                        <select class="form-control js-select2" id="city" name="city_id" >
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

                    <div class="form-group" id="area">
                        @isset($data)
                        <label for="val-username"> المنطقة <span class="text-danger">*</span></label>
                        <select class="form-control js-select2" id="val-skill" name="area_id">
                            <option value=""> من فضلك إختر</option>
                            @forelse ($areas as $item)
                             <option value="{{$item->id}}" @isset($data)
                                @if($item->id == $data->area_id)
                                    selected
                                @endif
                                @endisset
                                >{{$item->name_ar}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                        @endisset
                    </div>

                    <div class="form-group">
                        <label for="val-username"> العنوان <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-username" name="address" placeholder="آلعنوان" @isset($data)
                        value="{{$data->address}}"
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

    @section('js')
        <script>
        
            $('#city').change(function(){
               var id = $(this).val();
               if(id !=''){
                var data = {
                  id:id
                }
                getAjaxPostResponse("{{ url('admin/users/areas') }}",'area',data);
               }

            })
        </script>
    @endsection