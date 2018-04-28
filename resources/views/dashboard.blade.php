@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                        <form action="{{ url('/user/1/upload') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control" name="id" value="1">
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Upload</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
