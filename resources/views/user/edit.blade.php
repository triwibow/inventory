@extends('layout/main')

@section('title', 'Master')

@section('container')

    <div class="page-title">
        <h1>Edit User</h1>
    </div>
    <div class="container">
        <a class="btn-back" href="{{url('/user')}}">&larr; kembali</a>
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif

        <form method="post" action="{{url('/user/'.$user->username.'/edit')}}" class="form-master">
            @method('put')
            @csrf
            <div class="form-master-input">
                <label>Username</label>
                <div class="input-wrapper">
                    <input name="username" type="text" class="@error('username') error-input @enderror" value="{{$user->username}}">
                    @error('username')
                        <div class="error-message">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
            </div>
            <div class="form-master-input">
                <label>Jabatan</label>
                <select name="jabatan">
                    <option value="ADMINISTRATOR" @if($user->jabatan === 'ADMINISTRATOR')selected='selected'@endif>Administrator</option>
                    <option value="LOGISTIK"  @if($user->jabatan === 'LOGISTIK')selected='selected'@endif>Logistik</option>
                    <option value="FAKTURIS"  @if($user->jabatan === 'FAKTURIS')selected='selected'@endif>Fakturis</option>
                </select>
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