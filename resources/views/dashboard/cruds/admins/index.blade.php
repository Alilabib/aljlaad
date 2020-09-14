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
 <div class="block">
    <div class="block-header">
        <h3 class="block-title">المديرين<small></small></h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;"></th>
                    <th>الإسم</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">البريد الآلكتروني</th>
                    <th style="width: 15%;"> تاريخ التسجيل </th>
                    <th style="width: 15%;">   </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                    <td class="font-w600 font-size-sm">
                    <a href="{{route('admins.show',$item->id)}}">{{$item->name}}</a>
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->email}}
                    </td>
                    <td>
                        <em class="text-muted font-size-sm">{{$item->created_at->diffForHumans()}}</em>
                    </td>

                    <td class="text-center">
                        <div class="btn-group">
                            
                            <a href="{{route('admins.edit',$item->id)}}" class="btn btn-sm btn-primary"  title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <a href="javascript" class="btn btn-sm btn-primary delete-link"   data-route="{{route('admins.destroy',$item->id)}}" data-toggle="modal" data-target="#modal-block-normal" title="Edit">
                                <i class="fa fa-fw fa-times"></i>
                            </a>
                            {{-- <form action="{{route('admins.destroy',$item->id)}}" method="POST">
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

@endsection

@section('js')
<script src="{{asset('/')}}js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('/')}}js/pages/be_tables_datatables.min.js"></script>
<script>
    $(document).ready(function(){
        $('.delete-link').on('click',function(){
            var route = $(this).data('route');
            //alert(route);
            $('.delete-form').attr('action',route);
        });
    });
</script>
@endsection