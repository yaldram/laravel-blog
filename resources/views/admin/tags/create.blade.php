@extends('layouts.backend.app')

@section('title', 'Create Tags')

@push('css')

@endpush

@section('content')
	<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                       Add New Tags
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('admin.tags.store') }}" method="post">
                    	@csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name">
                                <label class="form-label">Tag Name</label>
                            </div>
                        </div>
                        <br>
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
   </div>
@endsection

@push('js')

@endpush
