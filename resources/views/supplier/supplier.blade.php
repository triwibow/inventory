@extends('layout/main')

@section('title', 'Supplier')

@section('container')

    <div class="page-title">
        <h1>Supplier</h1>
    </div>
    <div class="container">
        
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="/supplier" class="form-master">
            @csrf
            <div class="form-master-input">
                <label>Kode Supplier</label>
                <div class="input-wrapper">
                    <input name="kode_supplier" type="text" value="{{$supplier_code}}" readonly>
                </div>
            </div>
            <div class="form-master-input">
                <label>Nama supplier</label>
                <div class="input-wrapper">
                    <input name="nama_supplier" type="text" class="@error('nama_supplier') error-input @enderror" value="{{old('nama_supplier')}}">
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
                    <input name="no_telp_supplier" type="text" class="@error('no_telp_supplier') error-input @enderror" value="{{old('no_telp_supplier')}}">
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
                    <textarea name="alamat_supplier" cols="30" rows="10" class="@error('alamat_supplier') error-input @enderror">{{old('alamat_supplier')}}</textarea>
                    @error('alamat_supplier')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" name="submit" class="form-master-btn">Tambah</button>
        </form>

        @if(count($suppliers) > 0)
        <div class="table-data">
            <table class="table-master">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($suppliers as $supplier)
                        <tr>
                            <td>{{$supplier->kode_supplier}}</td>
                            <td>{{$supplier->nama_supplier}}</td>
                            <td>{{$supplier->no_telp_supplier}}</td>
                            <td>{{$supplier->alamat_supplier}}</td>
                            <td>
                                <a class="btn-update" href="{{url('/supplier/'.$supplier->kode_supplier.'/edit')}}">update</a>
                                <form method="post" action="{{url('/supplier/'.$supplier->kode_supplier.'/delete')}}" class="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onClick="return confirm('Yakin untuk menghapus supplier ?')" class="btn-delete">delete</button>
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