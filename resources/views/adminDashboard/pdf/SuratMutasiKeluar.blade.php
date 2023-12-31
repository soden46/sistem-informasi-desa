<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-size: 12px;
            font-family: Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .table,
        .td,
        .th,
        thead {
            border: 1px solid black;
            text-align: center
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-success {
            color: green
        }

        .text-danger {
            color: red
        }

        .fw-bold {
            font-weight: bold
        }

        .tandatangan {
            text-align: center;
            margin-left: 400px;

        }

        #foto {
            float: left;
            width: 120px;
            height: 150px;
            background: transparent;
        }

        #foto2 {
            justify-content: center;
            width: 60%;
            height: 30px;
            background: transparent;
        }

        .header h1 {
            font-size: 18px;
            font-family: sans-serif;
            position: relative;
            margin: 0;
            padding: 0;
            top: 1px;
        }

        .header p {
            font-size: 13px;
            font-family: sans-serif;
            position: relative;
            margin: 0;
            padding: 0;
            top: 1px;
        }

        .header2 h1 {
            font-size: 14px;
            font-family: sans-serif;
            position: relative;
            margin: 0;
            padding: 0;
            top: 2px;
            text-decoration: underline;
        }

        .header2 p {
            font-size: 12px;
            font-family: sans-serif;
            position: relative;
            margin: 0;
            padding: 0;
            top: 2px;
        }

        .header2 p {
            text-align: justify;
            /* For Edge */
            text-align-last: right;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <div class="header">
                <img src="{{public_path('storage/asset/sleman.png')}}" id="foto" alt="Logo" height="75px" />
                <h1 class="text-center">PEMERINTAH KABUPATEN SLEMAN</h1>
                <p class="text-center">KAPONEWON GAMPING</p>
                <h1 class="text-center">PEMERINTAH KALURAHAN AMBARKETAWANG</h1>
                <h1 class="text-center"><img src="{{public_path('storage/asset/aksara.png')}}" id="foto2" alt="Logo" /></h1>
                <p class="text-center">Jalan Wates KM 5, Ambarketawang, Gamping, Sleman,55294</p>
                <p class="text-center">Telepon (0274) 797496</p>
                <p class="text-center">Laman: https://ambarketawang.sidesimanis.slemankab.go.id</p>
            </div>
            <div class="divider py-1 bg-dark mb-3 mt-2"></div>
            <p class="mt-2">Perihal: Permihonan Pindah Penduduk</p>
            <p class="text-right">Kepada YTH:</br>Bapak Bupati Sleman</br>Di Sleman</p>
            <p class="mt-2">Saya Yang bertanda tangan dibawah ini:</p>

            <table class="font-12">
                <tr>
                    <td width="150px">Nama Lengkap</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->nama}}</td>
                </tr>
                <tr>
                    <td width="150px">NIK</td>
                    <td width="10px">:</td>
                    <td>{{$surat->nik_mk}}</td>
                </tr>
                <tr>
                    <td width="150px">NO Kartu Keluarga</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->no_kk}}</td>
                </tr>
                <tr>
                    <td width="150px">Tempat Lahir</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->tempat_lahir}}</td>
                </tr>
                <tr>
                    <td width="150px">Tanggal Lahir</td>
                    <td width="10px">:</td>
                    <td>{{date('d/m/Y', strtotime($surat->pend->tgl_lahir))}}</td>
                </tr>
                <tr>
                    <td width="150px">Agama</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->agama}}</td>
                </tr>
                <tr>
                    <td width="150px">Status Dalam Keluarga</td>
                    <td width="10px">:</td>
                    <td>{{$surat->sts_dalam_keluarga}}</td>
                </tr>
                <tr>
                    <td width="150px">Kewarganegaraan</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->sts_penduduk}}</td>
                </tr>
                <tr>
                    <td width="150px">Kewarganegaraan</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->sts_penduduk}}</td>
                </tr>
                <tr>
                    <td width="150px">Alamat Asal</td>
                    <td width="10px">:</td>
                    <td>{{$surat->pend->nama_jalan}}, {{$surat->pend->rt}}, {{$surat->pend->rw}}</td>
                </tr>
                <tr>
                    <td width="100px"></td>
                    <td width="5px">Desa: </td>
                    <td>{{$surat->pend->desa}}</td>
                </tr>
                <tr>
                    <td width="150px"></td>
                    <td width="5px">Kec: </td>
                    <td>{{$surat->pend->kota}}</td>
                </tr>
                <tr>
                    <td width="100px"></td>
                    <td width="5px">Kab: </td>
                    <td>{{$surat->pend->kota}}</td>
                </tr>
                <tr>
                    <td width="100px"></td>
                    <td width="5px">Prov:</td>
                    <td>{{$surat->pend->prov}}</td>
                </tr>
            </table>
            <p>Mengajukan permohonan untuk pindah penduduk ke:</p>
            <table class="font-12">
                <tr>
                    <td width="150px">Alamat Yang Dituju</td>
                    <td width="10px">:</td>
                    <td>{{$surat->alamat_tuju}}</td>
                </tr>
                <td width="150px">Pindah Pada</td>
                <td width="10px">:</td>
                <td>{{date('d/m/Y', strtotime($surat->pend->tgl_regis_mk))}}</td>
                </tr>
                <tr>
                    <td width="150px">Keluarga Yang Turut</td>
                    <td width="10px">:</td>
                    <td>{{$surat->kel_ikut}}</td>
                </tr>
            </table>
            </br>
            </br>
            <table class="font-12 table table-bordered">
                <thead>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>NIK</td>
                        <td>Jenis Kelamin</td>
                        <td>Agama</td>
                        <td>Status Perkawinana</td>
                        <td>Keterangan Keluarga</td>
                    </tr>
                </thead>
                <tbody>
                    @if($surat->nik1 !='')
                    <tr>
                        <td>{{$surat->nama1}}</td>
                        <td>{{$surat->nik1}}</td>
                        <td>{{$surat->jk1}}</td>
                        <td>{{$surat->agama1}}</td>
                        <td>{{$surat->sts_kawin1}}</td>
                        <td>{{$surat->ket_kel1}}</td>
                    </tr>
                    @endif
                    @if($surat->nik2!='')
                    <tr>
                        <td>{{$surat->nama2}}</td>
                        <td>{{$surat->nik2}}</td>
                        <td>{{$surat->jk2}}</td>
                        <td>{{$surat->agama2}}</td>
                        <td>{{$surat->sts_kawin2}}</td>
                        <td>{{$surat->ket_kel2}}</td>
                    </tr>
                    @endif
                    @if($surat->nik3!='')
                    <tr>
                        <td>{{$surat->nama3}}</td>
                        <td>{{$surat->nik3}}</td>
                        <td>{{$surat->jk3}}</td>
                        <td>{{$surat->agama3}}</td>
                        <td>{{$surat->sts_kawin3}}</td>
                        <td>{{$surat->ket_kel3}}</td>
                    </tr>
                    @endif
                    @if($surat->nik4!='')
                    <tr>
                        <td>{{$surat->nama4}}</td>
                        <td>{{$surat->nik4}}</td>
                        <td>{{$surat->jk4}}</td>
                        <td>{{$surat->agama4}}</td>
                        <td>{{$surat->sts_kawin4}}</td>
                        <td>{{$surat->ket_kel4}}</td>
                    </tr>
                    @endif
                    @if($surat->nik5!='')
                    <tr>
                        <td>{{$surat->nama5}}</td>
                        <td>{{$surat->nik5}}</td>
                        <td>{{$surat->jk5}}</td>
                        <td>{{$surat->agama5}}</td>
                        <td>{{$surat->sts_kawin5}}</td>
                        <td>{{$surat->ket_kel5}}</td>
                    </tr>
                    @endif
                    @if($surat->nik6!='')
                    <tr>
                        <td>{{$surat->nama6}}</td>
                        <td>{{$surat->nik6}}</td>
                        <td>{{$surat->jk6}}</td>
                        <td>{{$surat->agama6}}</td>
                        <td>{{$surat->sts_kawin6}}</td>
                        <td>{{$surat->ket_kel6}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <div class="tandatangan">

                <br>

                <p style="padding-bottom:100px">
                    Ambarketawang, ......................... {{ date('Y') }}</br>
                    Pemerintah Kalurahan Ambarketawang</p>


                <p>Erma Heni Surya, S.E.</p>
            </div>
        </div>
    </div>
</body>

</html>