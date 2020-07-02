@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            {{ session('status') }}
                        </div>
                    @endif

                    As a Admin Role You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
