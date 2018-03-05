<div class="sidebar-box brown-box">
	<p>هذا الموقع يقوم بتنظيم الحجوزات صالة جامع التركي</p>
</div>
<br/>
<div class="sidebar-box">
	<h4>الروابط</h4>
	<ul>

	<?php 
		if($priv==0){ ?>
		
		<li><a href="<?php echo $PATH; ?>login.php">تسجيل الدخول</a></li>
		<li><a href="<?php echo $PATH; ?>sinup.php">التسجيل</a></li>
		
		<?php } elseif($priv==1) { ?>
		
		<li><a href="<?php echo $PATH; ?>myaccount.php">حسابي </a></li>
		<li><a href="<?php echo $PATH; ?>settings/set.php">تعديل الحجوزات</a></li>
		<li><a href="<?php echo $PATH; ?>settings/set2.php">عرض الحجوزات حسب شهر</a></li>
		
		<?php } elseif($priv==2) { ?>
		
		<li><a href="<?php echo $PATH; ?>myaccount.php">حسابي </a></li>
		
		<?php } if( $priv!=0 ){ ?>
		
		<li><a href="<?php echo $PATH; ?>show/usershow.php" >حجوزاتي</a></li>
		<li><a href="<?php echo $PATH; ?>logout.php" >تسجيل الخروج</a></li>
		
		<?php }
	?>

	</ul>
</div>