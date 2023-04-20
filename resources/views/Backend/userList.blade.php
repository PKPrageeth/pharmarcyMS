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
                            <th> Name</th>
                            <th> Email Address</th>
                            <th> Contact Number</th>
                            <th> Address</th>
                            <th> Date of Birth</th>
                        </tr>
                        </thead>

                        @foreach($users as $user)
                            <tr>

                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->contact}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->dob}}</td>

                            </tr>



                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>


    </div>










@endsection
