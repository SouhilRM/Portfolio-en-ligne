@extends('admin.admin_master')
@section('id_admin')

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">All Contacts</h4>                
            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-3">Contacts</h4>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap table-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-secondary">
                        <tr>
                            <th>N°</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Phone</th>
                            <th>Created_At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                            @php($i = 1)
                    
                            @foreach($contacts as $item)
                                <tr class="align-middle">

                                    <td>{{ $i++ }}</td>

                                    <td>{{ $item->name }}</td>

                                    <td>{{ $item->email }}</td>

                                    <td>{{ $item->subject }}</td>

                                    <td>{{ $item->phone }}</td>

                                    <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                    
                                    <td>
                                        
                                        <a href="{{ route('show.message',$item->id) }}" type="button" class="btn btn-info">Show Message</a>
                                        <a href="{{ route('delete.contact',$item->id) }}" class="btn btn-danger sm" title="delete" id="delete"><i class="fas fa-trash-alt"></i></a>
                                    </td>

                                </tr>   
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    
    
</div> <!-- container-fluid -->
</div>

@endsection