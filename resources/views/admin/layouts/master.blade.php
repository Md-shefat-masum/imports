@include('admin.layouts.header')

<!-- Content Wrapper. Contains page content -->
<div class="contentbar">
  @yield('content')
</div>
<div class="footerbar">
	<footer class="footer">

	  <p class="mb-0">© 2020 <a href="http://www.hsblco.com" target="_blank" style="color:red;"> || Design & Developed by : <span style="color: #ff0019;">
		  HSBLCO</span>
	  </p>

	</footer>
  </div>

@include('admin.layouts.footer')
@stack('js')
