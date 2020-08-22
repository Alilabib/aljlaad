@extends('dashboard.layout.layout')
@section('content')
 <!-- Dynamic Table with Export Buttons -->
 @if(session('message'))
 @if(session('message')['type'] == 'success')
    <div class="col-xl-12 alert alert-dismissible alert-success fade show" role="alert">
        {{ session('message')['content']  }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
 @endif
 @endif

 <form  action="{{route('orders.status')}}" method="post" enctype="multipart/form-data" id="orders_form">
    @csrf
    <div class="block">
        
        <div class="block-content block-content-full">
            <!-- Regular -->
            <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
            <div class="row items-push">
            
                <div class="col-lg-12 col-xl-12" >
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="form-group col-xl-5" style="display:inline-block">
                                <label for="val-skill"> طريقة الدفع <span class="text-danger">*</span></label>
                                <select class="form-control js-select2 " name="pay_type" id="pay_type">
                                    <option value="cache"> كاش</option>
                                    <option value="online"> إلكتروني</option>

                                </select>
                            </div>
                            {{-- <div class="form-group col-xl-6" style="display:inline-block" >
                                <label for="val-skill"> نوع الشركة  <span class="text-danger">*</span></label>
                                <select class="form-control js-select2"  name="company_type">
                                    <option value=""> من فضلك إختر</option>
                                    <option value="local"> محلية</option>
                                    <option value="inter"> دولية</option>

                                </select>
                            </div>
                            <div class="form-group col-xl-5" style="display:inline-block">
                                <label for="val-skill"> نوع التوصيل  <span class="text-danger">*</span></label>
                                <select class="form-control js-select2 "  name="type">
                                    <option value="0"> عادي</option>
                                    <option value="1"> سريع</option>

                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-xl-5" style="display:inline-block">
                                <label for="example-flatpickr-default">التاريخ</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="example-flatpickr-default" name="date" placeholder="Y-m-d">
                            </div> --}}

                            <br>
                            <button type="submit" class="btn btn-sm btn-primary"> عرض</button>
                        </div>

                    </div>                  
                </div>
            </div>
            <!-- END Regular -->
            



        </div>
    </div>
</form>



 <div class="block">
    <div class="block-header">
        <h3 class="block-title">الطلبات<small></small></h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;"></th>
                    <th>صاحب الطلب</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">إجمالي المنتجات</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">إجمالي الطلب</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">تاريخ الطلب</th>

                    <th style="width: 15%;"> تاريخ التسجيل </th>
                    <th style="width: 15%;">   </th>
                </tr>
            </thead>
            <tbody id="data">
                @forelse ($data as $item)
                <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                    <td class="font-w600 font-size-sm">
                    <a href="{{route('orders.show',$item->id)}}">{{$item->user->name}}</a>
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->sub_total}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->total}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->date->diffForHumans()}}
                    </td>
                    
                    <td>
                        <em class="text-muted font-size-sm">{{$item->created_at->diffForHumans()}}</em>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            
                            <a href="{{route('orders.edit',$item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <form action="{{route('orders.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary"  title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                    
                @endforelse

            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table with Export Buttons -->
@endsection

@section('js')
<script src="{{asset('/')}}js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.colVis.min.js"></script>
<script src="{{asset('/')}}js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('/')}}js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{asset('/')}}js/plugins/flatpickr/flatpickr.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('/')}}js/pages/be_tables_datatables.min.js"></script>
<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker']); });</script>

<script>
        
    $('#orders_form').on('submit',function(e){
        e.preventDefault();
    //    var company_type = $("input[name='company_type']").val();
       var type = $("#pay_type").val();
       
       if(type !=''){
        var data = {
            type:type
        }
        getAjaxPostResponse("{{ url('admin/orders/status') }}",'data',data);
       }

    })
</script>

@endsection