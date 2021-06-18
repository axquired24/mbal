<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5>Upload Dokumen</h5>
                        <div class="ml-auto">
                            <a href="{{ route('documents')}}" class="btn btn-outline-secondary"><i class='fa fa-arrow-circle-left mr-2'></i>Kembali</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('store')}}" method="post" enctype="multipart/form-data" class="justify-content-center col-md-12">
                        @csrf
                        <div class="form-group row" style="text-align:right;">
                            <div class="col-sm-2" ></div>
                            <label for="titel" class="col-sm-2 col-form-label">Nama Dokumen</label>
                            <div class="col-sm-6">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" name="title" id="title" placeholder="Ketik Nama Dokumen">
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" style="text-align:right;">
                            <div class="col-sm-2" ></div>
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun Dokumen</label>
                            <div class="col-sm-4">
                                <input  class="form-control {{ $errors->has('tahun') ? 'is-invalid' : ''}}" type="number" value="{{ old('tahun')}}" placeholder="click untuk menampilkan tahun"  id="tahun" name="tahun">
                                @if ($errors->has('tahun'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('tahun') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" style="text-align:right;">
                            <!-- <div class="col-sm-2" ></div> -->
                            <label for="desc" class="col-sm-4 col-form-label">Keterangan Dokumen</label>
                            <div class="col-sm-6">
                                <textarea class="form-control {{ $errors->has('desc') ? 'is-invalid' : ''}}" name="desc" id="desc" rows="5">{{ old('desc') }}</textarea>
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
                                <input type="file" name="file" class="form-control-file {{ $errors->has('file') ? 'is-invalid': '' }}" id="file">
                                @if ($errors->has('file'))
                                    <div class="invalid-feedback" style="text-align:left;">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row" >
                            <div class="col-sm-2" ></div>
                            <label for="titel" class="col-sm-2"></label>
                            <div class="col-sm-6" style="text-align:left;">
                                <button type="submit" class="btn btn-success"><i class='fa fa-upload mr-2'></i>Upload</button>
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

<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#tahun').datepicker({
                    minViewMode: 'years',
                    autoclose: true,
                     format: 'yyyy'
                });  
            
            });
        </script>