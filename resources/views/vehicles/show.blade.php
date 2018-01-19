@extends('layouts.app')
	@section('content')
			<vehicle-details :vehicle="{{ $vehicle }}" :total-payments="{{ $totalPayments }}">
				
			</vehicle-details>
	@endsection

