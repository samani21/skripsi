@extends('layouts.sidebar')

@section('content')
<a href="#" class="btn btn-danger" onclick="goBack()"><i class="fa-solid fa-chevron-left"></i>
    Kembali</a>
                <script>
                    function goBack() {
                        window.history.back();
                    }
                </script>
<form id="regForm" action="{{route('updatefisik',$fisik->id)}}" method="POST">
    @csrf
    <div class="tab">

        <input type="hidden" name="berobat" value="{{$fisik->id}}">
        <input type="hidden" name="rekammedis" value="{{$berobat->pasien_id}}">
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
            <input class="form-control" name="dokter" maxlength="50" value="{{$fisik->dokter}}" style="text-transform: uppercase" list="dokter" id="exampleDataList" autocomplete="off" autofocus>
            <datalist id="dokter">
                @foreach($dokter as $dok)
                <option value="{{$dok->nama}}({{$dok->spesialis}})">{{$dok->nama}}({{$dok->spesialis}})</option>
                @endforeach
            </datalist>
        </div>
        <div>
            <label for="">Nama perawat</label>
            <input class="form-control" name="perawat" maxlength="50" value="{{$fisik->perawat}}" style="text-transform: uppercase" list="perawat" id="exampleDataList" autocomplete="off">
            <datalist id="perawat">
                @foreach($perawat as $per)
                <option value="{{$per->nama}}({{$per->spesialis}})">{{$per->nama}}({{$per->spesialis}})</option>
                @endforeach
            </datalist>
        </div>
    </div>
    <br>
    <div class="tab">
        <p>Nama Pasien: <b style="text-transform: uppercase">{{$berobat->nama_berobat}}</b><h3>Pemeriksaan badan</h3></p>
        <div>
            <label for="">Sistolik</label>
            <input class="form-control" type="text" value="{{$fisik->sistolik}}" placeholder="Masukkan angka" id="sistolik" name="sistolik"
                maxlength="5" oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Diastolik</label>
            <input class="form-control" type="text" value="{{$fisik->diastolik}}" placeholder="Masukkan angka" id="diastolik" name="diastolik"
                maxlength="5" oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Saturasi</label>
            <input class="form-control" type="text" value="{{$fisik->saturasi}}" placeholder="Masukkan angka" id="saturasi" name="saturasi"
                maxlength="5" oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Suhu</label>
            <input class="form-control" type="text" value="{{$fisik->suhu}}" placeholder="Masukkan angka" id="suhu" name="suhu" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Napas</label>
            <input class="form-control" type="text" value="{{$fisik->napas}}" placeholder="Masukkan angka" id="napas" name="napas" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Tinggi</label>
            <input class="form-control" type="text" value="{{$fisik->tinggi}}" placeholder="Masukkan angka" id="tinggi" name="tinggi" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
        </div>
        <div>
            <label for="">Berat</label>
            <input class="form-control" type="text" value="{{$fisik->berat}}" placeholder="Masukkan angka" id="berat" name="berat" maxlength="5"
                oninput="this.className = ''" aria-label="default input example">
            <br>
        </div>
    </div>
    <br>
    <div class="tab">
        <p>Nama Pasien: <b style="text-transform: uppercase">{{$berobat->nama_berobat}}</b><h3>Pemeriksaan badan</h3></p>
        <div>
            <label for="">Keluhan</label>
            <textarea id="keluhan" name="keluhan" maxlength="255" class="form-control" style="height: 100px">{{$fisik->keluhan}}</textarea>
        </div>
        <div>
            <label>Tindakan berobat</label>
            <select name="tindakan" class="form-control" oninput="this.className = ''">
                <option value="{{$fisik->tindakan}}">{{$fisik->tindakan}}</option>
                <option value="Tindakan">Tindakan</option>
                <option value="Pemeriksaan">Pemeriksaan</option>
                <option value="Konsultasi">Konsultasi</option>
            </select>
        </div>
        <div>
            <label for="">Keterangan</label>
            <textarea id="keterangan" name="keterangan" maxlength="100" class="form-control" style="height: 100px">{{$fisik->keterangan}}</textarea>
        </div>
        <div>
            <label>Biaya</label>
            <input class="form-control" type="text" id="biaya" name="biaya" value="{{$fisik->biaya}}" required
            aria-label="default input example">
        </div>
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

@endsection