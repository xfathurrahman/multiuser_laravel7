@extends('layouts.admin') 
@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary my-3">
                <div class="card-header">	
					<div class="pull-left">
						<h3 class="card-title">{{ __('User Details') }}</h3>		
					</div>
					
					<div class="card-tools">
					<a class="btn btn-xs btn-success" 
						href="{{ route('user.index') }}">{{ __('Back') }}</a>
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
					</div>

				</div>

            <div class="card-body">
				<div class="form-group row py-3">
						<label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }} </label>

						<div class="col-md-6">
                            {{ $user['first_name'] }}
						</div>
					</div>

					<div class="form-group row py-3">
						<label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }} </label>

						<div class="col-md-6">
                            {{ $user['middle_name'] }}}
						</div>
					</div>

					<div class="form-group row py-3">
						<label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }} </label>

						<div class="col-md-6">
                            {{ $user['last_name'] }}
						</div>
					</div>
		
				<div class="form-group row py-3">
				<label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }} </label>

					<div class="col-md-6">
						<p>{{$user['address']}}</p>
					</div>
				</div>

					<div class="form-group row py-3">
						<label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }} </label>

						<div class="col-md-6">
                            {{ $user['mobile'] }}
						</div>
					</div>

					<div class="form-group row py-3">
						<label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }}</label>

						<div class="col-md-6">
                            {{$countries->name}}
						</div>
					</div>

					<div class="form-group row py-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State Name') }}</label>

                            <div class="col-md-6 py-2">
                                {{$states->name}}
                            </div>
                        </div>
                        

                        <div class="form-group row py-3">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                {{ $user['city'] }}
                            </div>
                        </div>

                        <div class="form-group row py-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }} </label>

                            <div class="col-md-6">
                                {{ $user['name'] }}
                            </div>
                        </div>

                        <div class="form-group row py-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} </label>
                            <div class="col-md-6">
                                {{ $user['email'] }}
                            </div>
                        </div>

                        
                        <div class="form-group row radio py-3">
                            <label for="gender_m" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                {{ $user["gender"] }}
                            </div>
                        </div>
                        
                        <div class="form-group row check py-3">
                            <label for="hobbies_s" class="col-md-4 col-form-label text-md-right">{{ __('Hobbies') }} </label>

                            <div class="col-md-6">
                            <?php $hobbies=explode(",", $user["hobbies"]); ?>
                            @forelse($hobbies as $val)
                                <p>{{ $val }}</p>
                            @empty
                                <p>{{ __('No Hobbies') }}</p>
                            @endforelse

                            </div>
                        </div>

                        <div class="form-group row py-3">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }} </label>
                            <div class="col-md-6">
                            @if($user['profile_image'])
                            <img src="{{asset('/storage/profile_images/'.$user['profile_image'])}}" width="40" />
                            @endif
                            </div>
                        </div>
			</div>
            </div>
        </div>
    </div>
</div>
@endsection