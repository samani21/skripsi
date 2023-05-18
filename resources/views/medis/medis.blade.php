@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('medis/medis')}}" method="get" class="row g-12">
        <div class="col-md-2">
            <input class="form-control" type="text" name="tgl" value="{{date('d-m-Y')}}"
                placeholder="Cari surat berdasarkan no surat" aria-label="default input example">
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="nama" placeholder="Cari nama pasien"
                aria-label="default input example">
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="no" placeholder="Cari pasien no berobat"
                aria-label="default input example">
        </div>
        <div class="col-md-4">
            <label></label>
            <select name="poli" class="form-control">
                <option value="">--Pilih Poli--</option>
                <option value="Umum">Umum</option>
                <option value="Anak">Anak</option>
                <option value="Gigi">Gigi</option>
                <option value="KB">KB</option>
                <option value="Gizi">Gizi</option>
                <option value="kandungan">kandungan</option>
            </select>
        </div>
        <div class="col-auto">
            <br>
            <button type="submit" class="btn btn-primary mb-3"><i
                    class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
<div class="table-responsive bg-white" id="no-more-tables">
    <table class="table table-striped table-hover">
        <thead>
            <tr align="center">
                <th scope="col">No</th>
                <th scope="col">No berobat</th>
                <th scope="col">NIK</th>
                <th scope="col">Jenis berobat</th>
                <th scope="col">Nama</th>
                <th scope="col">Umur</th>
                <th scope="col">Poli</th>
                <th scope="col">Tanggal berobat</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no=1;
            @endphp
            @foreach($berobat as $index => $medis)
            <tr align="center">
                <td data-title="No">{{ $index + $berobat->firstItem() }}</td>
                <td data-title="No berobat">{{$medis->no_berobat}}</td>
                <td data-title="NIK">{{$medis->nik}}</td>
                <td data-title="Jenis berobat">{{$medis->jenis_berobat}}</td>
                <td data-title="Nama" style="text-transform: uppercase">{{$medis->nama}}</td>
                <td data-title="Umur">{{$medis->umur}}</td>
                <td data-title="Poli">{{$medis->poli}}</td>
                <td data-title="Tanggal berobat"><?php echo $medis->tgl;?></td>
                <td data-title="Status"><?php if($medis->status =='2'){
                    echo '<span class="badge bg-success">Selesai diperiksa</span>';
                 }if($medis->status =='1'){
                    echo '<span class="badge bg-warning">Sedang diperiksa</span>';
                 }if($medis->status =='0'){
                     echo '<span class="badge bg-danger">Belum diperiksa</span>';
                  }?></td>
                 @If(Auth::user()->level =='admin')
                 <td data-title="Aksi">
                    <?php
                          if($medis->status =='2'){
                            echo '<a href="rekam_medis/pasien='.$medis->id.'&rekammedis='.$medis->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i></a>';
                         }if($medis->status =='0'){
                             echo '';
                          }?>
                      </td>
                 @endif
                @if(Auth::user()->level =='admin')
            <td data-title="Aksi">
                <?php if($medis->status =='0'){
                        echo '<a href="periksa_fisik/'.$medis->id.'?tgl='.date('d-m-Y').'" class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>';
                     }if($medis->status =='1'){
                         echo '';
                      }?>
                <?php if($medis->status =='1'){
                        echo '<a href="rekam_medis/pasien='.$medis->id.'&rekammedis='.$medis->pasien_id.'" class="btn btn-warning"><i class="fa-solid fa-laptop-medical"></i></a>';
                     }
                      if($medis->status =='2'){
                        echo '<a href="rekam_medis/pasien='.$medis->id.'&rekammedis='.$medis->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i></a>';
                     }if($medis->status =='0'){
                         echo '';
                      }?>
                <a href="hapus_berobat/{{$medis->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i></a>
            </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $berobat->links() }}
</div>
@endsection