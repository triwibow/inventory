@extends('layout/main')

@section('title', 'Show filter')

@section('container')

    <div class="page-title">
        <h3>Laporan Penjualan dan Pembelian</h3>
    </div>
    <div class="container">
        <div class="result-filter">
            <h5>Barang : ({{$stuff[0]->kode_barang}}) {{$stuff[0]->nama_barang}}</h5>
            <h5>Periode : {{$awal}} - {{$akhir}}</h5>
        </div>

        <div class="table-data">
            <table class="table-master">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Stok Awal</td>
                            <td>{{$start=0}}</td>
                        </tr>
                    <?php $count = 1; ?> 
                    @foreach($purchases as $purchase)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td>{{$purchase->tanggal_pembelian}}</td>
                            <td>{{$purchase->kode_pembelian}}</td>
                            <td>{{$purchase->detailPembelian[0]->jumlah}}</td>
                            <td>0</td>
                            <td>{{$start += $purchase->detailPembelian[0]->jumlah}}</td>
                        </tr>
                        <?php $count++; ?>
                    @endforeach
                    @foreach($sales as $sale)
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td>{{$sale->tanggal_penjualan}}</td>
                            <td>{{$sale->kode_penjualan}}</td>
                            <td>0</td>
                            <td>{{$sale->detailPenjualan[0]->jumlah}}</td>
                            <td>{{$start -= $sale->detailPenjualan[0]->jumlah}}</td>
                        </tr>
                        <?php $count++; ?>
                    @endforeach
                    
                </tbody>
            </table>
        </div>

    </div>

@endsection
