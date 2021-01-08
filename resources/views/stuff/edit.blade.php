@extends('layout/main')

@section('title', 'Edit Barang')

@section('container')

    <div class="page-title">
        <h1>Edit Barang</h1>
    </div>
    <div class="container">
        <a class="btn-back" href="{{url('/stuff')}}">&larr; kembali</a>
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="{{url('/stuff/'.$stuff->kode_barang.'/edit')}}" class="form-master">
            @csrf
            @method('put')
            <div class="form-master-input">
                <label>Kode Barang</label>
                <div class="input-wrapper">
                    <input name="kode_barang" type="text" value="{{$stuff->kode_barang}}"  readonly>
                </div>
            </div>
            <div class="form-master-input">
                <label>Nama Barang</label>
                <div class="input-wrapper">
                    <input name="nama_barang" type="text" class="@error('nama_barang') error-input @enderror" value="{{$stuff->nama_barang}}">
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
                    <textarea name="deskripsi_barang" cols="30" rows="10" class="@error('deskripsi_barang') error-input @enderror">{{$stuff->deskripsi_barang}}</textarea>
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
                    <input name="harga_satuan" type="number" class="@error('harga_satuan') error-input @enderror" value="{{$stuff->harga_satuan}}">
                    @error('harga_satuan')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" name="submit" class="form-master-btn">Edit</button>
        </form>

       
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