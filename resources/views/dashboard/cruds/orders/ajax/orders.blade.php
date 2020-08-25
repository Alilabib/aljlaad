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
