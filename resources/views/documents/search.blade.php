@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <!-- <div class="col-md-12"> -->
            <div class="input-group col-md-12 justify-content-center">
                <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/search') }}">
                    <input class="form-control mr-sm-2" style="width:350px;" name="query" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari Dokumen</button>
                </form>
                <div class="ml-auto">
                    <a href="{{ route('upload')}}" class="btn btn-success"><i class='fa fa-upload mr-2'></i>Upload Dokumen</a>
                </div>
            </div>
        <!-- </div> -->
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include ('layouts._message')
            <div class="card">
                <div class="card-body">
                        @foreach ($documents as $document)

                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><a href="/files/{{$document->id}}" target="_blank">{{ $document->title }}</a> </h4> 
                                <p class="lead">
                                    Upload by
                                    <a href="#"> {{ $document->user->name }} </a>
                                    <small class="text-muted">| {{ Carbon\carbon::parse($document->created_at)->isoFormat('dddd, D MMM Y') }}</small>
                                </p>
                                <p>{{ Str::limit($document->description,250) }}</p>
                            

                                <div class="ml-auto">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form class="form-delete mr-2" action="{{ route('destroy', $document->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure delete {{ $document->id }} ?')">
                                            <i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Hapus</button>
                                        </form>
                                        
                                        <form method="get" action="/edit/{{$document->id}}">
                                            <button  class="btn btn-outline-info btn-sm mr-2" type="submit"><i class="fa fa-pencil mr-2" aria-hidden="true"></i>Edit</button>
                                        </form>
                                        <form method="get" action="/file/download/{{$document->file}}">
                                            <button class="btn btn-outline-success btn-sm mr-2" type="submit"><i class="fa fa-download mr-2" aria-hidden="true"></i>Download</button>
                                        </form>
                                    </div>
                                </div> 
                        </div>
                        <hr>
                        @endforeach

                        <div class="pagination justify-content-center">
                            {{$documents->links("pagination::bootstrap-4")}}
                        </div>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
