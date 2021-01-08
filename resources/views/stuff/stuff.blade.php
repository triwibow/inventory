@extends('layout/main')

@section('title', 'Barang')

@section('container')

    <div class="page-title">
        <h1>Barang</h1>
    </div>
    <div class="container">
        
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="/stuff" class="form-master">
            @csrf
            <div class="form-master-input">
                <label>Kode Barang</label>
                <div class="input-wrapper">
                    <input name="kode_barang" type="text" value={{$stuff_code}}  readonly>
                </div>
            </div>
            <div class="form-master-input">
                <label>Nama Barang</label>
                <div class="input-wrapper">
                    <input name="nama_barang" type="text" class="@error('nama_barang') error-input @enderror" value="{{old('nama_barang')}}">
                    @error('nama_barang')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-master-input">
                <label>Deskripsi Barang</label>
                
                <div class="input-wrapper">
                    <textarea name="deskripsi_barang" cols="30" rows="10" class="@error('deskripsi_barang') error-input @enderror">{{old('deskripsi_barang')}}</textarea>
                    @error('deskripsi_barang')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-master-input">
                <label>Harga Satuan</label>
                <div class="input-wrapper">
                    <input name="harga_satuan" type="number" class="@error('harga_satuan') error-input @enderror" value="{{old('harga_satuan')}}">
                    @error('harga_satuan')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" name="submit" class="form-master-btn">Tambah</button>
        </form>

        @if(count($stuffs) > 0)
        <div class="table-data">
            <table class="table-master">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($stuffs as $stuff)
                        <tr>
                            <td>{{$stuff->kode_barang}}</td>
                            <td>{{$stuff->nama_barang}}</td>
                            <td>{{$stuff->deskripsi_barang}}</td>
                            <td>{{$stuff->stok}}</td>
                            <td>
                                <a class="btn-update" href="{{url('/stuff/'.$stuff->kode_barang.'/edit')}}">update</a>
                                <form method="post" action="{{url('/stuff/'.$stuff->kode_barang.'/delete')}}" class="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onClick="return confirm('Yakin untuk menghapus barang ?')" class="btn-delete">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

@endsection

<script>
    window.onload = () => {
        const success = document.querySelector('#success');
        setTimeout(() => {
            if(success){
                success.remove();
            }
        }, 3000);
    }
</script>