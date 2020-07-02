@extends('layouts.admin')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Management</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @if(Auth::user()->role===3)
          <li class="breadcrumb-item"><a href="{{ url('userprofile/'.Auth::user()->id) }}">Home</a></li>
          @endif
          @if(Auth::user()->role===2)
          <li class="breadcrumb-item"><a href="{{ url('clientsprofile/'.Auth::user()->id) }}">Home</a></li>
          @endif
          @if(Auth::user()->role===1)
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          @endif
          <li class="breadcrumb-item active">User Management</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


    <section class="content">
      <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">User Management</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>DOB</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{date('d-m-Y', strtotime($user->dob))}}</td>
                <td>{{$user->status}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>DOB</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection
