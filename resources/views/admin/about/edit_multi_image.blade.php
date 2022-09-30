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

                    <h4 class="card-title mb-5">Edit Image</h4>

                    
                    <!-- enctype="multipart/form-data" car on upload une image tjr utilise là -->
                    <form method="POST" action="{{ route('update.multi.image') }}" enctype="multipart/form-data">
                        <!-- n'oublie pas aussi le @csrf tres important -->
                        @csrf
                        <input type="hidden" name="id" value="{{ $multi_image->id }}">
                        <!--image-->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label ps-5">About Image : </label>
                            <div class="col-sm-10">
                                
                                <input class="form-control" type="file" id="image" name="multi_image">
                            </div>
                        </div>

                        <!--image-->
                        <div class="row py-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" width="400" height="400" src="{{ ( url($multi_image->multi_image)) }}" alt="Card image cap" data-holder-rendered="true" name="multi_image">
                            </div>
                        </div>

                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Update Slide">Edit MultiImage</button>
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