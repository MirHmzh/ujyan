@extends('sentinel.layouts.default')

@section('content')
<<<<<<< HEAD
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

var fiveSeconds = new Date().getTime() + 7200000;
=======
<div id="clock"></div>
<script type="text/javascript">
var fiveSeconds = new Date().getTime() + 5000;
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
 $('#clock').countdown(fiveSeconds, {elapse: true})
  .on('update.countdown', function(event) {
    var $this = $(this);
    if (event.elapsed) {
<<<<<<< HEAD
      document.getElementById('form').submit();
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

        window = $.APP.pauseTimer();
        window.onload = $.APP.startTimer('cd');

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

        var xx = 1;
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
            localStorage.clear('answer1');
        });

        $('#submitted').on('click', function(){
            localStorage.clear();
        });

        $(document).ready(function() {
            $.APP.pauseTimer();
            $.APP.startTimer('cd');
        });

    })(jQuery);

});
    $(function(){
        $('#submitted').hide();
        $('#btn-submitted').hide();
    });

    $(document).ready(function(){
        if(localStorage.getItem('idsoal') == null){
            localStorage.setItem('idsoal',1);
        }
        var x = localStorage.getItem('idsoal');
        $('.soal').hide();
        $('#soal'+x).show();
    });

    var z=localStorage.getItem('idsoal');
    function toggle_visibility(){
        $('.soal').hide();
        $('#soal'+z).show();
        var jml_soal = document.getElementsByClassName('soal').length;
        if (z == jml_soal) {
            $('.js-button').hide();
            $('#submitted').show();
        }
        localStorage.setItem('idsoal',z);
        z++;
    }
    function kirim(){
        localStorage.clear();
        $('#form').submit();
        $('#btn-submitted').click();
    };

    $(document).ready(function(){
        $(window).unload(saveSettings);
        loadSettings();
    });

    function loadSettings() {
        $('input[value="' + localStorage.answer1 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer2 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer3 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer4 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer5 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer6 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer7 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer8 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer9 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer10 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer11 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer12 + '"]').prop('checked', true);
        $('input[value="' + localStorage.answer13 + '"]').prop('checked', true);
        $('textarea[name="array1"]').val(localStorage.array1);
        $('textarea[name="array2"]').val(localStorage.array2);
        $('textarea[name="array3"]').val(localStorage.array3);
        $('textarea[name="array4"]').val(localStorage.array4);
        $('textarea[name="array5"]').val(localStorage.array5);
        $('textarea[name="array6"]').val(localStorage.array6);
        $('textarea[name="array7"]').val(localStorage.array7);
        $('textarea[name="array8"]').val(localStorage.array8);
        $('textarea[name="array9"]').val(localStorage.array9);
        $('textarea[name="array10"]').val(localStorage.array10);
        $('textarea[name="array11"]').val(localStorage.array11);
        $('textarea[name="array12"]').val(localStorage.array12);
        $('textarea[name="array13"]').val(localStorage.array13);
        $('textarea[name="array14"]').val(localStorage.array14);
        $('textarea[name="array15"]').val(localStorage.array15);
        $('textarea[name="array16"]').val(localStorage.array16);
        $('input[value="' + localStorage.iD1 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD2 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD3 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD4 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD5 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD6 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD7 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD8 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD9 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD10 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD11 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD12 + '"]').prop('checked', true);
        $('input[value="' + localStorage.iD13 + '"]').prop('checked', true);
        $('input[name="otherreason"').val(localStorage.otherreason);
        $('input[name="otherdevice"').val(localStorage.otherdevice);
        $('input[name="otherreason1"').val(localStorage.otherreason1);
    }

    function saveSettings() {
        localStorage.answer1 = $('input[name=answer1]:checked').val();
        localStorage.answer2 = $('input[name=answer2]:checked').val();
        localStorage.answer3 = $('input[name=answer3]:checked').val();
        localStorage.answer4 = $('input[name=answer4]:checked').val();
        localStorage.answer5 = $('input[name=answer5]:checked').val();
        localStorage.answer6 = $('input[name=answer6]:checked').val();
        localStorage.answer7 = $('input[name=answer7]:checked').val();
        localStorage.answer8 = $('input[name=answer8]:checked').val();
        localStorage.answer9 = $('input[name=answer9]:checked').val();
        localStorage.answer10 = $('input[name=answer10]:checked').val();
        localStorage.answer11 = $('input[name=answer11]:checked').val();
        localStorage.answer12 = $('input[name=answer12]:checked').val();
        localStorage.answer13 = $('input[name=answer13]:checked').val();
        localStorage.array1 = $('textarea[name=array1]').val();
        localStorage.array2 = $('textarea[name=array2]').val();
        localStorage.array3 = $('textarea[name=array3]').val();
        localStorage.array4 = $('textarea[name=array4]').val();
        localStorage.array5 = $('textarea[name=array5]').val();
        localStorage.array6 = $('textarea[name=array6]').val();
        localStorage.array7 = $('textarea[name=array7]').val();
        localStorage.array8 = $('textarea[name=array8]').val();
        localStorage.array9 = $('textarea[name=array9]').val();
        localStorage.array10 = $('textarea[name=array10]').val();
        localStorage.array11 = $('textarea[name=array11]').val();
        localStorage.array12 = $('textarea[name=array12]').val();
        localStorage.array13 = $('textarea[name=array13]').val();
        localStorage.array14 = $('textarea[name=array14]').val();
        localStorage.array15 = $('textarea[name=array15]').val();
        localStorage.array16 = $('textarea[name=array16]').val();
        localStorage.iD1 = $('input[name=iD1]:checked').val();
        localStorage.iD2 = $('input[name=iD2]:checked').val();
        localStorage.iD3 = $('input[name=iD3]:checked').val();
        localStorage.iD4 = $('input[name=iD4]:checked').val();
        localStorage.iD5 = $('input[name=iD5]:checked').val();
        localStorage.iD6 = $('input[name=iD6]:checked').val();
        localStorage.iD7 = $('input[name=iD7]:checked').val();
        localStorage.iD8 = $('input[name=iD8]:checked').val();
        localStorage.iD9 = $('input[name=iD9]:checked').val();
        localStorage.iD10 = $('input[name=iD10]:checked').val();
        localStorage.iD11 = $('input[name=iD11]:checked').val();
        localStorage.iD12 = $('input[name=iD12]:checked').val();
        localStorage.iD13 = $('input[name=iD13]:checked').val();
        localStorage.otherreason = $('input[name="otherreason"').val();
        localStorage.otherreason1 = $('input[name="otherreason1"').val();
        localStorage.otherdevice = $('input[name="otherdevice"').val();
    }

    function clearLocalStorage() {
        localStorage.clear();
    }

</script>
<div class="row">
    <form method="POST" id="form" class="col s12" action="pdf">
        <div id="soal1" class="soal row" style="page-break-before: always;">
        <input name="line1" type="hidden" value="<hr>">
        <input name="blok1" type="hidden" value="<h2> Blok 1 </h2>">
            <input name="hidsoal1" type="hidden" value="1. Seberapa besar keinginan Anda untuk bisa diterima di Madani IT School?<br> Jawab : ">Seberapa besar keinginan Anda untuk bisa diterima di Madani IT School?<br>
              <p>
              <input autocomplete="off" name="answer1" type="radio" id="test1" value="A. 1" />
              <label for="test1">1</label>

              <input name="answer1" type="radio" id="test2" value="B. 2" />
              <label for="test2">2</label>

              <input name="answer1" type="radio" id="test3" value="C. 3" />
              <label for="test3">3</label>

              <input name="answer1" type="radio" id="test4" value="D. 4" />
              <label for="test4">4</label>

              <input name="answer1" type="radio" id="test5" value="E. 5" />
              <label for="test5">5</label>
              </p>
            <br>
            <br>
            <input name="hidsoal2" type="hidden" value="<br>2. Apabila pada akhirnya anda dinyatakan lolos seleksi, bersediakah anda mengikuti program pendidikan 1 tahun di Madani IT School, dilanjutkan dengan 2 tahun ikatan kerja?<br> Jawab : ">Apabila pada akhirnya anda dinyatakan lolos seleksi, bersediakah anda mengikuti program pendidikan 1 tahun di Madani IT School, dilanjutkan dengan 2 tahun ikatan kerja?<br>
            <p>
              <input name="answer2" type="radio" id="test6" value="A. Ya, insyaa Allah saya bersedia. Saya juga sudah mendapat izin orang tua / wali" />
              <label for="test6">Ya, insyaa Allah saya bersedia. Saya juga sudah mendapat izin orang tua / wali</label>
            </p>
            <p>
              <input name="answer2" type="radio" id="test7" value="B . Tidak, saya tidak bersedia" />
              <label for="test7">Tidak, saya tidak bersedia</label>
            </p>
            <input type="hidden" name="break1" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp1" id="timestamp1" type="hidden"/>
        </div>


        <div id ="soal2" class="soal row" style="page-break-before: always;">
            <input name="line2" type="hidden" value="<hr>">
            <input name="blok2" type="hidden" value="<h2> Blok 2 </h2>">
            <input name="hidsoal3" type="hidden" value="3. Seri Angka : 75 97 60 92 45 Selanjutnya...<br> Jawab : ">Seri Angka : 75 97 60 92 45 Selanjutnya...<br>
            <p>
              <input name="answer3" type="radio" id="test8" value="A. 87" />
              <label for="test8">87</label>
            </p>
            <p>
              <input name="answer3" type="radio" id="test9" value="B. 78" />
              <label for="test9">78</label>
            </p>
            <p>
              <input name="answer3" type="radio" id="test10" value="C. 102" />
              <label for="test10">102</label>
            </p>
            <p>
              <input name="answer3" type="radio" id="test11" value="D. 75" />
              <label for="test11">75</label>
            </p>
            <p>
              <input name="answer3" type="radio" id="test12" value="E. 54" />
              <label for="test12">54</label>
            </p><br>

            <input name="hidsoal4" type="hidden" value="<br>4. Seri Angka : 18 16 0 19 17 0 Selanjutnya...<br> Jawab : ">Seri Angka : 18 16 0 19 17 0 Selanjutnya...<br>
            <p>
              <input name="answer4" type="radio" id="test13" value="A. 20 18" />
              <label for="test13">20 18</label>
            </p>
            <p>
              <input name="answer4" type="radio" id="test14" value="B. 22 20" />
              <label for="test14">22 20</label>
            </p>
            <p>
              <input name="answer4" type="radio" id="test15" value="C. 18 20" />
              <label for="test15">18 20</label>
            </p>
            <p>
              <input name="answer4" type="radio" id="test16" value="D. 21 18" />
              <label for="test16">21 18</label>
            </p>
            <p>
              <input name="answer4" type="radio" id="test17" value="E. 23 19" />
              <label for="test17">23 19</label>
            </p><br>

            <input name="hidsoal5" type="hidden" value="<br>5. Seri Angka : 80 60 41 24 10 selanjutnya...<br> Jawab : ">Seri Angka : 80 60 41 24 10 selanjutnya...<br>
            <p>
              <input name="answer5" type="radio" id="test18" value="A. 8" />
              <label for="test18">8</label>
            </p>
            <p>
              <input name="answer5" type="radio" id="test19" value="B. 6" />
              <label for="test19">6</label>
            </p>
            <p>
              <input name="answer5" type="radio" id="test20" value="C. 4" />
              <label for="test20">4</label>
            </p>
            <p>
              <input name="answer5" type="radio" id="test21" value="D. 2" />
              <label for="test21">2</label>
            </p>
            <p>
              <input name="answer5" type="radio" id="test22" value="E. 0" />
              <label for="test22">0</label>
            </p><br>

            <input name="hidsoal6" type="hidden" value="<br>6. Seri Angka : -4 -3 0 5 12 selanjutnya...<br> Jawab : ">Seri Angka : -4 -3 0 5 12 selanjutnya...<br>
            <p>
              <input name="answer6" type="radio" id="test23" value="A. 21" />
              <label for="test23">21</label>
            </p>
            <p>
              <input name="answer6" type="radio" id="test24" value="B. 19" />
              <label for="test24">19</label>
            </p>
            <p>
              <input name="answer6" type="radio" id="test25" value="C. 17" />
              <label for="test25">17</label>
            </p>
            <p>
              <input name="answer6" type="radio" id="test26" value="D. 15" />
              <label for="test26">15</label>
            </p>
            <p>
              <input name="answer6" type="radio" id="test27" value="E. 23" />
              <label for="test27">23</label>
            </p><br>

            <input name="hidsoal7" type="hidden" value="<br>7. A, B, D, G, K, ..., ...<br> Jawab : ">A, B, D, G, K, ..., ...<br>
            <p>
              <input name="answer7" type="radio" id="test28" value="A. P dan V" />
              <label for="test28">P dan V</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test29" value="B. P dan W" />
              <label for="test29">P dan W</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test30" value="C. O dan U" />
              <label for="test30">O dan U</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test31" value="D. O dan V" />
              <label for="test31">O dan V</label>
            </p>
            <p>
              <input name="answer7" type="radio" id="test32" value="E. P dan U" />
              <label for="test32">P dan U</label>
            </p>
            <input type="hidden" name="break2" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp2" id="timestamp2" type="hidden"/>
        </div>


        <div id="soal3" class="soal row" style="page-break-before: always;">
            <input name="line3" type="hidden" value="<hr>">
            <input name="blok3" type="hidden" value="<h2> Blok 3 </h2>">
            <input name="hidsoal8" type="hidden" value="8. Siswa yang tidak suka bermain, akan lulus dengan nilai baik. Ana lulus dengan nilai baik. Jadi :<br> Jawab : ">Siswa yang tidak suka bermain, akan lulus dengan nilai baik. Ana lulus dengan nilai baik. Jadi :<br>
            <p>
              <input name="answer8" type="radio" id="test33" value="A. Ana adalah siswa yang tidak suka bermain" />
              <label for="test33">a. Ana adalah siswa yang tidak suka bermain.</label>
            </p>
            <p>
              <input name="answer8" type="radio" id="test34" value="B. Semua siswa yang lulus dengan baik tidak suka bermain" />
              <label for="test34">b. Semua siswa yang lulus dengan baik tidak suka bermain.</label>
            </p>
            <p>
              <input name="answer8" type="radio" id="test35" value="C. Tidak ada hubungan antara kelulusan dengan frekuensi bermain." />
              <label for="test35">c. Tidak ada hubungan antara kelulusan dengan frekuensi bermain.</label>
            </p>
            <p>
              <input name="answer8" type="radio" id="test36" value="D. Hanya Ana yang lulus dengan nilai baik" />
              <label for="test36">d. Hanya Ana yang lulus dengan nilai baik.</label>
            </p><br>

            <input name="hidsoal9" type="hidden" value="<br>9. Orang dapat mempunyai wajah berbentuk hampir persegi, oval, atau bulat. Demikian juga orang dapat memiliki badan yang tegap, kurus kering, atau gemuk. Rambut orang dapat keriting, lurus, atau berombak. Seorang ahli kriminologi menyelidiki para penjahat disebuah penjara dan ternyata semua penjahat tersebut berwajah persegi. Sebagian besar dari mereka berambut keriting dan sebagian kecil bertubuh kurus, Jadi...<br> Jawab : ">Orang dapat mempunyai wajah berbentuk hampir persegi, oval, atau bulat. Demikian juga orang dapat memiliki badan yang tegap, kurus kering, atau gemuk. Rambut orang dapat keriting, lurus, atau berombak. Seorang ahli kriminologi menyelidiki para penjahat disebuah penjara dan ternyata semua penjahat tersebut berwajah persegi. Sebagian besar dari mereka berambut keriting dan sebagian kecil bertubuh kurus, Jadi...<br>
            <p>
              <input name="answer9" type="radio" id="test37" value="A. Semua penjahat berambut keriting" />
              <label for="test37">a. Semua penjahat berambut keriting</label>
            </p>
            <p>
              <input name="answer9" type="radio" id="test38" value="B. enjahat dapat berambut berombak, bertubuh tegap, dan berwajah persegi" />
              <label for="test38">b. Penjahat dapat berambut berombak, bertubuh tegap, dan berwajah persegi</label>
            </p>
            <p>
              <input name="answer9" type="radio" id="test39" value="C. Semua penjahat berwajah hampir persegi" />
              <label for="test39">c. Semua penjahat berwajah hampir persegi</label>
            </p>
            <p>
              <input name="answer9" type="radio" id="test40" value="D. Sedikit sekali penjahat yang bertubuh tegap" />
              <label for="test40">d. Sedikit sekali penjahat yang bertubuh tegap</label>
            </p><br>

            <input name="hidsoal10" type="hidden" value="<br>10. Tidak semua sarjana sastra menguasai Bahasa Prancis. Tidak semua sarjana sastra Prancis lancar berbicara bahasa Prancis. Semua sarjana sastra Indonesia lancar berbicara Bahasa Indonesia. Sunaryati adalah sarjana sastra Jerman. Jadi :<br> Jawab : ">Tidak semua sarjana sastra menguasai Bahasa Prancis. Tidak semua sarjana sastra Prancis lancar berbicara bahasa Prancis. Semua sarjana sastra Indonesia lancar berbicara Bahasa Indonesia. Sunaryati adalah sarjana sastra Jerman. Jadi :<br>
            <p>
              <input name="answer10" type="radio" id="test41" value="A. Sunaryati lancar berbicara bahasa Jerman" />
              <label for="test41">a. Sunaryati lancar berbicara bahasa Jerman</label>
            </p>
            <p>
              <input name="answer10" type="radio" id="test42" value="B. Sunaryati mungkin tidak lancar berbicara bahasa Perancis" />
              <label for="test42">b. Sunaryati mungkin tidak lancar berbicara bahasa Perancis.</label>
            </p>
            <p>
              <input name="answer10" type="radio" id="test43" value="C. Sunaryati tidak mungkin lancar berbicara bahasa Jerman" />
              <label for="test43">c. Sunaryati tidak mungkin lancar berbicara bahasa Jerman.</label>
            </p>
            <p>
              <input name="answer10" type="radio" id="test44" value="D. Sunaryati mungkin lancar berbicara bahasa Jerman" />
              <label for="test44">d. Sunaryati mungkin lancar berbicara bahasa Jerman.</label>
            </p><br>

            <input name="hidsoal11" type="hidden" value="<br>11. Bila semua pelajar bercelana panjang; Sebagian pelajar memakai lengan panjang, jadi :<br> Jawab : ">Bila semua pelajar bercelana panjang; Sebagian pelajar memakai lengan panjang, jadi :<br>
            <p>
              <input name="answer11" type="radio" id="test45" value="A. Sebagian pelajar bercelana pendek" />
              <label for="test45">a. Sebagian pelajar bercelana pendek.</label>
            </p>
            <p>
              <input name="answer11" type="radio" id="test46" value="B. Sebagian pelajar memakai celana pendek dan berlengan panjang" />
              <label for="test46">b. Sebagian pelajar memakai celana pendek dan berlengan panjang.</label>
            </p>
            <p>
              <input name="answer11" type="radio" id="test47" value="C. Sebagian pelajar memakai celana panjang dan berlengan panjang" />
              <label for="test47">c. Sebagian pelajar memakai celana panjang dan berlengan panjang.</label>
            </p>
            <p>
              <input name="answer11" type="radio" id="test48" value="D. Sebagian pelajar bercelana pendek tapi tidak memakai celana panjang" />
              <label for="test48">d. Sebagian pelajar bercelana pendek tapi tidak memakai celana panjang.</label>
            </p><br>

            <input name="hidsoal12" type="hidden" value="<br>12. Semua lukisan yang bernilai seni yang tinggi berpedoman pada hukum-hukum perspektif. Kebanyakan lukisan Tiongkok dan Jepang tidak memperhatikan hukum ini. Jadi dapat disimpulkan:<br> Jawab : ">Semua lukisan yang bernilai seni yang tinggi berpedoman pada hukum-hukum perspektif. Kebanyakan lukisan Tiongkok dan Jepang tidak memperhatikan hukum ini. Jadi dapat disimpulkan:<br>
            <p>
              <input name="answer12" type="radio" id="test49" value="A. Lukisan Jepang dan Tiongkok tidak ada yang bernilai seni tinggi" />
              <label for="test49">a. Lukisan Jepang dan Tiongkok tidak ada yang bernilai seni tinggi.</label>
            </p>
            <p>
              <input name="answer12" type="radio" id="test50" value="B. Lukisan Tiongkok dan Jepang belum tentu tidak bernilai seni yang tinggi" />
              <label for="test50">b. Lukisan Tiongkok dan Jepang belum tentu tidak bernilai seni yang tinggi.</label>
            </p>
            <p>
              <input name="answer12" type="radio" id="test51" value="C. Kebanyakan lukisan Tiongkok dan Jepang mempunyai nilai seni yang tinggi" />
              <label for="test51">c. Kebanyakan lukisan Tiongkok dan Jepang mempunyai nilai seni yang tinggi.</label>
            </p>
            <p>
              <input name="answer12" type="radio" id="test52" value="D. Jawaban a, b, dan c ketiga-tiganya salah" />
              <label for="test52">d. Jawaban a, b, dan c ketiga-tiganya salah.</label>
            </p>
            <input type="hidden" name="break3" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp3" id="timestamp3" type="hidden"/>
        </div>


        <div id="soal4" class="soal row" style="page-break-before: always;">
        <input name="line4" type="hidden" value="<hr>">
        <input name="blok4" type="hidden" value="<h2> Blok 4 </h2>">
        <h1>Psikologi</h1>
            <input name="hidsoal13" type="hidden" value="13. Berapa kali angka 7 muncul di antara bilangan 1 sampai 100?<br> Jawab : ">
            Berapa kali angka 7 muncul di antara bilangan 1 sampai 100?<br>
            <div class="input-field col s12">
                <textarea name="array1" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal14" type="hidden" value="<br>14. Ada dua kakak beradik yang jumlah umurnya 11 tahun. Yang satu 10 tahun lebih tua dari yang lain. Berapakah umur mereka masing-masing?<br> Jawab : ">
            Ada dua kakak beradik yang jumlah umurnya 11 tahun. Yang satu 10 tahun lebih tua dari yang lain. Berapakah umur mereka masing-masing?<br>
            <div class="input-field col s12">
                <textarea name="array2" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal15" type="hidden" value=" <br>15. Sepasang suami istri punya 4 anak perempuan & setiap anak perempuan mempunyai 1 orang saudara laki laki, berapa anggota keluarga itu? <br> Jawab : ">
            Sepasang suami istri punya 4 anak perempuan & setiap anak perempuan mempunyai 1 orang saudara laki laki, berapa anggota keluarga itu?<br>
            <div class="input-field col s12">
                <textarea name="array3" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal16" type="hidden" value=" <br>16. Bagaimana membagi satu buah kue tart menjadi 8 potong hanya dengan 3 kali memotong? <br> Jawab : ">
            Bagaimana membagi satu buah kue tart menjadi 8 potong hanya dengan 3 kali memotong?<br>
            <div class="input-field col s12">
                <textarea name="array4" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal17" type="hidden" value=" <br>5. Mana yang lebih besar, 18 persen dari 81 atau 81 persen dari 18? <br> Jawab : ">
            Mana yang lebih besar, 18 persen dari 81 atau 81 persen dari 18?<br>
            <div class="input-field col s12">
                <textarea name="array5" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal18" type="hidden" value=" <br>17. Buatlah algoritma untuk menghitung luas lingkaran! <br> Jawab : ">
            Buatlah algoritma untuk menghitung luas lingkaran!<br>
            <div class="input-field col s12">
                <textarea name="array6" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal19" type="hidden" value=" <br>18. Buatlah algoritma untuk menentukan bahwa bilangan yang diinputkan adalah bilangan genap atau ganjil <br> Jawab : ">
            Buatlah algoritman untuk menentukan bahwa bilangan yang diinputkan adalah bilangan genap atau ganjil<br>
            <div class="input-field col s12">
                <textarea name="array7" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>
            <input type="hidden" name="break4" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp4" id="timestamp4" type="hidden"/>
        </div>


        <div id ="soal5" class="soal row" style="page-break-before: always;">
            <h1>Analogi</h1>
            <input name="line5" type="hidden" value="<hr>">
            <input name="blok5" type="hidden" value="<h2> Blok 5 </h2>">
            <input name="hidsoal20" type="hidden" value=" 19. Berikan penjelasan untuk flowchart perulangan dibawah ini <br> Jawab : ">
            Berikan penjelasan untuk flowchart perulangan dibawah ini
            <div class="input-field col s12">
                <textarea name="array8" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>
            <img src="img/flow.png">
            <input type="hidden" name="break5" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp5" id="timestamp5" type="hidden"/>
        </div>


        <div id="soal6" class="soal row" style="page-break-before: always;">
            <h1>Analisa</h1>
            <input name="line6" type="hidden" value="<hr>">
            <input name="blok6" type="hidden" value="<h2> Blok 6 </h2>">
            <span style="font-size: 13px;text-indent: 10px;">Untuk soal kedua soal dibawah:</span><br>
            <span style="font-size: 13px;text-indent: 50px;">Saya ingin membuat aplikasi jual beli sederhana pada mini market yang terdiri dari : Form Login, Form Kasir, Form Penjualan, Dan Form laporan penjualan yang akan dibuat</span><br><br>

            <input name="hidsoal21" type="hidden" value="20. entukan fasilitas yang dibutuhkan dari analisa diatas <br> Jawab : ">
            Tentukan fasilitas yang dibutuhkan dari analisa diatas<br>
            <div class="input-field col s12">
                <textarea name="array9" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal22" type="hidden" value=" <br>21. Buatlah rancangan menunya <br> Jawab : ">
            Buatlah rancangan menunya<br>
            <div class="input-field col s12">
                <textarea name="array10" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>
            <input type="hidden" name="break6" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp6" id="timestamp6" type="hidden"/>
        </div>

        <div id="soal7" class="soal row" style="page-break-before: always;">
            <input name="line7" type="hidden" value="<hr>">
            <input name="blok7" type="hidden" value="<h2> Blok 7 </h2>">
            <h2>Please answer all of the questions below in English</h2><br>
            <span style="font-size: 13px;">
                Dilarang menggunakan translator, kamus, mesin, ataupun alat penerjemah lainnya. Cukup gunakan skill Bahasa Inggris yang sudah anda miliki seadanya. We'll try to understand whatever you typed down, in shaa Allah
            </span><br>
            <span style="font-size: 13px;">
                Jawaban dalam Bahasa Indonesia tidak akan dinilai kecuali pilihan ganda yang terakhir. No offense ya.
            </span></h1>

            <input name="hidsoal23" type="hidden" value=" 22. Siapa dan apa yang memotivasi anda menjadi seorang developer?<br> Jawab : ">
            Siapa dan apa yang memotivasi anda menjadi seorang developer?</h1><br>
            <div class="input-field col s12">
                <textarea name="array11" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal24" type="hidden" value=" <br>23. Sebutkan modal yang anda miliki untuk menjadi seorang developer <br> Jawab : ">
            Sebutkan modal yang anda miliki untuk menjadi seorang developer</h1><br>
            <div class="input-field col s12">
                <textarea name="array12" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal25" type="hidden" value=" <br>24. Berikan beberapa tindakan yang telah anda lakukan agar anda bisa menjadi seorang developer <br> Jawab : ">
            Berikan beberapa tindakan yang telah anda lakukan agar anda bisa menjadi seorang developer</h1><br>
            <div class="input-field col s12">
                <textarea name="array13" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal26" type="hidden" value=" <br>25. Apa yang anda ketahui tentang bahasa pemrograman? Beri penjelasan dan contoh bahasa pemrograman yang anda ketahui <br> Jawab : ">
            Apa yang anda ketahui tentang bahasa pemrograman? Beri penjelasan dan contoh bahasa pemrograman yang anda ketahui</h1><br>
            <div class="input-field col s12">
                <textarea name="array14" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal27" type="hidden" value=" <br>26. Apa tujuan dan harapan anda ingin mengikuti Madani IT School ini? <br> Jawab : ">
            Apa tujuan dan harapan anda ingin mengikuti Madani IT School ini?</h1><br>
            <div class="input-field col s12">
                <textarea name="array15" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal28" type="hidden" value=" <br>27. The score of your last TOEFL tes you took was ">
            (Please be honest) The score of your last TOEFL tes you took was...</h1><br>
            <span style="font-size: 13px;">Approximate is fine, if you forgot. Type 0 if you've never had one.</span></h1><br>
            <div class="input-field col s12">
                <textarea name="array16" id="textarea1" class="materialize-textarea" placeholder="Jawaban Anda"></textarea>
            </div>

            <input name="hidsoal29" type="hidden" value=" <br>28. Anda yakin sudah menjawab dalam Bahasa Inggris seluruh soal diatas, dengan mengikuti prosedur yang tertera di bagian atas halaman ini? <br> Jawab : ">
            Anda yakin sudah menjawab dalam Bahasa Inggris seluruh soal diatas, dengan mengikuti prosedur yang tertera di bagian atas halaman ini?
            <p>
              <input name="answer13" type="radio" id="test53" value="A. Ya, Saya sudah menelitinya kembali" />
              <label for="test53">A. Ya, Saya sudah menelitinya kembali</label>
            </p>
            <p>
              <input name="answer13" type="radio" id="test54" value="B. Nope, It's just too difficult" />
              <label for="test54">B. Nope, It's just too difficult</label>
            </p>
            <p>
              <input name="answer13" type="radio" id="test55" value="C. Other : " />
              <label for="test55">C. Other : </label>
              <input name="otherreason" type="text" placeholder="Sebutkan disini jika tidak yakin kesemuanya dan centang Other">
            </p>
            <p>

            </p>

            <input name="hidsoal30" type="hidden" value=" <br>29. Tandai perangkat mana saja yang akan anda bawa saat mengikuti pelatihan di Madani IT School apabila diterima, untuk mendukung belajar anda <br> <ul> ">
            Tandai perangkat mana saja yang akan anda bawa saat mengikuti pelatihan di Madani IT School apabila diterima, untuk mendukung belajar anda<br>
            <p>
              <input name="iD1" type="checkbox" id="test57" value=" <li> iPhone dengan iOS8 keatas<br> " />
              <label for="test57"> iPhone dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD2" type="checkbox" id="test58" value=" <li> iPad dengan iOS8 keatas<br> "/>
              <label for="test58"> iPad dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD3" type="checkbox" id="test59" value=" <li> iPod dengan iOS8 keatas<br> "/>
              <label for="test59"> iPod dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD4" type="checkbox" id="test60" value=" <li> iWatch dengan iOS8 keatas<br> "/>
              <label for="test60"> iWatch dengan iOS8 keatas </label>
            </p>
            <p>
              <input name="iD5" type="checkbox" id="test61" value=" <li> Macbook dengan minimum OSX El Capitan<br> "/>
              <label for="test61"> Macbook dengan minimum OSX El Capitan </label>
            </p>
            <p>
              <input name="iD6" type="checkbox" id="test62" value=" <li> iMac lengkap, dengan minimum OSX El Capitan<br> "/>
              <label for="test62"> iMac lengkap, dengan minimum OSX El Capitan </label>
            </p>
            <p>
              <input name="iD7" type="checkbox" id="test63" value=" <li> Mac mini dengan minimum OSX El Capitan<br> "/>
              <label for="test63"> Mac mini dengan minimum OSX El Capitan </label>
            </p>
            <p>
              <input name="iD8" type="checkbox" id="test64" value=" <li> Device lainnya yang sudah mendukung operasional XCode7+ atau iOS8+<br> "/>
              <label for="test64"> Device lainnya yang sudah mendukung operasional XCode7+ atau iOS8+ </label>
            </p>
            <p>
              <input name="iD9" type="checkbox" id="test65" value=" Other :  "/>
              <label for="test65"> Other: </label>
              <input name="otherdevice" type="text" placeholder="Sebutkan disini jika tidak membawa kesemuanya dan centang Other, kosongi jika anda membawa dari list diatas">
              <input name="ul" type="hidden" value="</ul>">
            </p>
            <input name="hidsoal31" type="hidden" value=" <br>30. Apabila anda dinyatakan lulus, anda dapat dihubungi melalui <br> <ul> ">
            Apabila anda dinyatakan lulus, anda dapat dihubungi melalui<br>
            <p>
              <input name="iD10" type="checkbox" id="test66" value=" <li> EMail<br> "/>
              <label for="test66"> A. EMail </label>
            </p>
            <p>
              <input name="iD11" type="checkbox" id="test67" value=" <li> iMessage<br> "/>
              <label for="test67"> B. iMessage </label>
            </p>
            <p>
              <input name="iD12" type="checkbox" id="test68" value=" <li> Telepon Langsung<br> "/>
              <label for="test68"> C. Telepon Langsung </label>
            </p>
            <p>
              <input name="iD13" type="checkbox" id="test69" value=" <li> SMS<br> "/>
              <label for="test69"> D. SMS </label>
            </p>
            <p>
              <input name="iD14" type="checkbox" id="test70" value=" Other :  "/>
              <label for="test70"> Other: </label>
              <input name="otherreason1" type="text" placeholder="Sebutkan disini jika tidak bisa kesemuanya dan centang Other">
              <input name="ul" type="hidden" value="</ul>">
            </p>
            <input type="hidden" name="break7" value="<br> Waktu Mengerjakan : ">
            <input name="timestamp7" id="timestamp7" type="hidden"/>
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
    <div style="display: none;" id="time">
        <span id="sw_h">00</span>:
        <span id="sw_m">00</span>:
        <span id="sw_s">00</span>:
        <span id="sw_ms">00</span>
    </div>
</div>



=======
      document.getElementById('form').submit();;
    } else {
      $this.html(event.strftime('To end: <span>%H:%M:%S</span>'));
   }
 });

</script>

<div class="row">
    <form method="POST" id="form" class="col s12" action="pdf">
	    <span class="question[]">1. Apa istilah lain tahu bulat?</span>
	    <div class="row">
		    <p>
		      <input name="answer1" type="radio" id="test1" value="A" />
		      <label for="test1">A. Tahu Bundar</label>
		    </p>
		    <p>
		      <input name="answer1" type="radio" id="test2" value="B" />
		      <label for="test2">B. Tahu Lingkaran</label>
		    </p>
		    <p>
		      <input name="answer1" type="radio" id="test3" value="C" />
		      <label for="test3">C. Circle Tofu</label>
		    </p>
		    <p>
		      <input name="answer1" type="radio" id="test4" value="D" />
		      <label for="test4">D. Tahu Bola</label>
		    </p>
	    </div>

	    <span class="question[]">2. Berapa skor Tahu Bulatmu?</span>
	    <div class="row">
		    <p>
		      <input name="answer2" type="radio" id="test5" value="A" />
		      <label for="test5">A. 900jt</label>
		    </p>
		    <p>
		      <input name="answer2" type="radio" id="test6" value="B" />
		      <label for="test6">B. Lupa</label>
		    </p>
		    <p>
		      <input name="answer2" type="radio" id="test7" value="C" />
		      <label for="test7">C. Ga Main</label>
		    </p>
		    <p>
		      <input name="answer2" type="radio" id="test8" value="D" />
		      <label for="test8">D. Main Cheat Gw</label>
		    </p>
	    </div>

	    2. Tulis logaritma penggorengan tahu bulat!<br>
    	<div class="row">
        	<div class="input-field col s12">
        		<textarea name="array" id="textarea1" class="materialize-textarea"></textarea>
        		<label for="textarea1">Textarea</label>
        	</div>
    	</div>
    	<button class="btn waves-effect" type="submit">Submit
			<i class="material-icons right">send</i>
		</button>
    </form>
</div>
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
@endsection

@section('js')

@endsection