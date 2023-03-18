@extends('auth.layouts.app')

@section('title', 'Create Pelatihan')

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pelatihan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('dashboard.index') }}">
                            {{-- <i class="flaticon-home"></i> --}}
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.training.create') }}">Create</a>
                    </li>
                    {{-- <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Starter Page</a>
                    </li> --}}
                </ul>
            </div>
            {{-- <div class="page-category">Inner page content goes here</div> --}}

            <div class="row">
                <div class="col-lg-12 py-3 mb-4">
                    <a href="{{ route('dashboard.training.index') }}" class="btn btn-outline-dark btn-round">
                        <i class="fas fa-undo"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('dashboard.training.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input type="text" class="form-control" name="code" placeholder="Code ..."
                                                required value="{{ old('code') }}">
                                            @error('code')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pelatihan</label>
                                            <input type="text" class="form-control" name="title"
                                                placeholder="Nama Pelatihan ..." required value="{{ old('title') }}">
                                            @error('title')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" name="year" id="year"
                                                placeholder="Tahun ..." required value="{{ old('year') }}">
                                            @error('year')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Durasi Pelatihan</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="hour"
                                                    placeholder="Durasi Pelatihan ..." value="{{ old('hour') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Jam</span>
                                                </div>
                                            </div>
                                            @error('hour')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Pelaksanaan</label>
                                            <input type="text" class="form-control" name="tanggal_pelaksanaan"
                                                value="{{ old('tanggal_pelaksanaan') }}">
                                            @error('tanggal_pelaksanaan')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Bertempat</label>
                                            <input type="text" class="form-control" name="tempat"
                                                placeholder="Nama Tempat Contoh : Puri Lesia (Betapus)"
                                                value="{{ old('tempat') }}">
                                            @error('tempat')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Category Pelatihan</label>
                                            <select name="category" class="form-control" required>
                                                <option value="">-pilih kategori pelatihan-</option>
                                                @foreach ($categories as $category)
                                                    @if (old('category') == $category->id)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->title }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3>Penerbitan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tanggal Terbit</label>
                                                <input type="text" class="form-control" name="tanggal_terbit"
                                                    placeholder="Samarinda, 01 Januari 2023">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Penandatangan</label>
                                                <select name="penandatangan" class="form-control">
                                                    <option value="">-pilih penandatangan-</option>
                                                    @foreach ($penandatangans as $penandatangan)
                                                        <option value="{{ $penandatangan->id }}">
                                                            {{ $penandatangan->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('penandatangan')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-outline-success btn-round float-right">
                                                    <i class="fas fa-plus"></i>
                                                    Added
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('#year').datetimepicker({
            format: 'YYYY',
        });
    </script>
@endpush
