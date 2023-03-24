@extends('auth.layouts.app')

@section('title', 'Create Peserta')

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pelatihan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('dashboard.training.index') }}">
                            <i class="fas fa-book-reader"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.training.create.peserta', $training->slug) }}">Tambah Peserta</a>
                    </li>
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
            <form action="{{ route('dashboard.training.store.peserta', $training->slug) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Kode Pelatihan</label>
                                            <input type="text" class="form-control" value="{{ $training->code }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Nama Pelatihan</label>
                                            <input type="text" class="form-control" name="training"
                                                value="{{ $training->id }}" disabled hidden>
                                            <input type="text" class="form-control" value="{{ $training->title }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Kode Peserta</label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                name="code" placeholder="Nama Peserta ..."
                                                value="{{ str_pad($participants, 4, '0', STR_PAD_LEFT) }}">
                                            @error('code')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Nama Peserta</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Nama Peserta ...">
                                            @error('name')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>NIP/NIPPPK/NRTK2D</label>
                                            <input type="text" class="form-control" name="nip"
                                                placeholder="NIP/NIPPPK/NRTK2D ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <input type="text" class="form-control" name="birth"
                                                placeholder="Tempat, tanggal lahir">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pangkat/Golongan</label>
                                            <input type="text" class="form-control" name="pangkat_golongan"
                                                placeholder="Pangkat/Golongan ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" name="jabatan"
                                                placeholder="Jabatan ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Instansi</label>
                                            <input type="text" class="form-control" name="instansi"
                                                placeholder="Instansi ...">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Role</label>
                                            <select name="role"
                                                class="form-control text-capitalize @error('name') is-invalid @enderror">
                                                <option value="">-select role-</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-success btn-round float-right">
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
            </form>

        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    </script>
@endpush
