@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data Parkir</div>

                    <div class="card-body">
                        <form action="{{ route('parkir.update', $parkir) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-control">
                                    <option value="motor" {{ $parkir->jenis_kendaraan === 'motor' ? 'selected' : '' }}>Motor</option>
                                    <option value="mobil" {{ $parkir->jenis_kendaraan === 'mobil' ? 'selected' : '' }}>Mobil</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="datetime-local" name="jam_masuk" id="jam_masuk" class="form-control" value="{{ $parkir->jam_masuk->format('Y-m-d\TH:i') }}">
                            </div>

                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar</label>
                                <input type="datetime-local" name="jam_keluar" id="jam_keluar" class="form-control" value="{{ $parkir->jam_keluar ? $parkir->jam_keluar->format('Y-m-d\TH:i') : '' }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
