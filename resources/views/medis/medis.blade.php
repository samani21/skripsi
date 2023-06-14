@extends('layouts.sidebar')

@section('content')

<div>
    <form action="{{route('medis/medis')}}" method="get" class="row">
        <div class="col-md-2">
            <label for=""><b>Cari rekam medis pasien</b></label>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="text" name="cari" list="poli" autocomplete="off" placeholder="Cari pasien / Poli"
                aria-label="default input example">
                <datalist id="poli">
                    <option value="Umum">Umum</option>
                    <option value="Anak">Anak</option>
                    <option value="Gigi">Gigi</option>
                    <option value="KB">KB</option>
                    <option value="Gizi">Gizi</option>
                    <option value="kandungan">kandungan</option>
                </datalist>
        </div>
        <div class="col-auto">
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
                 }if($medis->status =='1'||$medis->status =='3'){
                    echo '<span class="badge bg-warning">Sedang diperiksa</span>';
                 }if($medis->status =='0'){
                     echo '<span class="badge bg-danger">Belum diperiksa</span>';
                  }if($medis->status =='4'){
                    echo '<span class="badge bg-primary">Selesai</span>';
                 }?></td>
                 @If(Auth::user()->level =='admin' || Auth::user()->level =='operator')
                 <td data-title="Aksi">
                    <?php
                          if($medis->status =='2' || $medis->status =='4'){
                            echo '<a href="rekam_medis/berobat='.$medis->id.'&rekammedis='.$medis->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i></a>';
                         }if($medis->status =='0'){
                             echo '';
                          }?>
                      </td>
                 @endif
                @if(Auth::user()->level =='rekam_medis' || Auth::user()->level =='operator')
            <td data-title="Aksi">
                <?php if($medis->status =='0'){
                        echo '<a href="periksa_fisik/'.$medis->id.'?tgl='.date('d-m-Y').'" class="btn btn-primary"><i class="fa-solid fa-book-medical"></i></a>';
                     }if($medis->status =='1'||$medis->status =='3'){
                         echo '';
                      }?>
                <?php if($medis->status =='1'||$medis->status =='3'){
                        echo '<a href="rekam_medis/berobat='.$medis->id.'&rekammedis='.$medis->pasien_id.'" class="btn btn-warning"><i class="fa-solid fa-laptop-medical"></i></a>';
                     }
                      if($medis->status =='2' || $medis->status =='4'){
                        echo '<a href="rekam_medis/berobat='.$medis->id.'&rekammedis='.$medis->pasien_id.'" class="btn btn-success"><i class="fa-solid fa-laptop-medical"></i></a>';
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