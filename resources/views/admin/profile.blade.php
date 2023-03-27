@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-y-6 px-20 py-10 bg-white rounded-md shadow-sm md:gap-y-0 md:gap-x-10 md:flex-row">
        <div class="flex flex-col items-center justify-center">
            <div class="h-60 w-60 flex items-center rounded-full border-2 border-slate-100 overflow-hidden">
                <img src="{{ asset('storage/images/'.$user->image) }}" alt="" class="w-full h-full object-cover">
            </div>
        </div>
          
        {{-- <div class="px-10 text-2xl">
            <div>
                <h1 class="font-medium mb-2">Name</h1>
                <p class="bg-slate-100 rounded px-4 py-2">{{ $user->full_name }}</p>
            </div>
            <div class="mt-8">
                <h1 class="font-medium mb-2">Username</h1>
                <p class="bg-slate-100 rounded px-4 py-2">{{ $user->username }}</p>
            </div>
            <div class="mt-8">
                <h1 class="font-medium mb-2">Email</h1>
                <p class="bg-slate-100 rounded px-4 py-2">{{ $user->email }}</p>
            </div> --}}

            <div class="col-md-9 col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<div class="box-content card">
							<h4 class="box-title"><i class="fa fa-user ico"></i>About</h4>
							<!-- /.dropdown js__dropdown -->
							<div class="card-content">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>First Name:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">{{ $user->firstname }}</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Last Name:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">{{ $user->lastname }}</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>User Name:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">{{ $user->full_name }}</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Email:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">{{ $user->email }}</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Department:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">{{ $user->departments }} </div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Role:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">{{ $user->roles }}</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Birthday:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">Jan 22, 1984</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Interests:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">Basketball, Web, Design, etc.</div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Website:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><a href="#">yourwebsite.com</a></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label>Phone:</label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">+1-234-5678</div>
											<!-- /.col-xs-7 -->
										</div>
                                        <div class="mt-6">
                                            <a href="{{ route('admin.edit') }}" class="block text-center w-60 mt-10 px-6 py-3 text-white text-2xl rounded-lg bg-blue-500 hover:bg-blue-700">Edit</a>
                                        </div>
                                    
                                <div class="mt-6">
                                    <form action="{{ route('admin.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="custom-button w-60 block px-6 py-3 rounded-lg text-white" onclick="return confirm('Are you sure you want to delete the admin account?')" data-toggle="tooltip" data-placement="top" title="Delete">Delete Account</button>
                                        
                                    </form>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
								</div>
								<!-- /.row -->
							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content card -->
					</div>

                    
            </div>
        </div>
    </div>
</div>
@endsection