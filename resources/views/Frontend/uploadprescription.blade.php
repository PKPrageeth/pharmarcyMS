@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Upload Prescription') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('upload.prescription.page') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Note') }}</label>

                            <div class="col-md-6">
                                <textarea required class="form-control @error('note') is-invalid @enderror" name="note"
                                          id="address" cols="30" rows="10">{{ old('note') }}</textarea>


                                @error('note')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Delivery Address') }}</label>

                            <div class="col-md-6">
                                <textarea required class="form-control @error('delivery_address,') is-invalid @enderror"
                                          name="delivery_address" id="delivery_address" cols="30"
                                          rows="10">{{ old('delivery_address') }}</textarea>


                                @error('delivery_address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="delivery_time"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Delivery Time') }}</label>

                            <div class="col-md-6">
                                <select name="delivery_time" id="delivery_time" class="form-control">
                                    <option value="8am-10am">8am-10am</option>
                                    <option value="10am-12pm">10am-12pm</option>
                                    <option value="12pm-2pm">12pm-2pm</option>
                                    <option value="2pm-4pm">2pm-4pm</option>
                                    <option value="4pm-6pm">4pm-6pm</option>
                                </select>

                                @error('delivery_time')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="images"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Prescriptions') }}</label>

                            <div class="col-md-6">


                                <input  required type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" multiple="true">

                                @error('images.*')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div >
                            <div class="row" id="image-preview"></div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        // Preview selected images
        $('#images').change(function () {
            $('#image-preview').empty();
            var files = this.files;
            if (files) {
                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $('#image-preview').append('<div class="col-md-4 p-2"><img class="img-fluid" src="' + event.target.result + '"></div>');
                    }
                    reader.readAsDataURL(files[i]);
                }
            }
        });
    </script>

    </div>










@endsection
