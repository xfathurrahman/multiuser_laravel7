@extends('layouts.admin')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header ">
            <h3 class="card-title">{{ __('User Profile') }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
                <div class="row">
                    <label class="col-md-2 ">{{ __('First Name') }} : </label>
                    <div class="col-md-4">
                    {{$user->first_name}}
                    </div>
                
                    
                    <label class="col-md-2  ">{{ __('Middle Name') }} : </label>
                    <div class="col-md-4">
                    {{$user->middle_name}}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-2 ">{{ __('Last Name') }} : </label>
                    <div class="col-md-4">
                    {{$user->last_name}}
                    </div>
                    
                    <label class="col-md-2 ">{{ __('Client Name') }} : </label>
                    <div class="col-md-4">
                    {{$clients->name}}
                    </div>
                </div>



                <div class="row">
                    <label class="col-md-2">{{ __('Address') }} : </label>
                    <div class="col-md-4">
                        {{$user->address}}
                    </div>
                    <label class="col-md-2">{{ __('Mobile Number') }} : </label>
                    <div class="col-md-4">
                        {{$user->mobile}}
                    </div>
                </div>

                

                <div class="row">
                    <label class="col-md-2">{{ __('Country Name') }} : </label>
                    <div class="col-md-4">
                        <!-- {{$user->countryname}} -->
                        {{$country->name}}
                    </div>
                    
                    <label class="col-md-2">{{ __('State Name') }} : </label>
                    <div class="col-md-4">
                        <!-- {{$user->statename}} -->
                        {{$state->name}}
                    </div>
                </div>

                

                <div class="row">
                    <label class="col-md-2">{{ __('City') }} : </label>
                    <div class="col-md-4">
                        {{$user->city}}
                    </div>

                    <label class="col-md-2">{{ __('User Name') }} : </label>
                    <div class="col-md-4">
                        {{$user->name}}
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-2">{{ __('E-Mail Address') }} : </label>
                    <div class="col-md-4">
                        {{$user->email}}
                    </div>

                    <label class="col-md-2">{{ __('Gender') }} : </label>
                    <div class="col-md-4">
                        {{$user->gender}}
                    </div>
                </div>

                
                
                <div class="row">
                    <label class="col-md-2 ">{{ __('Hobbies') }} : </label>
                    <div class="col-md-4">
                    <?php $hobbies=(is_null($user->hobbies))? []:explode(",", $user->hobbies); ?>
                    @forelse($hobbies as $hobbie)
                        <p>{{$hobbie}} </p>
                    @empty
                        {{ __('No Hobbies') }}
                    @endforelse
                    </div>
                    <label  class="col-md-2 ">{{ __('Photo') }} </label>
                    <div class="col-md-4">
                    @if($user->profile_image)
                        <img src="{{asset('/storage/profile_images/'.$user->profile_image)}}" width="40" />
                        @else
                        {{ __('No Photo') }}
                    @endif
                    </div>
                </div>
                
                
          </div>
          <!-- /.card-body -->
        </div>
      </diWv>
    </div>
</section>
@endsection
