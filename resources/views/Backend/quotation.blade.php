@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
            </div>
            <div class="col-md-6">
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

                            </tr>



                        </table>









                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach(json_decode($pres->images) as $key=>$image)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($key==0)active @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#{{$image}}" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Image {{$key+1}}</button>
                                </li>

                            @endforeach
                        </ul>



                        <div class="tab-content" id="myTabContent">
                            @foreach(json_decode($pres->images) as $key=>$image)
                                <div class="tab-pane fade show @if($key==0)active @endif" id="{{$image}}" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <img height="500px" src="{{$image}}" alt="">



                                </div>

                            @endforeach


                        </div>




                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        @if($pres->status=='pending')
                        <div class="mb-3">
                            <label for="drug" class="form-label">Drug</label>
                            <input type="text" class="form-control" id="drug" name="drug" placeholder="Drug">
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Quantity">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Unit Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Unit Price">
                        </div>
                        <button id="addDrug" class="btn btn-primary ">Add</button>
                        @endif

                    </div>
                    <div id="preview">

                    </div>
                    @if($pres->status=='pending')
                    <form action="{{route('admin.submit.quotation')}}" method="post">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$pres->id}}">
                        <input type="submit" value="Submit" class="btn btn-primary">



                    </form>
                    @endif
                </div>



            </div>
        </div>
    </div>


    </div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        console.log({{$pres->id}})

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        getQuotations({{$pres->id}})

        $("#addDrug").click(function(e){
            console.log("add")
            e.preventDefault();
            var drug = $("#drug").val();
            var qty = $("#qty").val();
            var price = $("#price").val();
            var id = $("#id").val();
            console.log({drug:drug,qty:qty,price:price,id:id})
            $.ajax({
                type:'POST',
                url : "{{route('admin.add.drugs')}}",
                data : {drug:drug,qty:qty,price:price,id:id},
                success : function(data){
                   getQuotations(id)
                }
            });
        });
        function getQuotations(id){
            $.ajax({
                type:'POST',
                url : "{{route('admin.list.drugs')}}",
                data : {id:id},
                success : function(data){
                    $('#preview').html(data);
                }
            });

        }
        function removeDrug(id,quoid){
            $.ajax({
                type:'POST',
                url : "{{route('admin.remove.drugs')}}",
                data : {id:id,quoid:quoid},
                success : function(data){
                    getQuotations(quoid)
                }
            });

        }


    </script>








@endsection
