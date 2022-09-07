@extends('Admin.Layout.app')

@section('heading', 'Add Photo')

@section('button')

    <a href="{{ route('admin_photo_show') }}" class="btn btn-primary"><i class="fas fa-eye"></i> view</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_photo_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Create Photo</h5>

                            <div class="form-group mb-3">
                                <label>Chose Photo *</label>
                               <div><input type="file" name="photo"></div> 
                            </div>

                            <div class="form-group mb-3">
                                <label>Enter The Caption *</label>
                                <input type="text" class="form-control" name="caption">
                            </div>

                        </div>
                    </div>
                </div>


              </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection