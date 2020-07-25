@extends('dashboard.layout.layout')
@section('content')
<form  action="{{route('users.store')}}" method="POST">
    @csrf
    @include('dashboard.cruds.users.form')
</form>
@endsection

