@extends('front_end.layouts.master')
@section('stylesheet')
<style>
	body{
		background: #ddd;
		color: #000;
	}
	.row-flex {
  display: flex;
  flex-wrap: wrap;
}


/* vertical spacing between columns */

/*[class*="col-"] {*/
/*  margin-bottom: 30px;*/
/*}*/

.content {
  height: 100%;
  padding: 20px 20px 10px;
  color: #000;
  background: #fff;
}
.light{
	background: #eee;
	color: #000;
}
.darker {
    border-color: #000;
    background-color: #fff;
}

.container::after {
    content: "";
    clear: both;
    display: table;
}

.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #aaa;
}

.time-left {
    float: left;
    color: #999;
}

</style>
@endsection
@section("content")
<div class="container">
	
	<div class="row">
  <div class="col-4">
    <div class="list-group active" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages <span class="badge badge-primary badge-pill">1</span></a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">My Oction <span class="badge badge-primary badge-pill">1</span></a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Post Oction</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">See All Oction <span class="badge badge-primary badge-pill">15</span></a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
      	<div class="row row-flex">
      		<div class="col-md-4 margin-m-bottom">
      			<div class="content text-center">
      				<h1>30</h1>
      				<p>Total Oction</p>
      				<p>	lskdfjsdlkfsdflkksdfjklsdflk</p>
      			</div>
      			
      		</div>
      		<div class="col-md-4 margin-m-bottom">
      			<div class="content text-center">
      				<h1>21</h1>
      				<p>Total Post</p>
      			</div>
      			
      		</div>
      		<div class="col-md-4 margin-m-bottom">
      			<div class="content text-center">
      				<h1>3</h1>
      				<p>Win Ouction</p>
      			</div>
      			
      		</div>
      	</div>
      </div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"><div class="card" style="width: 18rem;">
  <img class="card-img-top" src="{{asset('front_end/img/logo.png')}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div></div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
      	<div class="container light">
  <img src="{{asset('front_end/img/logo.png')}}" alt="Avatar" style="width:100%;">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div>

<div class="container darker">
  <img src="{{asset('front_end/img/logo.png')}}" alt="Avatar" class="right" style="width:100%;">
  <p>Hey! I'm fine. Thanks for asking!</p>
  <span class="time-left">11:01</span>
</div>

<div class="container light">
  <img src="{{asset('front_end/img/logo.png')}}" alt="Avatar" style="width:100%;">
  <p>Sweet! So, what do you wanna do today?</p>
  <span class="time-right">11:02</span>
</div>

<div class="container darker">
  <img src="{{asset('front_end/img/logo.png')}}" alt="Avatar" style="width:100%;">
  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
  <span class="time-left">11:05</span>
</div>
      </div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
    </div>
  </div>
</div>
</div>
@endsection