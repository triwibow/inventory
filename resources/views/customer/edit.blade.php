@extends('layout/main')

@section('title', 'Customer')

@section('container')
    <div class="page-title">
        <h1>Edit Pelanggan</h1>
    </div>
    <div class="container">
        <a class="btn-back" href="{{url('/customer')}}">&larr; kembali</a>
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="{{url('customer/'.$customer->kode_pelanggan.'/edit')}}" class="form-master">
            @csrf
            @method('put')
            <div class="form-master-input">
                <label>Kode Pelanggan</label>
                <div class="input-wrapper">
                    <input name="kode_pelanggan" type="text" value="{{$customer->kode_pelanggan}}" readonly>
                </div>
            </div>
            <div class="form-master-input">
                <label>Nama Pelanggan</label>
                <div class="input-wrapper">
                    <input name="nama_pelanggan" type="text" class="@error('nama_pelanggan') error-input @enderror" value="{{$customer->nama_pelanggan}}">
                    @error('nama_pelanggan')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-master-input">
                <label>No Telp Pelanggan</label>
                <div class="input-wrapper">
                    <input name="no_telp_pelanggan" type="text" class="@error('no_telp_pelanggan') error-input @enderror" value="{{$customer->no_telp_pelanggan}}">
                    @error('no_telp_pelanggan')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-master-input">
                <label>Alamat Pelanggan</label>
                
                <div class="input-wrapper">
                    <textarea name="alamat_pelanggan" cols="30" rows="10" class="@error('alamat_pelanggan') error-input @enderror">{{$customer->alamat_pelanggan}}</textarea>
                    @error('alamat_pelanggan')
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