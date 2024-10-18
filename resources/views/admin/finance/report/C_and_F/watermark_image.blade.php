@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')



@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
	
 .mkGimg {
    position: absolute !important;
    text-align: center;
    margin-left: 42%;
    top: 5px !important;
    color: steelblue;
    font-size: 1px;
    margin-top: 10%;
    transform: translate(-10%, -10%);
    opacity:0.1
  }

</style>

		  <div>
		   <img src="{{ url('/public/dist/img/MUKUNDGROUPLOGO.png')}}" class="mkGimg">
		  </div>
            

@include('admin.include.footer')


@endsection