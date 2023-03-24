@extends('auth.layouts.app')

@section('title', 'Peserta Pelatihan')

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Peserta</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('dashboard.participant.show.peserta', $training->slug) }}">
                            <i class="fas fa-users"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <span>{{ $training->title }}</span>
                    </li>
                </ul>
            </div>
            {{-- <div class="page-category">Inner page content goes here</div> --}}

            {{-- Notify Success --}}
            <div id="flashSuccess" data-flash="{{ session('success') }}"></div>
            {{-- Notify --}}
            <div id="flashFails" data-flash="{{ session('fails') }}"></div>

            <div class="row">
                <div class="col-lg-12 py-3 mb-4">
                    <a href="{{ route('dashboard.training.index') }}" class="btn btn-outline-dark btn-round">
                        <i class="fas fa-undo"></i>
                        Kembali
                    </a>
                    <a href="{{ route('dashboard.participant.export.peserta', $training->slug) }}"
                        class="btn btn-info btn-round ml-2" target="_blank">
                        <i class="fas fa-file-download"></i>
                        Export
                    </a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>
                                {{ $training->title }}
                            </h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatables" class="display table table-striped table-hover" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Peserta</th>
                                            <th>Nama Peserta</th>
                                            <th>NIP/NIPPPK/NRTK2D</th>
                                            <th>Role Peserta</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant)
                                            <tr class="text-center">
                                                <td>{{ $participant->code }}</td>
                                                <td>{{ $participant->name }}</td>
                                                <td>{{ $participant->nip }}</td>
                                                <td>{{ $participant->role->title }}</td>
                                                <td>
                                                    <form id="form-delete-{{ $training->id }}"
                                                        action="{{ route('dashboard.participant.delete.peserta', $participant->code) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('dashboard.participant.edit.peserta', $participant->code) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="btnDelete( {{ $training->id }} )">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
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

        </div>
    </div>

@endsection

@push('scripts')
    {{-- Notify --}}
    <script>
        var flash = $('#flashSuccess').data('flash');
        if (flash) {
            $.notify({
                // options
                icon: 'fas fa-check',
                title: 'Berhasil',
                message: '{{ session('success') }}',
            }, {
                // settings
                type: 'success',
            });
        }
    </script>

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

    {{-- SweetAlert Confirmation --}}
    <script>
        function btnDelete(id) {
            swal({
                title: 'Apa anda yakin?',
                text: "Data tidak dapat di kembalikan setelah ini !!!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, hapus sekarang',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $('#form-delete-' + id).submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>

    <script>
        $('#datatables').DataTable();
    </script>
@endpush
