@if(Session::has('AlternativeSaved'))
	<div class="alert alert-info">
		{{Session::get('AlternativeSaved')}}
	</div>
@endif

@if(Session::has('QuestionVal'))
	<div class="alert alert-danger">
		{{Session::get('QuestionVal')}}
	</div>
@endif

@if(Session::has('QuestionVal2'))
	<div class="alert alert-danger">
		{{Session::get('QuestionVal2')}}
	</div>
@endif

@if(Session::has('FieldSaved'))
	<div class="alert alert-success">
		{{Session::get('FieldSaved')}}
	</div>
@endif

@if(Session::has('CommentPosted'))
	<div class="alert alert-info">
		{{Session::get('CommentPosted')}}
	</div>
@endif

@if(Session::has('errorField'))
	<div class="alert alert-danger">
		{{Session::get('errorField')}}
	</div>
@endif

@if(Session::has('errorLab'))
	<div class="alert alert-danger">
		{{Session::get('errorLab')}}
	</div>
@endif

@if(Session::has('LabResult'))
	<div class="alert alert-danger">
		{{Session::get('LabResult')}}
	</div>
@endif

@if(Session::has('LabResult2'))
	<div class="alert alert-danger">
		{{Session::get('LabResult2')}}
	</div>
@endif

@if(Session::has('Points'))
	<div class="alert alert-info">
		{{Session::get('Points')}}
	</div>
@endif

@if(Session::has('Upgrade'))
	<div class="alert alert-info">
		{{Session::get('Upgrade')}}
	</div>
@endif

@if(Session::has('FailUpgrade'))
	<div class="alert alert-danger">
		{{Session::get('FailUpgrade')}}
	</div>
@endif

@if(Session::has('Denied'))
	<div class="alert alert-danger">
		{{Session::get('Denied')}}
	</div>
@endif

@if(Session::has('jpg'))
	<div class="alert alert-danger">
		{{Session::get('jpg')}}
	</div>
@endif