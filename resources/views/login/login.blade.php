<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
</head>
<body>
    
    <div class="wrapper">
        <div class="container">
            <h1 class="page-title">Login</h1>
            @if(session('error'))
                <div class="alert-error" id="error">
                    {{session('error')}}
                </div>
            @endif

            <form method="post" action="/login" class="form-login">
                @csrf
                <div class="form-login-input">
                    <div class="input-wrapper">
                        <input name="username" type="text" class="@error('username') error-input @enderror" value="{{old('username')}}" placeholder="username">
                        @error('username')
                            <div class="error-message">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                </div>
                <div class="form-login-input">
                    <div class="input-wrapper">
                        <input name="password" type="password" class="@error('password') error-input @enderror" placeholder="password">
                        @error('password')
                            <div class="error-message">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" name="submit" class="form-login-btn">Login</button>
            </form>
        </div>
    </div>  
    


<script>
    window.onload = () => {
        const error = document.querySelector('#error');
        setTimeout(() => {
            if(error){
                error.remove();
            }
        }, 3000);
    }
</script>
</body>
</html>