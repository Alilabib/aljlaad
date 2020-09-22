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
                    <th class="d-none d-sm-table-cell" style="width: 30%;">حالة الطلب</th>

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
                    <td class="d-none d-sm-table-cell font-size-sm">
                        @if ($item->status =='inprogress' || $item->status =='pending')
                            <span class="badge badge-info"> جاري التجهيز </span>
                           @elseif($item->status =='inway')
                           <span class="badge badge-info"> في الطريق </span>
                           @elseif($item->status =='delevired')
                           <span class="badge badge-info"> تم التوصيل </span>

                           @elseif($item->status =='cancelled' || $item->status == 'problem')
                           <span class="badge badge-warning"> تم الإلغاء </span>

                        @endif
                    </td>
                    <td>
                        <em class="text-muted font-size-sm">{{$item->created_at->diffForHumans()}}</em>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            @if ($item->status =='cancelled' || $item->status == 'problem')
                                <a href="#" class="btn btn-sm btn-warning cancel-link"   data-reason="{{$item->cancel_status}}" data-type="{{$item->cancel_type}}" 
                                @if ($item->cancel_type)
                                    data-name="{{optional($item->user)->name}}"
                                @else
                                data-name="{{optional($item->driver)->name}}"
                                @endif 
                                 title="عرض سبب الإلغاء ">
                                    <i class="fa fa-fw fa-share-alt"></i>
                                </a>
                            @endif

                            @if ($item->driver_id == null && $item->status !='cancelled' && $item->status != 'problem')
                            <a href="javascript" class="btn btn-sm btn-success accept-link"   data-route="{{route('orders.accept')}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal1-block-normal" title="موافقة علي الطلب وتحديد مندوب">
                                <i class="fa fa-fw fa-location-arrow"></i>
                            </a>

                            @endif
                            @if ($item->status !='cancelled' && $item->status != 'problem')
                            <a href="{{route('orders.edit',$item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="تعديل ">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>                                
                            @endif
                         

                            <a href="javascript" class="btn btn-sm btn-danger delete-link"   data-route="{{route('orders.destroy',$item->id)}}" data-toggle="modal" data-target="#modal-block-normal" title="حذف">
                                <i class="fa fa-fw fa-times"></i>
                            </a>
                            {{-- <form action="{{route('orders.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary"  title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </form> --}}

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
        <!-- Normal Block Modal -->
        <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-danger">
                            <h3 class="block-title">حذف </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-m">
                            <h3> هل أنت متأكد من الحذف</h3>
                            <form class="delete-form" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>تأكيد</button>

                            </form>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Normal Block Modal -->

        <!-- Normal Block Modal -->
        <div class="modal" id="modal1-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal1-block-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-success">
                            <h3 class="block-title">الموافقة و تحديد المندوب </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-m">
                            <h3> إختر المندوب</h3>
                            <form class="accept-form" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" id="order_id_accept">
                                <div class="form-group">
                                    <label for="val-skill"> المندوب <span class="text-danger">*</span></label>
                                    <select class="js-select2 form-control" id="example-select2" name="driver_id" style="width: 100%;" data-placeholder="من فضلك إختر المندوب" required>
                                        <option > </option>
                                        @forelse ($providers as $item)
                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-check mr-1"></i>تأكيد</button>
                            </form>
                        </div>
                        <div class="block-content block-content-full text-right border-top">
                            <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Normal Block Modal -->


                <!-- Normal Block Modal -->
                <div class="modal" id="modal2-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal2-block-normal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-warning">
                                    <h3 class="block-title"> طلب تم إلغائه </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content font-size-m">
                                    <h3 id="cancel-type"> إختر </h3>
                            
                                    <label for="val-skill" id="cancel-type-name"> المندوب </label>
        
                                    <h3 > سبب الإلغاء </h3>
                                    <p id="cancel-reason"> </p>
                                </div>
                                <div class="block-content block-content-full text-right border-top">
                                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">إغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Normal Block Modal -->
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('/')}}js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="{{asset('/')}}js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="{{asset('/')}}js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('/')}}js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
<link rel="stylesheet" href="{{asset('/')}}js/plugins/dropzone/dist/min/dropzone.min.css">
<link rel="stylesheet" href="{{asset('/')}}js/plugins/flatpickr/flatpickr.min.css">

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
<script src="{{asset('/')}}js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('/')}}js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{asset('/')}}js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="{{asset('/')}}js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('/')}}js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="{{asset('/')}}js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<script src="{{asset('/')}}js/plugins/dropzone/dropzone.min.js"></script>
<!-- Page JS Code -->
<script src="{{asset('/')}}js/pages/be_tables_datatables.min.js"></script>
<script>jQuery(function(){ One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>

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
<script>
    $(document).ready(function(){
        $('.delete-link').on('click',function(){
            var route = $(this).data('route');
            //alert(route);
            $('.delete-form').attr('action',route);
        });

        $('.accept-link').on('click',function(){
            var route = $(this).data('route');
            var id  = $(this).data('id');
            //alert(route);
            $('.accept-form').attr('action',route);
            $('#order_id_accept').val(id);
        });
        $('.cancel-link').on('click',function(){
            let reason = $(this).data('reason');
            let type = $(this).data('type');
            let name = $(this).data('name');
            $('#cancel-reason').html(reason);
            $('#cancel-type-name').html(name);
            if(type == 'user'){
                $('#cancel-type').html('إسم العميل ')
            }else{
                $('#cancel-type').html(' إسم السائق ')
            }
            $('#modal2-block-normal').modal('show');

        });
    });
</script>
@endsection