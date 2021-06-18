@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="input-group col-md-12 justify-content-center">
            <form class="form-inline my-2 my-lg-0" type="get" action="{{ url('/search') }}">
                <input class="form-control mr-sm-2 {{ $errors->has('query') ? 'is-invalid' : ''}}" style="width:350px;"
                    name="query" type="search" placeholder="Search" aria-label="Search">
                @if ($errors->has('query'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('query') }}</strong>
                </div>
                @endif
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari Dokumen</button>
            </form>
            <div class="ml-auto">
                <a href="{{ route('upload')}}" class="btn btn-success"><i class='fa fa-upload mr-2'></i>Upload
                    Dokumen</a>
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionExample">
        @php
            $first_year = $documents->keys()->first();
        @endphp
        @foreach ($documents as $tahun => $items)
        <div class="card">
            <div class="card-header" id="heading-{{ $tahun }}">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$tahun}}"
                        aria-expanded="true" aria-controls="collapseOne">
                        {{$tahun}}
                    </button>
                </h2>
            </div>
            <div id="collapse{{$tahun}}" class="collapse {{ $first_year == $tahun ? 'show' : null }}" aria-labelledby="heading-{{ $tahun }}"
                data-parent="#accordionExample">
                @foreach($items as $document)
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading"><a href="/files/{{$document->id}}"
                                    target="_blank">{{ $document->title }}</a> </h4>
                            <p class="lead">
                                Di Upload oleh :
                                <a href="#" style="color:green;"> {{ $document->user->name }} </a>
                                <small class="text-muted">|
                                    {{ Carbon\carbon::parse($document->created_at)->isoFormat('dddd, D MMM Y') }}</small>
                            </p>
                            <p>{{ Str::limit($document->description,250) }}</p>

                            <div class="ml-auto">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form class="form-delete mr-2" action="{{ route('destroy', $document->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Apakah yakin akan menghapus dokumen {{$document->title}}?')">
                                            <i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Hapus</button>
                                    </form>
                                    <form method="get" action="/edit/{{$document->id}}">
                                        <button class="btn btn-outline-info btn-sm mr-2" type="submit"><i
                                                class="fa fa-pencil mr-2" aria-hidden="true"></i>Edit</button>
                                    </form>
                                    <form method="get" action="/file/download/{{$document->file}}">
                                        <button class="btn btn-outline-success btn-sm mr-2" type="submit"><i
                                                class="fa fa-download mr-2" aria-hidden="true"></i>Download</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
