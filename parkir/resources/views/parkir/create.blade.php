@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Parkir</div>

                    <div class="card-body">
                        <form action="{{ route('parkir.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                                    <option value="motor">Motor</option>
                                    <option value="mobil">Mobil</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="datetime-local" name="jam_masuk" id="jam_masuk" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar</label>
                                <input type="datetime-local" name="jam_keluar" id="jam_keluar" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
