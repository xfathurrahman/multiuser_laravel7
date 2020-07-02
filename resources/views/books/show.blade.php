@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Book Details</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @if(Auth::user()->role===3)
          <li class="breadcrumb-item"><a href="{{ url('user/'.Auth::user()->id) }}">Home</a></li>
          @endif
          @if(Auth::user()->role===2)
          <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Home</a></li>
          @endif
          @if(Auth::user()->role===1)
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          @endif
          <li class="breadcrumb-item active">Book Management</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">{{ __('Book Details') }}
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="book_name" class="col-md-4 col-form-label text-md-right">
                        {{ __('Book Name') }} : </label>
                        <div class="col-md-6">
                            {{$book->book_name}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="isbn_number" class="col-md-4 col-form-label text-md-right">
                        {{ __('ISBN Number') }} : </label>
                        <div class="col-md-6">
                            {{$bbok->isbn_number}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="received_date" class="col-md-4 col-form-label text-md-right">
                        {{ __('Received Date') }} : </label>
                        <div class="col-md-6">
                            {{$book->received_date}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="del_date" class="col-md-4 col-form-label text-md-right">{{ __('Delivery Date') }} : </label>
                        <div class="col-md-6">
                            {{$book->delivery_date}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="author_first_name" class="col-md-4 col-form-label text-md-right">{{ __('Author First Name') }} *</label>
                        <div class="col-md-6">
                            {{$book->author_first_name}}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="author_last_name" class="col-md-4 col-form-label text-md-right">{{ __('Author Last Name') }} *</label>
                        <div class="col-md-6">
                            {{$book->author_last_name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
