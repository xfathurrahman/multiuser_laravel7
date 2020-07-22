@extends('layouts.admin')
	@section('content') 
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary my-3">
				<div class="card-header">
					<div class="pull-left">
						<h3 class="card-title">{{ __('User Management') }}</h3>		
					</div>
					
					<div class="card-tools">
					<a class="btn btn-xs btn-success" href="{{ route('user.create') }}">
						{{ __('Create New User') }}
					</a>
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
					</div>
				</div>

				<div class="card-body">
		@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<p>{{ $message }}</p> 
			</div>
		@endif
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Email</th>
				<th>Roles</th>
				<th width="280px">Action</th>
			</tr>
			</thead>
			<?php $i=0;?>
			<tbody>
			@forelse ($data as $key => $user)
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
				{{ ($user->role==2? "Customer": "User") }}
				</td>
				<td>
					<a class="btn btn-info" 
					href="{{ route('user.show',$user->id) }}">Show
					</a> 
					<a class="btn btn-primary" 
					href="{{ route('user.edit',$user->id) }}">Edit
					</a> 
					{!! Form::open(['method' => 'DELETE', 
					'route' => ['user.destroy', $user->id], 
					'style' => 'display:inline']) !!} 

					{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} 
					{!! Form::close() !!} 
				</td>
			</tr> 
			@empty
			<tr><td colspan="5">No User Record Found</td></tr>
		@endforelse
		</tbody> 
	</table>
	</div>
            </div>
        </div>
    </div>
</div>
@endsection
