@extends('layouts.app')
	@section('content')

			<employee-profile :employee="{{ $employee}}"></employee-profile>
	@endsection

