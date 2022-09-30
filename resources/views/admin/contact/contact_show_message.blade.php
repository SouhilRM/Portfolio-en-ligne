@extends('admin.admin_master')
@section('id_admin')

<div class="page-content">
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Show Message Page</h4>

                    <fieldset disabled>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">name</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $message->name }}" name="number" id="title">
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">email</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $message->email }}" name="email" id="title">
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">message</label>
                            <div class="col-sm-11">
                                <textarea class="form-control" aria-label="With textarea" name="short_description">{{ $message->message }}</textarea>
                            </div> 
                        </div>
                        <!-- end row -->
                    </fieldset><br><br>
                    <div class="row mb-3">                      
                        <div class="ms-4">
                            <a href="{{ route('contact.message') }}" type="button" class="btn btn-info">Back</a>
                        </div>
                    </div>  
                </div>
            </div>
        </div> <!-- end col -->
    </div>



</div>
</div>

@endsection