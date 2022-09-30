@extends('admin.admin_master')
@section('id_admin')

<div class="page-content">
<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-5">Add Category Page</h4>

                    <form method="POST" action="{{ route('store.category') }}">
                        
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-1 col-form-label ps-3">Category</label>
                            <div class="col-sm-11">
                                <input class="form-control" type="text"  name="blog_category">
                                    @error('blog_category')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                        <!--boutton d'envoie-->
                        <div class="row mb-3">                      
                            <div class="">
                                <button type="submit" class="btn btn-info" value="Add Category">Add Category</button>
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