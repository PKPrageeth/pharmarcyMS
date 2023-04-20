@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
            </div>
            <div class="card">
                <div class="card-header">{{ __('Prescription List') }}</div>


                <div class="card-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th> Note</th>
                            <th> Delivery Address</th>
                            <th> Delivery Time</th>
                            <th> Date</th>
                            <th> Status</th>
                            <th> Action</th>
                        </tr>
                        </thead>

                        @foreach($list as $pres)
                            <tr>

                                <td>{{$pres->note}}</td>
                                <td>{{$pres->delivery_address}}</td>
                                <td>{{$pres->delivery_time}}</td>
                                <td>{{$pres->created_at}}</td>
                                <td>

                                    @if($pres->status=='pending')
                                        <span class="badge text-bg-warning">
                                    @endif
                                            @if($pres->status=='complete')
                                                <span class="badge text-bg-success">
                                    @endif
                                                    @if($pres->status=='reject')
                                                        <span class="badge text-bg-danger">
                                    @endif
                                                            @if($pres->status=='approve')
                                                                <span class="badge text-bg-primary">
                                @endif
                                                            {{$pres->status}}
                                    </span>
                                </td>
                                <td>
                                    @if($pres->status=='pending')
                                    <a href="{{route('admin.send.quotation.page',['id'=>$pres->id])}}" class="btn btn-primary btn-sm">Send Quotation</a>
                                    @else
                                        <a href="{{route('admin.send.quotation.page',['id'=>$pres->id])}}" class="btn btn-primary btn-sm">View</a>
                                    @endif
                                </td>
                            </tr>



                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>


    </div>










@endsection
