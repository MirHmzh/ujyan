@extends('sentinel.layouts.default')

@section('content')
<div id="clock"></div>
<script type="text/javascript">
var fiveSeconds = new Date().getTime() + 5000;
 $('#clock').countdown(fiveSeconds, {elapse: true})
  .on('update.countdown', function(event) {
    var $this = $(this);
    if (event.elapsed) {
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
@endsection

@section('js')

@endsection