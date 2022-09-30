@extends('admin.admin_master')
@section('id_admin')
<!--script concernant le chargement de limage apres l'upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- style pour les tags -->
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #ff0000 !important;
        font-weight: 700px;
    } 
</style>

<div class="page-content">
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Edit Blog Page</h4>

                    
                    <!-- enctype="multipart/form-data" car on upload une image tjr utilise là -->
                    <form method="POST" action="{{ route('update.blog') }}" enctype="multipart/form-data">
                        <!-- n'oublie pas aussi le @csrf tres important -->
                        @csrf

                        <input type="hidden" name="id" value="{{ $blog->id }}">
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Category</label>
                            <div class="col-sm-11">
                                <select class="form-select" name="category_id" aria-label="Default select example">
                                    <option selected>Choose one Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $blog->blog_category_id ? 'selected' : '' }} >{{ $cat->blog_category }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Title</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text" value="{{ $blog->blog_title }}" name="title">
                                    @error('title')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Tags</label>
                            <div class="col-sm-11">
                                <input class="form-control" value="{{ $blog->blog_tags }}" data-role="tagsinput" type="text" name="tags">
                                @error('tags')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Description</label>
                            <div class="col-sm-11">
                                <textarea id="elm1" class="form-control" name="description">{{ $blog->blog_description }}</textarea>
                                    @error('description')
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
                            </div>
                            
                        </div>
                        <!--image-->
                        <div class="row py-3">
                            <label class="col-sm-1 col-form-label ps-4"></label>
                            <div class="col-sm-11">
                                <img id="showImage" class="rounded avatar-lg" width="400" height="400" src="{{ url($blog->blog_image) }}" data-holder-rendered="true" name="image">
                            </div>
                        </div>
                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Update Portfolio">Update a Blog</button>
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