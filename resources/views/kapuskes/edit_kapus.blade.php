@extends('layouts.sidebar')

@section('content')

<form action="{{url('updatekapus',$kapus->id)}}" method="POST">
    @csrf
        <div>
            <label for="">NIP</label>
            <input class="form-control" type="text" id="nip" name="nip" value="{{$kapus->nip}}" placeholder="Masukkan NIP" aria-label="default input example" maxlength="30" autofocus>
        </div>
        <div>
            <label for="">Nama</label>
            <input class="form-control" type="text" id="nama" name="nama" value="{{$kapus->nama}}" placeholder="Masukkan nama" maxlength="50" style="text-transform: uppercase" aria-label="default input example">
        </div>
        <div>
            <label for="">Tanggal mulai</label>
            <input class="form-control" type="date" id="tgl_mulai" value="{{$kapus->tgl_mulai}}" name="tgl_mulai" required>
        </div>
       <?php 
            if ($kapus->tgl_selesai == '-') {
               ?>
                <div>
                    <input class="form-control" type="hidden" value="{{$kapus->tgl_selesai}}" id="tgl_selesai" name="tgl_selesai" required>
                </div>
               <?php
            }elseif (strtotime($kapus->tgl_selesai) == strtotime($kapus->tgl_selesai)) {
                
                ?>
                <div>
                    <label for="">Tanggal selesai</label>
                    <input class="form-control" type="text" value="{{$kapus->tgl_selesai}}" id="tgl_selesai" name="tgl_selesai" required>
                </div>
                <?php
            }
       ?>
       <?php
            if ($kapus->status == 0) {
                ?>
                <div>
                    <label for="">Status</label>
                    <select class="form-select" name="status" aria-label="Default select example" required>
                        <option selected value="{{$kapus->status}}"><?php
                            if ($kapus->status == 0) {
                                echo "Selesai Menjabat";
                            }
                            if ($kapus->status == 1) {
                                echo "Menjabat";
                            }
                        ?></option>
                        <option value="1">Sedang Menjabat</option>
                        <option value="0">Selesai Menjabat</option>
                      </select>
                </div>

                <?php
            }
            if ($kapus->status == 1) {
                ?>
                <input type="hidden" name="status" value="1" id="">

                <?php
            }

        ?>
        <hr>
        <div>
            <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </div>
  </form>
@endsection