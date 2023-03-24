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
                        <span>{{ $participant->training->title }}</span>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <span>Edit Peserta</span>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <span>{{ $participant->name }}</span>
                    </li>
                </ul>
            </div>

            {{-- Notify --}}
            <div id="flashFails" data-flash="{{ session('fails') }}"></div>

            <div class="row">
                <div class="col-lg-12 py-3 mb-4">
                    <a href="{{ route('dashboard.participant.show.peserta', $participant->training->slug) }}"
                        class="btn btn-outline-dark btn-round">
                        <i class="fas fa-undo"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <form action="{{ route('dashboard.participant.update.peserta', $participant->code) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Kode Pelatihan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $participant->training->code }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Nama Pelatihan</label>
                                            <input type="text" class="form-control" name="training"
                                                value="{{ $participant->training->id }}" disabled hidden>
                                            <input type="text" class="form-control"
                                                value="{{ $participant->training->title }}" disabled>
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
                                                name="code" placeholder="Kode Peserta ..."
                                                value="{{ old('code', $participant->code) }}">
                                            @error('code')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Nama Peserta</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Nama Peserta ..."
                                                value="{{ old('name', $participant->name) }}">
                                            @error('name')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>NIP/NIPPPK/NRTK2D</label>
                                            <input type="text" class="form-control" name="nip"
                                                placeholder="NIP/NIPPPK/NRTK2D ..."
                                                value="{{ old('nip', $participant->nip) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <input type="text" class="form-control" name="birth"
                                                placeholder="Tempat, tanggal lahir"
                                                value="{{ old('birth', $participant->birth) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pangkat/Golongan</label>
                                            <input type="text" class="form-control" name="pangkat_golongan"
                                                placeholder="Pangkat/Golongan ..."
                                                value="{{ old('pangkat_golongan', $participant->pangkat_golongan) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" name="jabatan"
                                                placeholder="Jabatan ..."
                                                value="{{ old('jabatan', $participant->jabatan) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Instansi</label>
                                            <input type="text" class="form-control" name="instansi"
                                                placeholder="Instansi ..."
                                                value="{{ old('instansi', $participant->instansi) }}">
                                        </div>
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span>Role</label>
                                            <select name="role"
                                                class="form-control text-capitalize @error('name') is-invalid @enderror">
                                                <option value="">-select role-</option>
                                                @foreach ($roles as $role)
                                                    @if (old($role->id, $participant->role_id) == $role->id)
                                                        <option value="{{ $role->id }}" selected>{{ $role->title }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $role->id }}">{{ $role->title }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-success btn-round float-right">
                                                <i class="fas fa-sync"></i>
                                                Update
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
        var flash = $('#flashFails').data('flash');
        if (flash) {
            $.notify({
                // options
                icon: 'fas fa-ban',
                title: 'Gagal',
                message: '{{ session('fails') }}',
            }, {
                // settings
                type: 'danger',
            });
        }
    </script>
    <script>
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    </script>
@endpush
