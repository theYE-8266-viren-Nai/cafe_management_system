@extends('admin.layouts.master')
@section('title', 'Admin List')
@section('content')
<div class="section__content section__content--p10">
    <div class="container">
        <div class="col-md-12">
            <!-- Header and Actions -->
           <a href="{{ route('admin.adminList.view') }}">
            <button type="button" class="btn btn-primary" >
                <i class="fa-solid fa-arrows-rotate"></i> Refresh
            </button>
           </a>
            <div class="table-data__tool">
                <form action="" method="GET" class="p-6" style="max-width: 500px; margin: 0 auto;">
                    @csrf
                    <div class="mb-3 md-form input-group">
                        <input type="text" name="key" id="searchInput" class="form-control" placeholder="Search admins..." required>
                        <div class="input-group-append">
                            <button type="submit" class="px-3 m-0 btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Admin List</h2>
                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i> Add Admin
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV Download
                    </button>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('update_password'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('update_password') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('delSuccess'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('delSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Admin Table -->
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($admin->count())
                        {{--  @dd($admin->toArray());  --}}
                            @foreach($admin as $adminList)
                            <tr class="tr-shadow">
                                <td>{{ $adminList->id }}</td>
                                @if($adminList['profile_photo_path'])
                                <td class="text-center">
                                    <img src="{{ asset('storage/'. $admin['profile_photo_path']) }}" alt="Admin Image" class="img-thumbnail" style="width: 80px; height: auto;">
                                </td>
                                @else
                                    <td>no pictures</td>
                                @endif
                                <td>{{ $adminList->name }}</td>
                                <td>{{ $adminList->email }}</td>
                                <td>{{ $adminList->role ?? 'No Role' }}</td>
                                <td>{{ $adminList->status }}</td>

                                <td class="">
                                    <div class="table-data-feature">
                                          <a href="">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="zmdi zmdi-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{  route('admin.adminList.roleChange' ,$adminList->id )}}" onclick="return confirm('Are you sure you want to change the role?');" style="display: inline;">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="role change">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.adminList.delete' ,$adminList->id ) }}" method="get" onsubmit="return confirm('Are you sure you want to delete this admin?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h5>No admins available.</h5>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $admin->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
