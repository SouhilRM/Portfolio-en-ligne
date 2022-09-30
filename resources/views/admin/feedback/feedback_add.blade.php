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

                    <h4 class="card-title mb-5">Add FeedBack Page</h4>

                    <form method="POST" action="{{ route('store.feedback') }}" enctype="multipart/form-data">
                        
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Name</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text"  name="nom">
                                    @error('nom')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Message</label>
                            <div class="col-sm-11">
                                <textarea class="form-control" aria-label="With textarea" id="video_url" name="message"></textarea>
                                @error('message')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>  
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Image</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="file" id="image" name="image">
                                @error('image')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                        </div>
                        <!--image-->
                        <div class="row py-3">
                            <label class="col-sm-1 col-form-label ps-4"></label>
                            <div class="col-sm-11">
                                <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" data-holder-rendered="true" name="image">
                            </div>
                        </div>
                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Add Feed Back">Add Feed Back</button>
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