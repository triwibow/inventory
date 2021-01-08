@extends('layout/main')

@section('title', 'Penjualan')

@section('container')

    <div class="page-title">
        <h1>Penjualan</h1>
    </div>
    <div class="container">
        @if(session('status'))
            <div class="alert-success" id="success">
                {{session('status')}}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error" id="error">
                {{session('error')}}
            </div>
        @endif
        <form class="form-transaction" id="form-transaction" action="{{url('/sales')}}" method="post">
            @csrf
            <div class="form-transaction-input">
                <label>Kode Penjualan</label>
                <input name="kode_penjualan" type="text" value="{{$sales_code}}" readonly>
            </div>
            <input type="hidden" name="data" id="sales">
            <div class="form-transaction-input">
                <label>Tanggal</label>
                <input name="tanggal_penjualan" type="date" value="{{date('Y-m-d')}}">
            </div>
            <div class="form-transaction-input">
                <label>Kode Pelanggan</label>
                <select name="kode_pelanggan">
                    @foreach($customers as $customer)
                        <option value="{{$customer->kode_pelanggan}}">{{$customer->kode_pelanggan}} ({{$customer->nama_pelanggan}})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-transaction-input">
                <label>Harga</label>
                <input name="harga" type="number" readonly id="harga" value="0">
            </div>
            
            <div class="stuff-order">
                <div class="stuff-order-item">
                    <label>Barang</label>
                    <select name="kode_barang" id="kode_barang">
                        @foreach($stuffs as $stuff)
                            <option value="{{$stuff->kode_barang}}">{{$stuff->kode_barang}} ({{$stuff->nama_barang}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="stuff-order-item">
                    <label>Harga Satuan</label>
                    <input name="harga_satuan" type="number" id="harga_satuan" value="0" readonly>
                </div>
                <div class="stuff-order-item">
                    <label>Jumlah</label>
                    <input name="jumlah" type="number" id="jumlah" value="0" min="0">
                </div>
                <div class="stuff-order-item">
                    <button id="tambah_barang" class="stuff-order-btn">Tambahkan</button>
                </div>
            </div>
            
            <div class="table-data">
                <table class="table-master">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="list_barang">
                        <tr id="empty" class="emp">
                            <td colspan="5" rowspan="2">Belum ada barang ditambah</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button id="button-submit" class="form-transaction-btn">Simpan</button>

        </form>
    </div>

@endsection

<script>
    window.onload = () => {
        const btnSubmit = document.querySelector('#button-submit');
        const kodeBarang = document.querySelector('#kode_barang');
        const sales = document.querySelector('#sales');
        const hargaSatuan = document.querySelector('#harga_satuan');
        const harga = document.querySelector('#harga');
        const jumlah = document.querySelector('#jumlah');
        const tambahBarang = document.querySelector('#tambah_barang');
        const listBarang = document.querySelector('#list_barang');
        const stuffs = @json($stuffs);
        const success = document.querySelector('#success');
        const error = document.querySelector('#error');
        const empty = document.querySelector('#empty');
        let formData = [];
        let totalHarga = 0;
        let subHarga = 0;
        let countBeforeChange = jumlah.value;  

        setTimeout(() => {
            if(success){
                success.remove();
            }
        }, 3000);

        setTimeout(() => {
            if(error){
                error.remove();
            }
        }, 3000);

        const getPrice = (value) => {
            hargaSatuan.value = value;
            return value;
        }

        const getSubPrice = (count, price) => {
            
            if(countBeforeChange < count){
                subHarga += (parseInt(count) - parseInt(countBeforeChange)) * parseInt(price);
            } else {
                subHarga -= (parseInt(countBeforeChange) - parseInt(count)) * parseInt(price);
            }
            countBeforeChange = count;
        }


        const getSelectedStuff = (value) => {
            
            const selected = stuffs.filter(stuff => {
                return stuff.kode_barang === value;
            });

            getPrice(selected[0].harga_satuan);

            return selected;
        }

        const selected = getSelectedStuff(kodeBarang.value);

        const handleChange = () => {
            kodeBarang.addEventListener('change', (event) => {
                getSelectedStuff(event.target.value);
                jumlah.value = 0;
                countBeforeChange = 0;
                subHarga = 0;
            });

            jumlah.addEventListener('change', (event) => {
                getSubPrice(event.target.value, getSelectedStuff(kodeBarang.value)[0].harga_satuan);
            });
        }

        handleChange();

        const renderList = (data) => {
            if(jumlah.value == 0){
                return;
            }

            document.querySelector('#empty').classList.add('hide');

            formData.push({
                kode_barang: data.kode_barang,
                harga_satuan: data.harga_satuan,
                jumlah:jumlah.value,
                subHarga: subHarga
            });

            const html = `
                <tr>
                    <td>${data.kode_barang}</td>
                    <td>${data.harga_satuan}</td>
                    <td>${jumlah.value}</td>    
                    <td>${subHarga}</td>
                    <td>
                        <button class="btn-delete" data-kode=${data.kode_barang} data-price=${subHarga}>Remove</button>
                    </td>
                </tr>
            `;

            listBarang.innerHTML += html;
            sales.value = JSON.stringify(formData);
        }

        tambahBarang.addEventListener('click', (event) => {
            event.preventDefault();
            if(jumlah.value != 0){
                totalHarga += subHarga;
                harga.value = totalHarga;

                renderList(getSelectedStuff(kodeBarang.value)[0]);
            }
            
        });

        window.addEventListener('click',(event) => {
            if(event.target.classList.contains('btn-delete')){
                event.preventDefault();
                const kodeBrg = event.target.getAttribute('data-kode');
                const tmpData = JSON.parse(sales.value);
                const filtered = tmpData.filter((value, index) => {
                    return value.kode_barang !== kodeBrg;
                });

                formData = [...filtered];
                if(formData.length === 0){
                    document.querySelector('#empty').classList.remove('hide');
                }
                sales.value = JSON.stringify(formData);
                totalHarga -= event.target.getAttribute('data-price');
                harga.value = totalHarga;
                event.target.closest('tr').remove();
                jumlah.value = 0;
            }
        });

       
       
    }
</script>