<div class="form-group">
    <label for=""> المنطقة <span class="text-danger">*</span></label>
    <select  class="form-control selectpicker"  name="area_id[]" title="إختر المناطق"  multiple data-live-search="true">
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
</div>


<script src="{{asset('/')}}js/plugins/select2/js/select2.full.min.js"></script>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){ One.helpers('select2'); });</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $('select').selectpicker();
</script>