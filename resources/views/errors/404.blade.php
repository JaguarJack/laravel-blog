@extends('layouts.main')
@section('main')
   <div style="width:800px;height:700px;margin:20px auto;color:black;background:url(/assets/images/404.jpg);background-size:100% auto;
background-repeat:no-repeat">
   	{{ $exception->getMessage() }}
   </div>
@endsection