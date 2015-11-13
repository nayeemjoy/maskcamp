<!DOCTYPE html>
<html>
<head>
	@include('sections.head')
	
</head>
@if(Auth::check())
<body data-user="{{Auth::user()->id}}" data-baseurl="{{URL::to('/')}}" data-basetime="@if(isset($data['date']))
{{$data['date']}}
@endif">
@else
<body data-user="" data-baseurl="{{URL::to('/')}}">
@endif
	@yield('body')
</body>
</html>
	@yield('script')
	