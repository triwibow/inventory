@extends('layout/main')

@section('title', 'Supplier')

@section('container')
    <div class="page-title">
        <h1>Edit Supplier</h1>
    </div>
    <div class="container">
        <a class="btn-back" href="{{url('/supplier')}}">&larr; kembali</a>
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="{{url('supplier/'.$supplier->kode_supplier.'/edit')}}" class="form-master">
            @csrf
            @method('put')
            <div class="form-master-input">
                <label>Kode supplier</label>
                <div class="input-wrapper">
                    <input name="kode_supplier" type="text" value="{{$supplier->kode_supplier}}" readonly>
                </div>
            </div>
            <div class="form-master-input">
                <label>Nama supplier</label>
                <div class="input-wrapper">
                    <input name="nama_supplier" type="text" class="@error('nama_supplier') error-input @enderror" value="{{$supplier->nama_supplier}}">
                    @error('nama_supplier')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-master-input">
                <label>No Telp supplier</label>
                <div class="input-wrapper">
                    <input name="no_telp_supplier" type="text" class="@error('no_telp_supplier') error-input @enderror" value="{{$supplier->no_telp_supplier}}">
                    @error('no_telp_supplier')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-master-input">
                <label>Alamat supplier</label>
                
                <div class="input-wrapper">
                    <textarea name="alamat_supplier" cols="30" rows="10" class="@error('alamat_supplier') error-input @enderror">{{$supplier->alamat_supplier}}</textarea>
                    @error('alamat_supplier')
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