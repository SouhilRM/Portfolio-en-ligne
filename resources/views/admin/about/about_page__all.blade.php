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

                    <h4 class="card-title mb-5">Edit About Page</h4>

                    
                    <!-- enctype="multipart/form-data" car on upload une image tjr utilise là -->
                    <form method="POST" action="{{ route('uptade.about') }}" enctype="multipart/form-data">
                        <!-- n'oublie pas aussi le @csrf tres important -->
                        @csrf
                        
                        <!-- un input de type hidden qui va envoyer l'id pour permettre la modification -->
                        <!-- petite remarque tu pouvais ausi passer l'id à linterieur de la balise form dans le champs action comme suit : action="{{ route('update.slide',$about->id) }}" -->
                        <input type="hidden" name="id" value="{{ $about->id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Title</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $about->title }}" name="title" id="title">
                                @error('title')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Short Title</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $about->short_title }}" id="short_title" name="short_title">
                                @error('short_title')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Short Description</label>
                            <div class="col-sm-11">
                                <textarea class="form-control" aria-label="With textarea" id="video_url" name="short_description">{{ $about->short_description }}</textarea>
                            </div>  
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Long Description</label>
                            <div class="col-sm-11">
                                <textarea id="elm1" class="form-control" name="long_description">{{ $about->long_description }}</textarea>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Image</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="file" id="image" name="about_image">
                            </div>
                        </div><!-- end row -->
                        <!--image-->
                        <div class="row py-3">
                            <label class="col-sm-1 col-form-label ps-4"></label>
                            <div class="col-sm-11">
                                <img id="showImage" class="rounded avatar-lg" width="400" height="400" src="{{ ( !empty( $about->about_image ) ) ? url($about->about_image) : url('upload/no_image.jpg') }}" alt="Card image cap" data-holder-rendered="true" name="about_image">
                            </div>
                        </div><br><br>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">CV.pdf</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="file" id="pdf" name="pdf">
                            </div>
                        </div><!-- end row -->
                        <br><br>
                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Update Slide">Update About Page</button>
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