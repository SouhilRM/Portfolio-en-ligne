@extends('admin.admin_master')
@section('id_admin')
<div class="page-content">
<div class="container-fluid">

    <div class="mb-5"><h1>Admin Page : </h1></div>
    <div class="col-4">
        
        <!-- Simple card -->
        <div class="card">
            <center>
                <!--
                    src="{{ 
                        ( !empty( $adminData->profile_image ) ) ? 
                            url('upload/admin_images/'.$adminData->profile_image) 
                            : url('upload/no_image.jpg') 
                    }}"
                -->
                <img class="rounded-circle avatar-xl  mt-3" src="{{ ( !empty( $adminData->profile_image ) ) ? url('upload/admin_images/'.$adminData->profile_image) : url('upload/no_image.jpg') }}" alt="avatar">
            </center>
            <div class="card-body"><hr>
                <h4 class="card-title">Name : {{ $adminData->name }}</h4><hr>
                <h4 class="card-title">E-mail : {{ $adminData->email }}</h4><hr>
                <h4 class="card-title">UserName : {{ $adminData->username }}</h4><hr>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('edit.profile') }}" class="btn btn-primary me-md-2">Edit</a>
                </div>
            </div>
            
            
        </div>

    </div>

</div>
</div>
@endsection
