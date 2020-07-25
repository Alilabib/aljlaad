<div class="form-group">
    <label for="val-username"> المنطقة <span class="text-danger">*</span></label>
    <select class="form-control js-select2" id="val-skill" name="area_id">
        <option value=""> من فضلك إختر</option>
        @forelse ($areas as $item)
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