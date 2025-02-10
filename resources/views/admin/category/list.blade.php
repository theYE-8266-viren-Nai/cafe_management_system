@extends('admin.layouts.master')
@section('title','Category list')
@section('content')
<div class="section__content section__content--p10">
    <div class="">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <form action="{{ route('category#list') }}" method="GET" class="p-6" style="max-width: 500px; margin: 0 auto;">
                    @csrf
                    <div class="mb-3 md-form input-group">
                        <input type="text" name="key" id="searchInput" class="form-control" placeholder="Search products..." required>
                        <div class="input-group-append">
                            <button type="submit" class="px-3 m-0 btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="table-data__tool-left">
                    <div class="overview-wrap">

                        <h2 class="title-1">Category List</h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('category#createPage') }}">

                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Add Category
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
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
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories) != 0)
                        @foreach($categories as $category )
                        <tr class="tr-shadow">
                            <td>{{ $category->category_id }}</td>
                            <td>
                                <span class="">{{ $category->name }}</span>
                            </td>
                            <td class="desc">{{ $category->created_at->format('j-F-Y') }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="zmdi zmdi-eye"></i>
                                    </button>
                                    <a href="{{ route('category#viewUpdate', $category->category_id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('category#delete', $category->category_id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">
                                <h5>There is no category here</h5>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

<div class="">
    {{ $categories->links() }}
</div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>


@endsection
