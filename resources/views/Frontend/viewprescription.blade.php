@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-2  m-2"><a class="btn btn-primary" href="user/upload/prescription">New
                        Prescription</a></div>
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
                        </tr>
                        </thead>


                        <tr>

                            <td>{{$pres->note}}</td>
                            <td>{{$pres->delivery_address}}</td>
                            <td>{{$pres->delivery_time}}</td>
                            <td>{{$pres->created_at}}</td>
                            <td>
                                @if($pres->status=='approve')
                                    <span class="badge text-bg-primary">
                                @endif
                                        @if($pres->status=='pending')
                                            <span class="badge text-bg-warning">
                                @endif
                                                @if($pres->status=='complete')
                                                    <span class="badge text-bg-success">
                                @endif
                                                        @if($pres->status=='reject')
                                                            <span class="badge text-bg-danger">
                                @endif


                                                                {{$pres->status}}
                                    </span>
                            </td>

                        </tr>


                    </table>
                    @if($pres->status!='pending')
                        <h3>Quotation</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Drugs</th>
                                <th> Quantity</th>
                                <th> Amount</th>
                            </tr>
                            </thead>

                            @foreach($drugs as $drug)
                                <tr>

                                    <td>{{$drug->drug}}</td>
                                    <td>{{$drug->qty}}*{{$drug->amount}}</td>
                                    <td>{{$drug->qty*$drug->amount}}</td>


                                </tr>

                            @endforeach

                        </table>
                        <form action="{{route('user.approve.reject.quotation')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$pres->id}}">
                            <input class="btn btn-success" type="submit" name="approve" value="Approve">
                            <input class="btn btn-danger" type="submit" name="reject" value="Reject">

                        </form>
                    @endif
                    <h3>Prescriptions</h3>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach(json_decode($pres->images) as $key=>$image)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if($key==0)active @endif" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#{{$image}}" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">Image {{$key+1}}</button>
                            </li>

                        @endforeach
                    </ul>


                    <div class="tab-content" id="myTabContent">
                        @foreach(json_decode($pres->images) as $key=>$image)
                            <div class="tab-pane fade show @if($key==0)active @endif" id="{{$image}}" role="tabpanel"
                                 aria-labelledby="home-tab" tabindex="0">
                                <img height="500px" src="{{$image}}" alt="">


                            </div>

                        @endforeach


                    </div>


                </div>
            </div>
        </div>
    </div>


    </div>










@endsection
