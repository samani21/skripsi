@extends('layouts.sidebar')

@section('content')

<form action="{{route('resep.store',$berobat->id)}}" method="POST">
    @csrf
    <input type="hidden" id="berobat_id" name="addMoreInputFields[0][berobat_id]" value="{{$berobat->id}}">
            {{-- <input class="form-control" type="hidden" id="status" name="status" value="2"> --}}
    <div>
        <label for="">Tanggal</label>
        <input class="form-control" type="text" id="tgl" name="addMoreInputFields[0][tgl]" value="{{date('d-m-Y')}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
        <input class="form-control" type="hidden" id="bulan" name="addMoreInputFields[0][bulan]" value="{{date('m')}}" placeholder="Masukkan NIP" aria-label="default input example">
        <input class="form-control" type="hidden" id="tahun" name="addMoreInputFields[0][tahun]" value="{{date('Y')}}" placeholder="Masukkan NIP" aria-label="default input example">
    </div>
    <br>
    <table class="table table-bordered" id="dynamicAddRemove">
        <tr>
            <th>Kode obat</th>
            <th>Jumlah</th>
            <th>Dosis</th>
            <th>Pemakaian</th>
        </tr>
        <tr>
            <td> <input class="form-control" maxlength="100" name="addMoreInputFields[0][kd_obat]" list="obat"  placeholder="Masukkan obat" id="exampleDataList" autocomplete="off">
                <datalist id="obat">
                    @foreach($obat as $ob)
                    <option value="{{$ob->kode}}">{{$ob->nm_obat}}
                        @endforeach
                </datalist>
            </td>
            <td>
                <input class="form-control" maxlength="100" name="addMoreInputFields[0][jumlah]" placeholder="Masukkan jumlah" autocomplete="off">
            </td>
            <td>
                <input class="form-control" maxlength="100" name="addMoreInputFields[0][dosis]" autocomplete="off" placeholder="Masukkan Dosis">
            </td>
            <td>
                <input class="form-control" maxlength="100" name="addMoreInputFields[0][pakai]" autocomplete="off" placeholder="Masukkan Pemakaian">
            </td>
            <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary">Add Subject</button></td>
        </tr>
    </table>
    <input type="hidden" value="{{$berobat->id}}" name="berobat">
    <input type="hidden" value="0" name="addMoreInputFields[0][status]">
    <input type="hidden" value="{{$berobat->pasien_id}}" name="pasien">
    <br>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/medis/rekam_medis/berobat={{$berobat->id}}&rekammedis={{$berobat->pasien_id}}"class="btn btn-warning"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
</div>

  </form>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        if(i <= 15){
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" list="obat" name="addMoreInputFields[' + i +
            '][kd_obat]" id="s' + i +
            '" placeholder="Masukkan obat" placeholder="Enter subject" class="form-control" /></td><td><input type="text"  name="addMoreInputFields[' + i +
            '][jumlah]" placeholder="Masukkan obat" class="form-control" /></td><td><input type="text"  name="addMoreInputFields[' + i +
            '][dosis]" placeholder="Masukkan jumlah" class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][pakai]"id="p' + i +
            '" placeholder="Masukkan Pemakaian" class="form-control" /></td><input type="hidden" list="diagnosa" name="addMoreInputFields[' + i +
            '][tgl]" value="{{date('d-m-Y')}}" placeholder="Enter subject" class="form-control" /><input type="hidden" list="diagnosa" name="addMoreInputFields[' + i +
            '][bulan]" value="{{date('m')}}" placeholder="Enter subject" class="form-control" /><input type="hidden" list="diagnosa" name="addMoreInputFields[' + i +
            '][tahun]" value="{{date('Y')}}"placeholder="Enter subject" class="form-control" /><input type="hidden" list="diagnosa" name="addMoreInputFields[' + i +
            '][berobat_id]" value="{{$berobat->id}}"placeholder="Enter subject" class="form-control" /><input type="hidden" list="diagnosa" name="addMoreInputFields[' + i +
            '][status]" value="0"placeholder="Enter subject" class="form-control" /><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        }
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection