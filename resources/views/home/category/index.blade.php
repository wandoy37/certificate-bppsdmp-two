@extends('home.layouts.app')

@section('title', 'Category ' . $category->title)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Certificate</a></li>
                <li class="breadcrumb-item active text-uppercase" aria-current="page">{{ $category->title }}</li>
            </ol>
        </nav>
        <div class="row d-flex justify-content-center">

            <div class="col-lg-12">
                <a href="{{ route('home.index') }}" class="btn btn-outline-dark">
                    <i class="fas fa-undo"></i>
                    Kembali
                </a>
            </div>

            <h3 class="text-center py-4">List Pelatihan - <span class="text-uppercase">{{ $category->title }}</span></h3>
            <div class="col-lg-8">
                <table class="table table-hover table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelatihan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($category->trainings as $training)
                            <?php $no++; ?>
                            <tr>
                                <th scope="row" class="text-center">{{ $no }}</th>
                                <td>{{ $training->title }}</td>
                                <td class="text-center">{{ $training->year }}</td>
                                <td class="text-center">
                                    <a href="{{ route('show.training', $training->slug) }}" class="btn btn-warning">
                                        <i class="fas fa-eye"></i>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
