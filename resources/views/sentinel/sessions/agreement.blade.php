
@extends('sentinel.layouts.default')
@section('content')
	<div>
	  <h3 class="left-align">Terms & Conditions</h1>
	  <p>
	  	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	  	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	  </p>

	  <script type="text/javascript">
	  		$('#userg').change(function(){
		    if($(this).is(":checked")) {
		        $('#btn-submitted').addClass("disabled");
		    }
		})
	  </script>

	  <p>
	  	<input type="checkbox" name="userg" id="userg">
	  	<label for="userg">I accept the terms & conditions</label>
	  </p>

	  <button class="btn waves-effect" onclick="location.href='soal';" type="submit" id="btn-submitted">Next
            <i class="material-icons right">send</i>
        </button>
	</div>
@endsection