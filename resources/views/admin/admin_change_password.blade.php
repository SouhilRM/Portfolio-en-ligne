@extends('admin.admin_master')
@section('id_admin')

<div class="page-content">
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Edit password Page</h4>

                    <!-- comment integrer notre validation -->
                    @if(count($errors))
                        @foreach($errors->all() as $error)
                        <p class="alert alert-danger" role="alert">
                            {{ $error }}
                        </p>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('update.password') }}">
                        <!-- n'oublie pas aussi le @csrf tres important -->
                        @csrf
                        
                        <div class="row mb-4">
                            <label for="example-text-input" class="col-sm-2 col-form-label ps-5">Old Password</label>
                            <div class="col-sm-10 pe-5">
                                <input class="form-control" type="password" name="oldpassword" id="oldpassword">
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row mb-4">
                            <label for="example-text-input" class="col-sm-2 col-form-label ps-5">New Password</label>
                            <div class="col-sm-10 pe-5">
                                <input class="form-control" type="password" name="newpassword" id="newpassword">
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-4">
                            <label for="example-text-input" class="col-sm-2 col-form-label ps-5">Confirm Password</label>
                            <div class="col-sm-10 pe-5">
                                <input class="form-control" type="password" name="confirmpassword" id="confirmpassword">
                            </div>
                        </div>
                        <!-- end row -->


                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Update Profile">Change Password</button>
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