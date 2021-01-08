@extends('layout/main')

@section('title', 'Laporan')

@section('container')

    <div class="page-title">
        <h1>Filter Laporan</h1>
    </div>
    <div class="container">
        <form method="post" action="/report" class="form-master">
            @csrf
            <div class="form-master-input">
                <label>Tanggal Awal</label>
                <div class="input-wrapper">
                    <input name="tanggal_awal" type="date">
                </div>
                
            </div>
            <div class="form-master-input">
                <label>Tanggal Akhir</label>
                <div class="input-wrapper">
                    <input name="tanggal_akhir" type="date">
                </div>
                
            </div>
            <div class="form-master-input">
                <label>Barang</label>
                <select name="kode_barang" id="kode_barang">
                    @foreach($stuffs as $stuff)
                        <option value="{{$stuff->kode_barang}}">{{$stuff->kode_barang}} ({{$stuff->nama_barang}})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" name="submit" class="btn-report">Preview & Cetak</button>
        </form>

        

    </div>

@endsection
