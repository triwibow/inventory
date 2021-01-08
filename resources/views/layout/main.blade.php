<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>
<body>

    <nav class="navbar">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{url('/')}}">Home</a>
            </li>
            @if(Auth::user()->jabatan === "ADMINISTRATOR")
            <li class="nav-item">
                <a id="tg-dropdown">Master</a>
                <div class="dropdown" id="dropdown">
                    <ul class="nav-dropdown">
                        <li class="nav-dropdown-item">
                            <a href="{{url('/user')}}">User</a>
                        </li>
                        <li class="nav-dropdown-item">
                            <a href="{{url('/customer')}}">Pelanggan</a>
                        </li>
                        <li class="nav-dropdown-item">
                            <a href="{{url('/supplier')}}">Supplier</a>
                        </li>
                        <li class="nav-dropdown-item">
                            <a href="{{url('/stuff')}}">Barang</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            @if(Auth::user()->jabatan === "ADMINISTRATOR" || Auth::user()->jabatan === "LOGISTIK")
            <li class="nav-item">
                <a href="{{url('/purchase')}}">Pembelian</a>
            </li>
            @endif

            @if(Auth::user()->jabatan === "ADMINISTRATOR" || Auth::user()->jabatan === "FAKTURIS")
            <li class="nav-item">
                <a href="{{url('/sales')}}">Penjualan</a>
            </li>
            @endif

            <li class="nav-item">
                <a href="{{url('/report')}}">Laporan</a>
            </li>
            <li class="nav-item">
                <a href="{{url('/logout')}}">Logout</a>
            </li>
        </ul>
    </nav>

    @yield('container')
    

    <script>
        const tgDropdown = document.querySelector('#tg-dropdown');
        const dropdown = document.querySelector('#dropdown');

        tgDropdown.addEventListener('click', () => {
            dropdown.classList.toggle('show-dropdown');
        });
    </script>

</body>
</html>