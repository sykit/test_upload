<!DOCTYPE html>
@php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");
@endphp
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Upload Barang</title>

		<meta name="description" content="This is page-header (.page-header &gt; h1)" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/jquery-ui.min.css') !!}" />
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/bootstrap.min.css') !!}" />
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/font-awesome/4.5.0/css/font-awesome.min.css') !!}" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/prettify.min.css') !!}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/fonts.googleapis.com.css') !!}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/ace.min.css') !!}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/ace-part2.min.css" class="ace-main-stylesheet') !!}" />
		<![endif]-->
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/ace-skins.min.css') !!}" />
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/ace-rtl.min.css') !!}" />

		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/custom.css') !!}" />
		{{-- <link rel="stylesheet" href="{!! asset('sigit/dashboard/css/chosen.min.css') !!}" /> --}}
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/select2.min.css') !!}" />
		{{-- <link rel="stylesheet" href="{!! asset('sigit/dashboard/css/chosen.min.css') !!}" /> --}}

		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/bootstrap-datepicker3.min.css') !!}" />
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/bootstrap-timepicker.min.css') !!}" />
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/daterangepicker.min.css') !!}" />
		<link rel="stylesheet" href="{!! asset('sigit/dashboard/css/bootstrap-datetimepicker.min.css') !!}" />
		@yield('custom_css')

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{!! asset('sigit/dashboard/css/ace-ie.min.css') !!}" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{!! asset('sigit/dashboard/js/ace-extra.min.js') !!}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->


		<!--[if lte IE 8]>
		<script src="{!! asset('sigit/dashboard/js/html5shiv.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/respond.min.js') !!}"></script>
		<![endif]-->
		<script src="{!! asset('sigit/dashboard/js/jquery-2.1.4.min.js') !!}"></script>

		<script src="{!! asset('sigit/dashboard/js/bootstrap.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/jquery.dataTables.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/jquery.dataTables.bootstrap.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/dataTables.fixedColumns.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/dataTables.buttons.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/buttons.flash.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/buttons.html5.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/buttons.print.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/buttons.colVis.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/dataTables.checkboxes.min.js') !!}"></script>
		{{-- <script src="{!! asset('sigit/dashboard/js/dataTables.select.min.js') !!}"></script> --}}
		{{-- <script src="{!! asset('sigit/dashboard/js/chosen.jquery.min.js') !!}"></script> --}}
		<script src="{!! asset('sigit/dashboard/js/select2.min.js') !!}"></script>
		{{-- <script src="{!! asset('sigit/dashboard/js/chosen.jquery.min.js') !!}"></script> --}}

		<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
		<script src="{!! asset('sigit/dashboard/js/bootstrap-datepicker.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/bootstrap-timepicker.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/moment.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/daterangepicker.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/bootstrap-datetimepicker.min.js') !!}"></script>

		{{-- <script src="{!! asset('sigit/dashboard/js/ace-extra.min.js') !!}"></script> --}}
		<script src="{!! asset('sigit/dashboard/js/jquery-ui.min.js') !!}"></script>
		<script src="{!! asset('sigit/dashboard/js/jquery.ui.touch-punch.min.js') !!}"></script>

		<script src="{!! asset('sigit/lib/excellentexport-master/dist/excellentexport.js') !!}" src="dist/excellentexport.js"></script>


	</head>

	<body class="no-skin">
        @include('template/header_nomenu')
        <div class="main-container ace-save-state" id="main-container">
        {{-- @include('template/sidebar') --}}
        @yield('content')

        </div>
        <!-- basic scripts -->

    		<!--[if !IE]> -->
				{{-- <script src="{!! asset('sigit/dashboard/js/jquery-3.4.1.min.js') !!}"></script> --}}


    		<!-- <![endif]-->

    		<!--[if IE]>
    <script src="{!! asset('sigit/dashboard/js/jquery-1.11.3.min.js') !!}"></script>
    <![endif]-->
    		<script type="text/javascript">
    			if('ontouchstart' in document.documentElement) document.write("<script src='{!! asset('sigit/dashboard/js/jquery.mobile.custom.min.js') !!}'>"+"<"+"/script>");
    		</script>

    		<!-- page specific plugin scripts -->
    		<script src="{!! asset('sigit/dashboard/js/prettify.min.js') !!}"></script>

    		<!-- ace scripts -->
    		<script src="{!! asset('sigit/dashboard/js/ace-elements.min.js') !!}"></script>
    		<script src="{!! asset('sigit/dashboard/js/ace.min.js') !!}"></script>
			<script src="{!! asset('sigit/dashboard/js/bootbox.js') !!}"></script>
			<script src="{!! asset('sigit/dashboard/js/jquery.maskedinput.min.js') !!}"></script>
			<script src="{!! asset('sigit/lib/canvasjs-2.3.2/canvasjs.min.js') !!}"></script>
			@yield('custom_js')
			<script src="{!! asset('sigit/dashboard/js/custom.js') !!}"></script>

    		<!-- inline scripts related to this page -->
    		<script type="text/javascript">
    			jQuery(function($) {
						$.fn.dataTable.ext.errMode = 'none';

    				window.prettyPrint && prettyPrint();
    				$('#id-check-horizontal').removeAttr('checked').on('click', function(){
    					$('#dt-list-1').toggleClass('dl-horizontal').prev().html(this.checked ? '&lt;dl class="dl-horizontal"&gt;' : '&lt;dl&gt;');
    				});

						$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));


				$('#sidebar-collapse').on('click', function(event) {
					setTimeout(function(){
						$($.fn.dataTable.tables(true)).DataTable().columns.adjust();
					}, 200);
				});

					/**
					dialog.data( "uiDialog" )._title = function(title) {
						title.html( this.options.title );
					};
					**/
					$(document).ready(function() {

						$($.fn.dataTable.tables(true)).DataTable().columns.adjust();

					});

    			});



    		</script>
			@yield('custom_script')
    	</body>
    </html>
