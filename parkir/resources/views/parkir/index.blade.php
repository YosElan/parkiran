@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Data Parkir</div>

                    <div class="card-body">
                        <a href="{{ route('parkir.create') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-plus"></i> Tambah Data Parkir
                          </a>
                          

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Total Biaya Parkir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkirs as $parkir)
                                    <tr>
                                        <td>{{ $parkir->jam_masuk }}</td>
                                        <td>{{ $parkir->jam_keluar }}</td>
                                        <td>{{ $parkir->jenis_kendaraan }}</td>
                                        <td>{{ $parkir->total_biaya }}</td>
                                        <td>
                                            <form action="{{ route('parkir.destroy', $parkir) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
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
@endsection
