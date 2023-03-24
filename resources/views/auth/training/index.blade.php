@extends('auth.layouts.app')

@section('title', 'Pelatihan')

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Pelatihan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="fas fa-book-reader"></i>
                        </a>
                    </li>
                </ul>
            </div>


            {{-- Notify Success --}}
            <div id="flashSuccess" data-flash="{{ session('success') }}"></div>
            {{-- Notify --}}
            <div id="flashFails" data-flash="{{ session('fails') }}"></div>

            <div class="row">
                <div class="col-lg-12 py-3 mb-4">
                    <a href="{{ route('dashboard.training.create') }}" class="btn btn-outline-success btn-round">
                        <i class="fas fa-plus"></i>
                        Pelatihan
                    </a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" width="5%">Nomor Pelatihan</th>
                                        <th scope="col">Nama Pelatihan</th>
                                        <th scope="col">Kategori Pelatihan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col" width="5%">Total Peserta</th>
                                        <th scope="col">QR Code</th>
                                        <th scope="col" width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trainings as $training)
                                        <tr style="height: 150px; vertical-align: center;">
                                            <td>{{ $training->code }}</td>
                                            <td>{{ $training->title }}</td>
                                            <td class="text-uppercase text-center">{{ $training->category->title }}</td>
                                            <td class="text-center">{{ $training->year }}</td>
                                            <td class="text-center">
                                                {{ $training->participants->count() }}
                                            </td>
                                            <td class="text-center">
                                                {!! QrCode::size(100)->generate(route('show.training', $training->slug)) !!}
                                                {{-- {{ route('show.training', $training->slug) }} --}}
                                            </td>
                                            <td class="text-center">
                                                <form id="form-delete-{{ $training->id }}"
                                                    action="{{ route('dashboard.training.delete', $training->slug) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('dashboard.participant.show.peserta', $training->slug) }}"
                                                        class="btn btn-primary">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>
                                                    <a href="{{ route('dashboard.training.create.peserta', $training->slug) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-user-plus"></i>
                                                    </a>
                                                    <a href="{{ route('dashboard.training.edit', $training->slug) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger"
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
@endpush
