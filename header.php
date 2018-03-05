<html dir="rtl">

<head>
	<title> <?php echo $title; ?> </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Abdulmalik Ben Ali">
	<link rel="stylesheet" href="<?php echo $PATH; ?>css/styles.css" type="text/css" />
	<?php
	if($name_page == "show")
	{ ?>
	<link href='<?php echo $PATH; ?>js/fullcalendar-3.1.0/fullcalendar.min.css' rel='stylesheet' />
	<link href='<?php echo $PATH; ?>js/fullcalendar-3.1.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
	<script src='<?php echo $PATH; ?>js/fullcalendar-3.1.0/lib/moment.min.js'></script>
	<script src='<?php echo $PATH; ?>js/fullcalendar-3.1.0/lib/jquery.min.js'></script>
	<script src='<?php echo $PATH; ?>js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
	<script src='<?php echo $PATH; ?>js/fullcalendar-3.1.0/locale-all.js'></script>
	<script>

		$(document).ready(function() {
			var initialLocaleCode = 'ar-ly';  //local time and language

			$('#calendar').fullCalendar({
				header: {
					right: 'today next,prev',
					center: 'title',
					left: 'month'
				},
				//defaultDate: '2017-1-14', //show star Date
				locale: initialLocaleCode,
				buttonIcons: false, // show the prev/next text
				weekNumbers: false,  //show the col week number
				navLinks: false, // can click day/week names to navigate views
				businessHours: false, // display business hours (show end week)
				editable: false,  // move events
				eventLimit: false, // allow "more" link when too many events
				events: {
							url: 'get-events.php', // get events in database
							type: 'POST', // Send post data
							error: function() {
								alert('There was an error while fetching events.');
							}
						}
					/*[
						{
							start:'xxxx-x-x',
							end:'xxxx-x-(x+1)',
							overlap:false,
							allDay:true,
							rendering:'background',
							color:'#ff9f00'

						},
						{
							start:'xxxx-x-x',
							end:'xxxx-x-(x+1)',
							overlap:false,
							allDay:true,
							rendering:'background',
							color:'#ff5500'

						}
					]*/
			});

		});

	</script>
		
		
	<?php
	}
	?>
</head>

<body>

	<div id="wrap">
		
		<div id="header">
		
			<div id="logo">
			
				<!--  begin sitename/logo -->
			
				<h1><a href="index.php">جامع التركي</a></h1>
				
				<!-- end sitename/logo -->
				
			</div>
		
			<div id="nav">
				<ul>
				
					<!-- begin top navigation -->
					
						
					<li <?php if($name_page == "index"){echo 'class="selected"';} ?> ><a href="<?php echo $PATH; ?>index.php" >الرئيسية</a></li>
					<li <?php if($name_page == "insert"){echo 'class="selected"';} ?> ><a href="<?php echo $PATH; ?>insert/insert.php">حجز الصالة</a></li>
					<li <?php if($name_page == "show"){echo 'class="selected"';} ?> ><a href="<?php echo $PATH; ?>show/show.php">عرض الحجوزات</a></li>
					<!--<li><a href="login.php">تسجيل الدخول</a></li>-->
					<!--<li><a href="sinup.php">التسجيل</a></li>-->
					<li <?php if($name_page == "call"){echo 'class="selected"';} ?> ><a href="<?php echo $PATH; ?>call.php">اتصل بنا</a></li>
			
					<!-- end top navigation -->
					
				</ul>
				
			</div>
			<div class="clear"></div>
		</div>