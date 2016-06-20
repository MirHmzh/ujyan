@extends('sentinel.layouts.default')

@section('content')
<style type="text/css">
    div[id*=soal]{
        display: none;
    }
    div#soal1{
        display: block;
    }
</style>
<div id="clock"></div>
<script type="text/javascript">
var fiveSeconds = new Date().getTime() + 5000000;
 $('#clock').countdown(fiveSeconds, {elapse: true})
  .on('update.countdown', function(event) {
    var $this = $(this);
    if (event.elapsed) {
      document.getElementById('form').submit();;
    } else {
      $this.html(event.strftime('Waktu Tersisa: <span>%H:%M:%S</span><br><br><br>'));
   }
 });
$(document).ready(function() {

    (function($){

        $.extend({

            APP : {

                formatTimer : function(a) {
                    if (a < 10) {
                        a = '0' + a;
                    }
                    return a;
                },

                startTimer : function(dir) {

                    var a;

                    // save type
                    $.APP.dir = dir;

                    // get current date
                    $.APP.d1 = new Date();

                    switch($.APP.state) {

                        case 'pause' :

                            // resume timer
                            // get current timestamp (for calculations) and
                            // substract time difference between pause and now
                            $.APP.t1 = $.APP.d1.getTime() - $.APP.td;

                        break;

                        default :

                            // get current timestamp (for calculations)
                            $.APP.t1 = $.APP.d1.getTime();

                            // if countdown add ms based on seconds in textfield
                            if ($.APP.dir === 'cd') {
                                $.APP.t1 += parseInt($('#cd_seconds').val())*1000;
                            }

                        break;

                    }

                    // reset state
                    $.APP.state = 'alive';
                    $('#' + $.APP.dir + '_status').html('Running');

                    // start loop
                    $.APP.loopTimer();

                },

                pauseTimer : function() {

                    // save timestamp of pause
                    $.APP.dp = new Date();
                    $.APP.tp = $.APP.dp.getTime();

                    // save elapsed time (until pause)
                    $.APP.td = $.APP.tp - $.APP.t1;

                    // change button value
                    $('#' + $.APP.dir + '_start').val('Resume');

                    // set state
                    $.APP.state = 'pause';
                    $('#' + $.APP.dir + '_status').html('Paused');

                },

                stopTimer : function() {

                    // change button value
                    $('#' + $.APP.dir + '_start').val('Restart');

                    // set state
                    $.APP.state = 'stop';
                    $('#' + $.APP.dir + '_status').html('Stopped');

                },

                resetTimer : function() {

                    // reset display
                    $('#' + $.APP.dir + '_ms,#' + $.APP.dir + '_s,#' + $.APP.dir + '_m,#' + $.APP.dir + '_h').html('00');

                    // change button value
                    $('#' + $.APP.dir + '_start').val('Start');

                    // set state
                    $.APP.state = 'reset';
                    $('#' + $.APP.dir + '_status').html('Reset & Idle again');

                },

                endTimer : function(callback) {

                    // change button value
                    $('#' + $.APP.dir + '_start').val('Restart');

                    // set state
                    $.APP.state = 'end';

                    // invoke callback
                    if (typeof callback === 'function') {
                        callback();
                    }

                },

                fillinput : function(){
                    $("#sw_pause,#cd_pause").click(function () {
                        $("#time").val("tes1");
                    });
                },

                loopTimer : function() {

                    var td;
                    var d2,t2;

                    var ms = 0;
                    var s  = 0;
                    var m  = 0;
                    var h  = 0;

                    if ($.APP.state === 'alive') {

                        // get current date and convert it into
                        // timestamp for calculations
                        d2 = new Date();
                        t2 = d2.getTime();

                        // calculate time difference between
                        // initial and current timestamp
                        if ($.APP.dir === 'sw') {
                            td = t2 - $.APP.t1;
                        // reversed if countdown
                        } else {
                            td = $.APP.t1 - t2;
                            if (td <= 0) {
                                // if time difference is 0 end countdown
                                $.APP.endTimer(function(){
                                    $.APP.resetTimer();
                                    $('#' + $.APP.dir + '_status').html('Ended & Reset');
                                });
                            }
                        }

                        // calculate milliseconds
                        ms = td%1000;
                        if (ms < 1) {
                            ms = 0;
                        } else {
                            // calculate seconds
                            s = (td-ms)/1000;
                            if (s < 1) {
                                s = 0;
                            } else {
                                // calculate minutes
                                var m = (s-(s%60))/60;
                                if (m < 1) {
                                    m = 0;
                                } else {
                                    // calculate hours
                                    var h = (m-(m%60))/60;
                                    if (h < 1) {
                                        h = 0;
                                    }
                                }
                            }
                        }

                        // substract elapsed minutes & hours
                        ms = Math.round(ms/100);
                        s  = s-(m*60);
                        m  = m-(h*60);

                        // update display
                        $('#' + $.APP.dir + '_ms').html($.APP.formatTimer(ms));
                        $('#' + $.APP.dir + '_s').html($.APP.formatTimer(s));
                        $('#' + $.APP.dir + '_m').html($.APP.formatTimer(m));
                        $('#' + $.APP.dir + '_h').html($.APP.formatTimer(h));

                        // loop
                        $.APP.t = setTimeout($.APP.loopTimer,1);

                    } else {

                        // kill loop
                        clearTimeout($.APP.t);
                        return true;

                    }

                }

            }

        });

        window.onload = $.APP.startTimer('sw');

        $('#sw_start').on('click', function() {
            $.APP.startTimer('sw');
        });

        $('#cd_start').on('click', function() {
            $.APP.startTimer('cd');
        });

        $('#sw_stop,#cd_stop').on('click', function() {
            $.APP.stopTimer();
        });

        $('#sw_reset,#cd_reset').on('click', function() {
            $.APP.resetTimer();
        });

        $('#sw_pause,#cd_pause').on('click', function() {
            $.APP.pauseTimer();
            $("#timestamp1").val($("#time").text());
        });

        var xx = 4;
        $('#next').on('click', function(){
            $.APP.pauseTimer();
            $("#timestamp"+xx).val($("#time").text());
            xx++;
            $.APP.resetTimer();
            $.APP.startTimer('sw');
        });

        $('#btn-submitted').on('click', function(){
            $.APP.pauseTimer();
            $("#timestamp"+xx).val($("#time").text());
            xx++;
            $.APP.resetTimer();
            $.APP.startTimer('sw');
        });

    })(jQuery);

});
    $(function(){
        $('#submitted').hide();
        $('#btn-submitted').hide();
    });
    var z=2;
    function toggle_visibility() {
        $('.soal').hide();
        $('#soal'+z).show();
        var jml_soal = document.getElementsByClassName('soal').length;
        if (z == jml_soal) {
            $('.js-button').hide();
            $('#submitted').show();
        }
        //alert(jml_soal+' '+z);
        z++;
    }
    function kirim(){
        $('#form').submit();
        $('#btn-submitted').click();
    }
</script>
<div class="row">
    <form method="POST" id="form" class="col s12" action="pdf">

        <div id="soal1" class="soal row">
        <input name="line4" type="hidden" value="<hr>">
        <input name="blok4" type="hidden" value="<h2> Blok 4 </h2>">
        <h1>Psikologi</h1>
            <input name="hidsoal1" type="hidden" value="1. Berapa kali angka 7 muncul di antara bilangan 1 sampai 100?<br> Jawab : ">
            Berapa kali angka 7 muncul di antara bilangan 1 sampai 100?<br>
            <div class="input-field col s12">
                <textarea name="array1" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal2" type="hidden" value="<br>2. Ada dua kakak beradik yang jumlah umurnya 11 tahun. Yang satu 10 tahun lebih tua dari yang lain. Berapakah umur mereka masing-masing?<br> Jawab : ">
            Ada dua kakak beradik yang jumlah umurnya 11 tahun. Yang satu 10 tahun lebih tua dari yang lain. Berapakah umur mereka masing-masing?<br>
            <div class="input-field col s12">
                <textarea name="array2" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal3" type="hidden" value=" <br>3. Sepasang suami istri punya 4 anak perempuan & setiap anak perempuan mempunyai 1 orang saudara laki laki, berapa anggota keluarga itu? <br> Jawab : ">
            Sepasang suami istri punya 4 anak perempuan & setiap anak perempuan mempunyai 1 orang saudara laki laki, berapa anggota keluarga itu?<br>
            <div class="input-field col s12">
                <textarea name="array3" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal4" type="hidden" value=" <br>4. Bagaimana membagi satu buah kue tart menjadi 8 potong hanya dengan 3 kali memotong? <br> Jawab : ">
            Bagaimana membagi satu buah kue tart menjadi 8 potong hanya dengan 3 kali memotong?<br>
            <div class="input-field col s12">
                <textarea name="array4" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal5" type="hidden" value=" <br>5. Mana yang lebih besar, 18 persen dari 81 atau 81 persen dari 18? <br> Jawab : ">
            Mana yang lebih besar, 18 persen dari 81 atau 81 persen dari 18?<br>
            <div class="input-field col s12">
                <textarea name="array5" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal6" type="hidden" value=" <br>6. Buatlah algoritma untuk menghitung luas lingkaran! <br> Jawab : ">
            Buatlah algoritma untuk menghitung luas lingkaran!<br>
            <div class="input-field col s12">
                <textarea name="array6" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal7" type="hidden" value=" <br>7. Buatlah algoritman untuk menentukan bahwa bilangan yang diinputkan adalah bilangan genap atau ganjil <br> Jawab : ">
            Buatlah algoritman untuk menentukan bahwa bilangan yang diinputkan adalah bilangan genap atau ganjil<br>
            <div class="input-field col s12">
                <textarea name="array7" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>
            <input type="hidden" name="break4" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp4" id="timestamp4" type="text"/>
        </div>


        <div id ="soal2" class="soal row">
            <h1>Analogi</h1>
            <input name="line5" type="hidden" value="<hr>">
            <input name="blok5" type="hidden" value="<h2> Blok 5 </h2>">
            <input name="hidsoal8" type="hidden" value=" 8. Berikan penjelasan untuk flowchart perulangan dibawah ini <br> Jawab : ">
            Berikan penjelasan untuk flowchart perulangan dibawah ini
            <div class="input-field col s12">
                <textarea name="array8" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>
            <img src="img/flow.png">
            <input type="hidden" name="break5" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp5" id="timestamp5" type="text"/>
        </div>


        <div id="soal3" class="soal row">
            <h1>Analisa</h1>
            <input name="line6" type="hidden" value="<hr>">
            <input name="blok6" type="hidden" value="<h2> Blok 6 </h2>">
            <span style="font-size: 13px;text-indent: 10px;">Untuk soal kedua soal dibawah:</span><br>
            <span style="font-size: 13px;text-indent: 50px;">Saya ingin membuat aplikasi jual beli sederhana pada mini market yang terdiri dari : Form Login, Form Kasir, Form Penjualan, Dan Form laporan penjualan yang akan dibuat</span><br><br>

            <input name="hidsoal9" type="hidden" value="9. entukan fasilitas yang dibutuhkan dari analisa diatas <br> Jawab : ">
            Tentukan fasilitas yang dibutuhkan dari analisa diatas<br>
            <div class="input-field col s12">
                <textarea name="array9" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal10" type="hidden" value=" <br>Buatlah rancangan menunya <br> Jawab : ">
            Buatlah rancangan menunya<br>
            <div class="input-field col s12">
                <textarea name="array10" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>
            <input type="hidden" name="break6" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp6" id="timestamp6" type="text"/>
        </div>

        <div id="soal4" class="soal row">
            <input name="line7" type="hidden" value="<hr>">
            <input name="blok7" type="hidden" value="<h2> Blok 7 </h2>">
            <h2>Please answer all of the questions below in English</h2><br>
            <span style="font-size: 13px;">
                Dilarang menggunakan translator, kamus, mesin, ataupun alat penerjemah lainnya. Cukup gunakan skill Bahasa Inggris yang sudah anda miliki seadanya. We'll try to understand whatever you typed down, in shaa Allah
            </span><br>
            <span style="font-size: 13px;">
                Jawaban dalam Bahasa Indonesia tidak akan dinilai kecuali pilihan ganda yang terakhir. No offense ya.
            </span></h1>

            <input name="hidsoal11" type="hidden" value=" 11. Siapa dan apa yang memotivasi anda menjadi seorang developer?<br> Jawab : ">
            Siapa dan apa yang memotivasi anda menjadi seorang developer?</h1><br>
            <div class="input-field col s12">
                <textarea name="array11" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal12" type="hidden" value=" <br>12. Sebutkan modal yang anda miliki untuk menjadi seorang developer <br> Jawab : ">
            Sebutkan modal yang anda miliki untuk menjadi seorang developer</h1><br>
            <div class="input-field col s12">
                <textarea name="array12" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal13" type="hidden" value=" <br>13. Berikan beberapa tindakan yang telah anda lakukan agar anda bisa menjadi seorang developer <br> Jawab : ">
            Berikan beberapa tindakan yang telah anda lakukan agar anda bisa menjadi seorang developer</h1><br>
            <div class="input-field col s12">
                <textarea name="array13" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal14" type="hidden" value=" <br>14. Apa yang anda ketahui tentang bahasa pemrograman? Beri penjelasan dan contoh bahasa pemrograman yang anda ketahui <br> Jawab : ">
            Apa yang anda ketahui tentang bahasa pemrograman? Beri penjelasan dan contoh bahasa pemrograman yang anda ketahui</h1><br>
            <div class="input-field col s12">
                <textarea name="array14" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal15" type="hidden" value=" <br>15. Apa tujuan dan harapan anda ingin mengikuti Madani IT School ini? <br> Jawab : ">
            Apa tujuan dan harapan anda ingin mengikuti Madani IT School ini?</h1><br>
            <div class="input-field col s12">
                <textarea name="array15" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal16" type="hidden" value=" <br>16. (Please be honest) The score of your last TOEFL tes you took was ">
            (Please be honest) The score of your last TOEFL tes you took was...</h1><br>
            <span style="font-size: 13px;">Approximate is fine, if you forgot. Type 0 if you've never had one.</span></h1><br>
            <div class="input-field col s12">
                <textarea name="array16" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal17" type="hidden" value=" <br>17. Anda yakin sudah menjawab dalam Bahasa Inggris seluruh soal diatas, dengan mengikuti prosedur yang tertera di bagian atas halaman ini? <br> Jawab : ">
            Anda yakin sudah menjawab dalam Bahasa Inggris seluruh soal diatas, dengan mengikuti prosedur yang tertera di bagian atas halaman ini?
            <p>
              <input name="answer7" type="radio" id="test40" value="A" />
              <label for="test40">A. 900jt</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test41" value="B" />
              <label for="test41">B. Lupa</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test42" value="C" />
              <label for="test42">C. Ga Main</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test43" value="D" />
              <label for="test43">D. Main Cheat Gw</label>
            </p>

            <input name="hidsoal18" type="hidden" value=" <br>18. Tandai perangkat mana saja yang akan anda bawa saat mengikuti pelatihan di Madani IT School apabila diterima, untuk mendukung belajar anda <br> <ul> ">
            Tandai perangkat mana saja yang akan anda bawa saat mengikuti pelatihan di Madani IT School apabila diterima, untuk mendukung belajar anda<br>
            <p>
              <input name="iD1" type="checkbox" id="test44" value=" <li> iPhone dengan iOS8 keatas<br> " />
              <label for="test44"> iPhone dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD2" type="checkbox" id="test45" value=" <li> iPad dengan iOS8 keatas<br> "/>
              <label for="test45"> iPad dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD3" type="checkbox" id="test46" value=" <li> iPod dengan iOS8 keatas<br> "/>
              <label for="test46"> iPod dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD4" type="checkbox" id="test47" value=" <li> iWatch dengan iOS8 keatas<br> "/>
              <label for="test47"> iWatch dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD5" type="checkbox" id="test48" value=" <li> Macbook dengan minimum OSX El Capitan<br> "/>
              <label for="test48"> Macbook dengan minimum OSX El Capitan </label>
            </p>
            <p>
              <input name="iD6" type="checkbox" id="test49" value=" <li> iMac lengkap, dengan minimum OSX El Capitan<br> "/>
              <label for="test49"> iMac lengkap, dengan minimum OSX El Capitan </label>
            </p>
            <p>
              <input name="iD7" type="checkbox" id="test50" value=" <li> Mac mini dengan minimum OSX El Capitan<br> "/>
              <label for="test50"> Mac mini dengan minimum OSX El Capitan </label>
            </p>
            <p>
              <input name="iD8" type="checkbox" id="test51" value=" <li> Device lainnya yang sudah mendukung operasional XCode7+ atau iOS8+<br> "/>
              <label for="test51"> Device lainnya yang sudah mendukung operasional XCode7+ atau iOS8+ </label>
            </p>
            <p>
              <input name="iD9" type="checkbox" id="test52" value=" Other :  "/>
              <label for="test52"> Other: </label>
              <input name="otherdevice" type="text" placeholder="Sebutkan disini jika tidak membawa kesemuanya dan centang Other, kosongi jika anda membawa dari list diatas">
              <input name="ul" type="hidden" value="</ul>">
            </p>
            <input type="hidden" name="break7" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp7" id="timestamp7" type="text"/>
        </div>


        <a id="next" href="#" onclick="toggle_visibility()" class="btn js-button">Next</a>
        <a href="#" onclick="confirm('Are You Sure')? kirim():alert('Data doesn\'t Submitted!');" class="btn waves-effect" id="submitted">
            Submit
        </a>
        <button class="btn waves-effect" type="submit" id="btn-submitted">Submit
            <i class="material-icons right">send</i>
        </button>

    </form>
</div>

<div>
    <div id="time">
        <span id="sw_h">00</span>:
        <span id="sw_m">00</span>:
        <span id="sw_s">00</span>:
        <span id="sw_ms">00</span>
    </div>
    <br/>
    <br/>
    <input type="button" value="Start" id="sw_start" />
    <input type="button" value="Pause" id="sw_pause" />
    <input type="button" value="Stop"  id="sw_stop" />
    <input type="button" value="Reset" id="sw_reset" />
    <br/>
    <br/>
</div>


@endsection

@section('js')

@endsection