@extends('auth.layouts.app')

@section('title', 'Peserta')

@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Peserta</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('dashboard.participant.index') }}">
                            <i class="fas fa-users"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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
                                                    <form id="form-delete-{{ $participant->code }}"
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
                                                            onclick="btnDelete( {{ $participant->code }} )">
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
    <script>
        $('#datatables').DataTable();
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
