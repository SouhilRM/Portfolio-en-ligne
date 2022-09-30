@extends('admin.admin_master')
@section('id_admin')

<div class="page-content">
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Edit Footer Page</h4>

                    
                    
                    <form method="POST" action="{{ route('uptade.footer') }}">
                        
                        @csrf
                        
                        <input type="hidden" name="id" value="{{ $footer->id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Phone</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->number }}" name="number" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Short Description</label>
                            <div class="col-sm-11">
                                <textarea class="form-control" aria-label="With textarea" name="short_description">{{ $footer->short_description }}</textarea>
                            </div> 
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Adress</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->adress }}" name="adress" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Email</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->email }}" name="email" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Facebook</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->facebook }}" name="facebook" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Twitter</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->twitter }}" name="twitter" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Instagram</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->instagram }}" name="instagram" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Youtube</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->youtube }}" name="youtube" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">LikeDin</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->linkdin }}" name="linkdin" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Pinterest</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->pinterest }}" name="pinterest" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Copy Right</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $footer->copyright }}" name="copyright" id="title">
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Update Slide">Edit Footer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>



</div>
</div>

@endsection