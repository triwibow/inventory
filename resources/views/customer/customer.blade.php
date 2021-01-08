@extends('layout/main')

@section('title', 'Customer')

@section('container')

    <div class="page-title">
        <h1>Pelanggan</h1>
    </div>
    <div class="container">
        
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif
        <form method="post" action="/customer" class="form-master">
            @csrf
            <div class="form-master-input">
                <label>Kode Pelanggan</label>
                <div class="input-wrapper">
                    <input name="kode_pelanggan" type="text" value="{{$customer_code}}" readonly>
                </div>
            </div>
            <div class="form-master-input">
                <label>Nama Pelanggan</label>
                <div class="input-wrapper">
                    <input name="nama_pelanggan" type="text" class="@error('nama_pelanggan') error-input @enderror" value="{{old('nama_pelanggan')}}">
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
                    <input name="no_telp_pelanggan" type="text" class="@error('no_telp_pelanggan') error-input @enderror" value="{{old('no_telp_pelanggan')}}">
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
                    <textarea name="alamat_pelanggan" cols="30" rows="10" class="@error('alamat_pelanggan') error-input @enderror">{{old('alamat_pelanggan')}}</textarea>
                    @error('alamat_pelanggan')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" name="submit" class="form-master-btn">Tambah</button>
        </form>

        @if(count($customers) > 0)
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
                @foreach($customers as $customer)
                        <tr>
                            <td>{{$customer->kode_pelanggan}}</td>
                            <td>{{$customer->nama_pelanggan}}</td>
                            <td>{{$customer->no_telp_pelanggan}}</td>
                            <td>{{$customer->alamat_pelanggan}}</td>
                            <td>
                                <a class="btn-update" href="{{url('/customer/'.$customer->kode_pelanggan.'/edit')}}">update</a>
                                <form method="post" action="{{url('/customer/'.$customer->kode_pelanggan.'/delete')}}" class="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onClick="return confirm('Yakin untuk menghapus pelanggan ?')" class="btn-delete">delete</button>
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