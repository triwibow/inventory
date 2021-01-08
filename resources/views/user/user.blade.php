@extends('layout/main')

@section('title', 'Master')

@section('container')

    <div class="page-title">
        <h1>User</h1>
    </div>
    <div class="container">
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif

        <form method="post" action="/user" class="form-master">
            @csrf
            <div class="form-master-input">
                <label>Username</label>
                <div class="input-wrapper">
                    <input name="username" type="text" class="@error('username') error-input @enderror" value="{{old('username')}}">
                    @error('username')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
            </div>
            <div class="form-master-input">
                <label>Password</label>
                <div class="input-wrapper">
                    <input name="password" type="password" class="@error('password') error-input @enderror">
                    @error('password')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-master-input">
                <label>Jabatan</label>
                <select name="jabatan">
                    <option value="ADMINISTRATOR">Administrator</option>
                    <option value="LOGISTIK">Logistik</option>
                    <option value="FAKTURIS">Fakturis</option>
                </select>
            </div>
            <button type="submit" name="submit" class="form-master-btn">Tambah</button>
        </form>

        @if(count($users) > 0)
        <div class="table-data">
            <table class="table-master">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->jabatan}}</td>
                            <td>
                                <a class="btn-update" href="{{url('/user/'.$user->username.'/edit')}}">update</a>
                                <form method="post" action="{{url('/user/'.$user->username.'/delete')}}" class="form-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onClick="return confirm('Yakin untuk menghapus user ?')" class="btn-delete">delete</button>
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