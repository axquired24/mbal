@extends('layouts.app')

@section('content')
<div class="container">

    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5>Update Dokumen</h5>
                        <div class="ml-auto">
                            <a href="{{ route('documents')}}" class="btn btn-outline-secondary"><i class='fa fa-arrow-circle-left mr-2'></i>Kembali</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('update', $documents->id) }}" method="post" enctype="multipart/form-data" class="justify-content-center col-md-12">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row" style="text-align:right;">
                            <div class="col-sm-2" ></div>
                            <label for="titel" class="col-sm-2 col-form-label">Nama Dokumen</label>
                            <div class="col-sm-6">
                                <input type="text"  value="{{ old('title',$documents->title) }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" name="title" id="title" placeholder="Ketik Nama Document">
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" style="text-align:right;">
                            <!-- <div class="col-sm-2" ></div> -->
                            <label for="desc" class="col-sm-4 col-form-label">Keterangan Dokumen</label>
                            <div class="col-sm-6">
                                <textarea class="form-control {{ $errors->has('desc') ? 'is-invalid' : ''}}" name="desc" id="desc" rows="5">{{ old('desc', $documents->description) }}</textarea>
                                @if ($errors->has('desc'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" style="text-align:right;">
                            <div class="col-sm-2" ></div>
                            <label for="file" class="col-sm-2">File</label>
                            <div class="col-sm-6">
                                <input type="file" name="file"  class="form-control-file" id="file">
                            </div>
                        </div>

                        <div class="form-group row" >
                            <div class="col-sm-2" ></div>
                            <label for="titel" class="col-sm-2"></label>
                            <div class="col-sm-6" style="text-align:left;">
                                <button type="submit" class="btn btn-success"><i class='fa fa-save mr-2'></i>Update</button>
                            </div>
                        </div>
                    </form>
                        
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


