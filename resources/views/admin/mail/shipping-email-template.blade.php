<p>From: Freeworldimports</p>
<p>To: {{ $data['email'] }}</p>
<br>
<h3>Dear : {{ $data['name'] }}</h3>
<br>
<h4>{{ $data['message'] }}</h4>
<h5>Confirm Your order Please click : </h5>
<h3> <a href="https://freeworldimports.com/my-order?verification={{ $data['id'] }}&_token={{ $data['token'] }}&id={{ $data['id'] }}">Click</a> </h3>
