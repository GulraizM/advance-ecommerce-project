@extends('frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top" style="border-radius: 90%" src="{{ (!empty($user->profile_photo_path))
                    ? url('upload/user_images/'.$user->profile_photo_path)
                    :url('upload/no_image.jpg') }}" height="100%" width="100%"><br><br>

                    <ul class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block" >Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block" >Profile Update</a>
                        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block" >Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block" >Logout</a>
                    </ul>
            </div> {{--   end col md 2 --}}

            <div class="col-md-2">
                
            </div> {{--   end col md 2 --}}

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi...</span> 
                            <strong>{{ Auth::user()->name }}</strong> Profile Update                       
                    </h3>

                    <div class="card-body">
                        <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <h5>Name <span class="text-danger"></span></h5>
                            <div class="controls">
                            <input type="text" id="name" name="name" class="form-control" required="" value="{{ $user->name }}" ></div>
                        </div>

                        <div class="form-group">
                            <h5>Email <span class="text-danger"></span></h5>
                            <div class="controls">
                            <input type="email" id="email" name="email" class="form-control" required="" value="{{ $user->email }}" ></div>
                        </div>

                        <div class="form-group">
                            <h5>Profile Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="profile_photo_path" class="form-control" required="" id="image" ></div>
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-danger mb-5" value="Update"
                        </div>
                        </div>
                        
                    </div>    

                </div>
                
            </div> {{--   end col md 6 --}}


        </div> {{-- // end row --}}
    </div>
</div>



@endsection
