<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Peserta | {{ $training->title }}</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('atlantis') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('atlantis') }}/css/atlantis.css">
</head>

<body>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 py-4 my-4">
                    <h1 class="text-center">
                        <b>
                            {{ $training->title }}
                        </b>
                    </h1>
                    <h3 class="text-center">UPTD Balai Penyuluhan dan Pengembangan Sumber Daya Manusia Pertanian
                        Kalimantan Timur - Samarinda</h3>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" width="9%">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIP/NIPPPK/NRTK2D</th>
                                <th scope="col" width="9%">Role</th>
                                <th scope="col">Pangkat/Golongan</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Instansi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($training->participants as $participant)
                                <tr>
                                    <td>{{ $participant->code }}</td>
                                    <td>{{ $participant->name }}</td>
                                    <td>{{ $participant->nip }}</td>
                                    <td class="text-capitalize">{{ $participant->role->title }}</td>
                                    <td>{{ $participant->pangkat_golongan }}</td>
                                    <td>{{ $participant->jabatan }}</td>
                                    <td>{{ $participant->instansi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--   Core JS Files   -->
    <script src="{{ asset('atlantis') }}/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{ asset('atlantis') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('atlantis') }}/js/core/bootstrap.min.js"></script>
</body>

</html>
