<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link href="lumino/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all"> --}}
    <style>
        .headerlogo{
            width: 100%;
            height: 100px;
            padding: 10px;
            border-bottom: 0.1px dashed grey;
        }
        .atasgambar{
            width:120px;
            height: auto;
            float: left;
        }
        .atasheader{
            width: 80%;
            height: auto;
            float: left;
            text-align: center;
            padding-top: 16px;
        }
        .tulisanpalingatas{
            font: 20px bold calibri;
        }
        .atasjudul{
            width: 100%;
            padding: 0px 100px;
            text-align: center;
        }
        .heaederorang{
            width: 100%;
            height: 100px;
            padding-top: 30px;
            font-size: 14px;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; 
        }
        .heaederorangkiri{
            width: 60%;
            float: left;
        }
        .heaederorangkanan{
            padding-left: 30px;
            float: right;
        }
        .isitable{
            padding-top: 20px;
        }
        #customers {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 100;
            font-size: 14px;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color:silver;
        }
        .footer{
            width: 100%;
            height: 20px;
            position: fixed;
            bottom: 0;
            text-align: center;
            font-size: 12px;
            border-bottom: 0.1px dashed grey;

        }
        .tanggalcetak{
            position: fixed;
            bottom: 0;
            right: 0;
            font-size: 10px;
            float: right;
        }
        .tanggalcetak img{
            width: 12px;
            margin-top: 2px;
        }
        .ttd{
            width: 200px;
            position: relative;
            float: right;
            text-align: center;
            margin-top: 40px;
        }
        .tanggal{
            float: left;
            width: 200px;
            position: relative;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="headerlogo">
        <div class="atasgambar">
            <img src="images/bpnlogo.png" width="100px">
        </div>
        <div class="atasheader">
            <b class="tulisanpalingatas">BADAN PERTANAHAN NASIONAL - RI</b><br>
            <b class="tulisanpalingatas">KANTOR PERTANAHAN KABUPATEN BOGOR</b>
            <p>Jl.Tegar Beriman, Kecamatan Cibonong  Kab. Bogor Telp (0251)87901140, 87090114</p>
        </div>
    </div>
    <div class="atasjudul">
        <b><u>LAPORAN BERKAS BUKU TANAH</u></b><br>
        <i>Bulan / Tahun : {{$bulan}} / {{$tahun}}</i>
    </div>

    <div class="footer">
        &copy;2018 Badan Pertanahan Nasional Kabupaten Bogor.
    </div>

    <div class="isitable">
        <table id="customers">
            <thead>
                <tr>
                    <th width="1%">No.</th>
                    <th width="6%">Bundel</th>
                    <th width="6%">Id Buku Tanah</th>
                    <th width="14%">Desa / Kecamatan</th>
                    <th width="8%">Jenis Hak</th>
                    <th width="8%">No Hak</th>
                    <th width="8%">Ruang</th>
                    <th width="8%">Rak / Baris</th>
                    <th width="20%">Tanggal Pinjam</th>
                </tr>  
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($data as $datas)
                <tr>
                    <td> {{ $no++ }}</td>
                    <td> {{ $datas->no_box }}</td>
                    <td> {{ $datas->idbukutanah }}</td>
                    <td> {{ $datas->desa }} / {{ $datas->kecamatan }}</td>
                    <td> {{ $datas->jenis_hak }}</td>
                    <td> {{ $datas->no_hak }}</td>
                    <td> {{ $datas->ruang }}</td>
                    <td> {{ $datas->rak }} / {{ $datas->baris }}</td>
                    <td> {{ $datas->created_at }}</td>
                </tr>
                @endforeach
            </tbody> 
        </table>
    </div>
    <div class="ttd">
        Petugas Penyerahan
        <br><br>
        <br><br>
        <br><br>
        (...................................)
    </div>

   
   
    {{--  <div class="tanggalcetak">
        <img src="images/print.png"> {{ \Carbon\Carbon::now() }} 
    </div>  --}}
    
            


</body>
</html>