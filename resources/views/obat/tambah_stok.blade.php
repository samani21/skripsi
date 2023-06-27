@extends('layouts.sidebar')

@section('content')

<form action="{{ route('stok.store') }}" method="POST">
    @csrf
    <div>
        <label for="">Tanggal</label>
        <input class="form-control" type="text" id="tgl" name="addMoreInputFields[0][tgl]" value="{{date('d-m-Y')}}" placeholder="Masukkan NIP" aria-label="default input example" readonly>
        <input class="form-control" type="hidden" id="bulan" name="addMoreInputFields[0][bulan]" value="{{date('m')}}" placeholder="Masukkan NIP" aria-label="default input example">
        <input class="form-control" type="hidden" id="tahun" name="addMoreInputFields[0][tahun]" value="{{date('Y')}}" placeholder="Masukkan NIP" aria-label="default input example">
    </div>
    <br>
            <table class="table table-bordered" id="dynamicAddRemove">
                <tr>
                    <th>No surat</th>
                    <th>kode obat</th>
                    <th>Jumlah</th>
                    <th>penerima</th>
                </tr>
                <tr>
                    <td>
                        <input class="form-control" maxlength="100" name="addMoreInputFields[0][no_surat]" id="s1" autocomplete="off" placeholder="Otomatis terisi" style="background-color: #dddddd" readonly>
                    </td>
                    <td> <input class="form-control" maxlength="100" name="addMoreInputFields[0][kode]" list="obat"  placeholder="Masukkan obat" id="exampleDataList" autocomplete="off" required>
                        <datalist id="obat">
                            @foreach($obat as $ob)
                            <option value="<?php if ($ob->kode <= '9') {
                                echo "KA000".$ob->kode;
                            }else
                            if ($ob->kode <= '99') {
                                echo "KA00".$ob->kode;
                            }
                            else
                            if ($ob->kode <= '999') {
                                echo "KA0".$ob->kode;
                            }else
                            if ($ob->kode <= '9999') {
                                echo "KA".$ob->kode;
                            }else {
                                echo $ob->kode;
                            } ?> : {{$ob->nm_obat}}">
                                @endforeach
                        </datalist>
                    </td>
                    <td>
                        <input class="form-control" maxlength="100" name="addMoreInputFields[0][jumlah]" placeholder="Masukkan jumlah" autocomplete="off" required required>
                    </td>
                    <td>
                        <input class="form-control" maxlength="100" name="addMoreInputFields[0][penerima]" id="p1" autocomplete="off" style="background-color: #dddddd" placeholder="Otomatis terisi" readonly required>
                    </td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary">Add Subject</button></td>
                </tr>
            </table>
            <div>
                <label for="">No Surat</label>
                <input type="text" id="surat" class="form-control" required>
            </div>
            <div>
                <label for="">Penarima</label>
                <input type="text" id="penerima" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        if(i <= 15){
        ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
            '][no_surat]" id="s' + i +
            '" style="background-color: #dddddd" placeholder="Otomatis terisi" required readonly placeholder="Enter subject" class="form-control" /></td><td><input type="text" list="obat" name="addMoreInputFields[' + i +
            '][kode]" placeholder="Masukkan obat" required class="form-control" autocomplete="off" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][jumlah]" placeholder="Masukkan jumlah" required class="form-control" /></td><td><input type="text" name="addMoreInputFields[' + i +
            '][penerima]"id="p' + i +
            '" readonly placeholder="Otomatis terisi" style="background-color: #dddddd" required class="form-control" /></td><input type="hidden" name="addMoreInputFields[' + i +
            '][tgl]" value="{{date('d-m-Y')}}" placeholder="Enter subject" class="form-control" /><input type="hidden" name="addMoreInputFields[' + i +
            '][bulan]" value="{{date('m')}}" placeholder="Enter subject" class="form-control" /><input type="hidden" name="addMoreInputFields[' + i +
            '][tahun]" value="{{date('Y')}}"placeholder="Enter subject" class="form-control" />><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        }
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    $("#surat").keyup(function(){   
    var a = String($("#surat").val());

    [$('#s2').val(a), $('#s3').val(a),$('#s4').val(a), $('#s5').val(a),$('#s6').val(a), $('#s7').val(a),
    $('#s8').val(a), $('#s3').val(a),$('#s2').val(a), $('#s3').val(a),$('#s2').val(a), $('#s3').val(a),
    $('#s9').val(a), $('#s10').val(a),$('#s11').val(a), $('#s12').val(a),$('#s13').val(a), $('#s14').val(a),
    $('#s1').val(a), $('#s15').val(a)];
    });
    
    $("#penerima").keyup(function(){   
    var b = String($("#penerima").val());

    [$('#p2').val(b), $('#p3').val(b),$('#p4').val(b), $('#p5').val(b),$('#p6').val(b), $('#p7').val(b),
    $('#p8').val(b), $('#p3').val(b),$('#p2').val(b), $('#p3').val(b),$('#p2').val(b), $('#p3').val(b),
    $('#p9').val(b), $('#p10').val(b),$('#p11').val(b), $('#p12').val(b),$('#p13').val(b), $('#p14').val(b),
    $('#p1').val(b), $('#p15').val(b)];
    });
</script>
@endsection