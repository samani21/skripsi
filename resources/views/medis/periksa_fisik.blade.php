@extends('layouts.sidebar')

@section('content')

<form id="regForm" action="{{route('fisik.store',$berobat->id)}}" method="POST">
    @csrf
    <div class="tab">
         <p>Nama Pasien: <b style="text-transform: uppercase">{{$berobat->nama_berobat}}</b> <h3>Pemeriksa</h3></p>
        <div>
            <input type="hidden" id="berobat_id" name="berobat_id" value="{{$berobat->id}}">
            <input type="hidden" id="pasien_id" name="pasien_id" value="{{$berobat->pasien_id}}">
            <input class="form-control" type="hidden" id="status" name="status" value="1">
            <label for="">No berobat</label>
            <input class="form-control" type="text" value="{{$berobat->no_berobat}}" aria-label="default input example"
                readonly>
        </div>
        <div>
            <label for="">Tanggal berobat</label>
            <input class="form-control" type="text" id="tgl" name="tgl" value="@php echo date('d-m-Y') @endphp"
                aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Usia</label>
            <input class="form-control" type="text" id="umur" name="umur" value="{{$berobat->umur}}"
                aria-label="default input example" readonly>
        </div>
        <div>
            <label for="">Dokter</label>
            <input class="form-control" name="dokter" maxlength="50" style="text-transform: uppercase" list="dokter" id="exampleDataList" autocomplete="off" autofocus>
            <datalist id="dokter">
                @foreach($dokter as $dok)
                <option value="{{$dok->nama}}">{{$dok->spesialis}}</option>
                @endforeach
            </datalist>
        </div>
        <div>
            <label for="">Nama perawat</label>
            <input class="form-control" name="perawat" maxlength="50" style="text-transform: uppercase" list="perawat" id="exampleDataList" autocomplete="off">
            <datalist id="perawat">
                @foreach($perawat as $per)
                <option value="{{$per->nama}}">({{$per->spesialis}})</option>
                @endforeach
            </datalist>
        </div>
    </div>
    <br>
    <div class="tab">
        <p>Nama Pasien: <b style="text-transform: uppercase">{{$berobat->nama_berobat}}</b><h3>Pemeriksaan badan</h3></p>
        <div>
            <label for="">Sistolik</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="sistolik" name="sistolik"
                maxlength="5" oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Diastolik</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="diastolik" name="diastolik"
                maxlength="5" oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Saturasi</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="saturasi" name="saturasi"
                maxlength="5" oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Suhu</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="suhu" name="suhu" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Napas</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="napas" name="napas" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Tinggi</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="tinggi" name="tinggi" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Berat</label>
            <input class="form-control" type="text" placeholder="Masukkan angka" id="berat" name="berat" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
            <br>
        </div>
    </div>
    <br>
    <div class="tab">
        <p>Nama Pasien: <b style="text-transform: uppercase">{{$berobat->nama_berobat}}</b><h3>Pemeriksaan badan</h3></p>
        <div>
            <label for="">Keluhan</label>
            <textarea id="keluhan" name="keluhan" class="form-control" maxlength="255" style="height: 100px">-</textarea>
        </div>
        {{-- <div>
            <label for="">Nama Diagnosa</label>
            <input class="form-control" maxlength="100" name="diagnosa" list="diagnosa" id="exampleDataList" autocomplete="off"
                oninput="this.className = ''">
            <datalist id="diagnosa">
                @foreach($icd as $diagnosa)
                <option value="({{$diagnosa->code}}).{{$diagnosa->name_id}}">
                    @endforeach
            </datalist>
        </div> --}}
        <div>
            <label>Tindakan berobat</label>
            <select name="tindakan" class="form-control" oninput="this.className = ''">
                <option value="">--Pilih--</option>
                <option value="Tindakan">Tindakan</option>
                <option value="Pemeriksaan">Pemeriksaan</option>
                <option value="Konsultasi">Konsultasi</option>
            </select>
        </div>
        <div>
            <label for="">Keterangan</label>
            <textarea id="keterangan" name="keterangan" class="form-control"  maxlength="100"style="height: 100px">-</textarea>
        </div>
        <div>
            <label>Biaya</label>
            @php
            if($berobat->jenis_berobat == 'Umum'){
            echo '<input class="form-control" type="number" id="biaya" name="biaya" value="'.$berobat->umum.'"
                aria-label="default input example">';
            }if ($berobat->jenis_berobat == 'BPJS') {
            echo '<input class="form-control" type="text" id="biaya" name="biaya" value="Gratis"
                aria-label="default input example">';
            }
            @endphp
        </div>
    </div>
    <div class="tab">
        <table class="table table-bordered" id="dynamicAddRemove">
            <tr>
                <th>Diagnosa</th>
            </tr>
            <tr>
                <td>
                    <input class="form-control" type="hidden" value="{{$berobat->id}}" maxlength="100" name="addMoreInputFields[0][berobat_id]" autocomplete="off" placeholder="Nama diagnosa">
                    <input class="form-control" maxlength="100" list="diagnosa" name="addMoreInputFields[0][diagnosa]" autocomplete="off" placeholder="Nama diagnosa">
                    <datalist id="diagnosa">
                        @foreach($icd as $diagnosa)
                        <option value="({{$diagnosa->code}}).{{$diagnosa->name_id}}">
                            @endforeach
                    </datalist>
                </td>
                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-primary">Add Subject</button></td>
            </tr>
        </table>
    </div>
    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:10px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        if(i <= 15){
        ++i;
        $("#dynamicAddRemove").append('<tr><input type="hidden" value="{{$berobat->id}}" list="diagnosa" name="addMoreInputFields[' + i +
            '][berobat_id]" placeholder="Otomatis terisi" placeholder="Enter subject" class="form-control" /><td><input type="text" list="diagnosa" name="addMoreInputFields[' + i +
            '][diagnosa]" placeholder="Nama Diagnosa" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        }
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>
@endsection