@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <!-- <div class="col-md-12"> -->
            <div class="input-group col-md-12 justify-content-center">
                <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/search') }}">
                    <input class="form-control mr-sm-2" style="width:350px;" name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <div class="ml-auto">
                    <a href="{{ route('create')}}" class="btn btn-success"><i class='fa fa-user-plus mr-2'></i>Create User</a>
                </div>
            </div>
        <!-- </div> -->
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include ('layouts._message')
            <div class="card">
                <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0 ?>
                        @foreach ($users as $user)
                        <?php $no++ ?>
                        <tr>
                            <th scope="row">{{$no}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="" class="btn btn-success btn-sm"><i class="fa fa-pencil mr-2"></i>Edit</a>
                                <form class="form-delete mr-2" action="{{ route('destroy', $user->id)}}" method="post" style="display:inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete?')">
                                    <i class="fa fa-trash mr-2"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
