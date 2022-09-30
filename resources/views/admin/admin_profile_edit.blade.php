@extends('admin.admin_master')
@section('id_admin')
<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Edit Profile Page</h4>

                    
                    <!-- enctype="multipart/form-data" car on upload une image tjr utilise là -->
                    <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                        <!-- n'oublie pas aussi le @csrf tres important -->
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-4">Name</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $editData->name }}" name="name" id="name">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-4">Username</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $editData->username }}" id="username" name="username">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-4">E-mail</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="email" value="{{ $editData->email }}" id="email" name="email">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-4">Avatar</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="file" id="image" name="profile_image">
                            </div>
                        </div>
                        <!--image-->
                        <div class="row py-3">
                            <label class="col-sm-1 col-form-label ps-4"></label>
                            <div class="col-sm-11">
                                <img id="showImage" class="rounded avatar-lg" width="400" height="400" src="{{ ( !empty( $editData->profile_image ) ) ? url('upload/admin_images/'.$editData->profile_image) : url('upload/no_image.jpg') }}" alt="Card image cap" data-holder-rendered="true" name="profile_image">
                            </div>
                        </div>
                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Update Profile">Update Profil</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

</div>
</div>

<!--script concernant le chargement de limage apres l'upload-->
<script type="text/javascript">
    
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection