@extends('Admin.Layout.app')

@section('heading', 'Add Online Poll')

@section('button')

    <a href="{{ route('admin_online_poll_show') }}" class="btn btn-primary"><i class="fas fa-eye"></i> view</a>

@endsection

@section('main_content')

    <div class="section-body">
        <form action="{{ route('admin_online_poll_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Create Online Poll</h5>

                            <div class="form-group mb-3">
                                <label>Question *</label>
                                <textarea name="question" class="form-control snote" cols="30" rows="10" style="height:150px;"></textarea>
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