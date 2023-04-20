@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if(auth()->user()->role==0)
                        <a class="btn btn-primary" href="{{route('user.prescription.page')}}">Upload Prescription</a>
                        <a class="btn btn-primary" href="{{route('list.prescription.page')}}">My Prescriptions List</a>
                        <a class="btn btn-primary" href="{{route('user.quotations.list')}}">New Quotations List</a>
                        @endif
                        @if(auth()->user()->role==1)
                        <a class="btn btn-primary" href="{{route('admin.list.prescription.page')}}">All Prescriptions List</a>
                        <a class="btn btn-primary" href="{{route('admin.approve.quotation')}}">All Approved List</a>
                        <a class="btn btn-primary" href="{{route('admin.reject.quotation')}}">All Rejected List</a>
                        <a class="btn btn-primary" href="{{route('admin.create.user.page')}}">Create New Pharmacist</a>
                        <a class="btn btn-primary" href="{{route('admin.list.user')}}">Pharmacists List</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
