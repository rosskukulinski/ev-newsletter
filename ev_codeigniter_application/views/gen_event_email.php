<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EV Upcoming Events</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	</style>
</head>
<body>

<?php

$tz = new DateTimeZone('Pacific/Honolulu');
date_default_timezone_set('Pacific/Honolulu');

 ?>

<div id="container">
<p>
	Please review your event information in the auto-generated EV Newsletter email below.<br>
	If you have made a mistake, you will need to fix it in Quickbase and on the Google Calendar.
</p
</div>

<div id="container">

<p>
UPCOMING EVENTS (EV-WIDE):<br>
<?php
	foreach($events as $event)
	{
		$edate = (int) substr($event[1],0,-3);
		echo gmdate('m/d', $edate);
		echo ': ';
		echo $event[0];
		echo '<br>';
	}

?>
</p>

<p>
************************************<br>
UPCOMING EVENTS (EV):
</p>
	<?php
	foreach($events as $event)
	{
	?>
		<p>
		-------------------------------------------
		<br>
		<?php if ($event[0]) { ?> 
		<?php echo $event[0]; // Event Name ?>
		<br>
		
		<?php } if ($event[1]) { ?>
		Date: <?php 
			$edate = (int) substr($event[1],0,-3);
			echo gmdate('l, F jS', $edate);
		 ?>
		<br>
		
		<?php } if ($event[2]) { ?>
		Time: <?php 
		
		$timestamp = (int) substr($event[2],0,-3);
		echo gmdate('g:i A', $timestamp);
		
		if (!$event[3])
			echo '<br>';
		?>
		
		<?php } if ($event[3]) { ?>
		<?php 
		
		$timestamp = (int) substr($event[3],0,-3);
		echo '- '.gmdate('g:i A', $timestamp);
		
		?>	
		<br>
		
		<?php } if ($event[4]) { ?>
		Location: <?php echo $event[4]; ?>
		<br>
		
		<?php } if ($event[5]) { ?>
		Meetup Time: <?php 

			$timestamp = (int) substr($event[5],0,-3);
			echo gmdate('g:i A', $timestamp);
		 ?>
		<br>
		
		<?php } if ($event[6]) { ?>
		Meetup Location:
		<?php echo $event[6]; ?>
		<br>
		
		<?php } if ($event[7]) { ?>
		Cost:
		<?php echo $event[7]; ?>
		<br>
		
		<?php } if ($event[8]) { ?>
		Sign up here:
		<?php echo $event[8]; ?>	
		
		<br>
		
		<?php 
		}
		
		if ($event[9] or $event[10]) 
		{
			echo 'Sign up by: ';
		}
		
		if ($event[9])
		{
			$etime = (int) substr($event[9],0,-3);
			echo gmdate('g:i A', $etime).' on ';
		}
		
		if ($event[10])
		{
			$edate = (int) substr($event[10],0,-3);
			echo gmdate('l, F j', $edate); 
			echo '<br>';
		} if ($event[11]) { ?>
		<?php echo '<br>';
		echo $event[11]; ?>
		<br><br>
		
		
		<?php } if ($event[12]) { ?>
		CA Contact:
		<?php echo $event[12]; ?>
		
		<?php } if ($event[13]) { ?>
		 (<?php echo $event[13]; ?>)
		
		
		<?php } if ($event[14]) { ?>
		<br>
		Sponsored by the EV 
		<?php 
		
		$comm = substr(strstr($event[14],('-')), 1);
		switch ($comm) {
			case 'Education/Cultural':
				$comm = 'Education & Cultural';
				break;
			case 'Health':
				$comm = 'Health & Wellness';
				break;
			case 'Sports/Outdoors':
				$comm = 'Sports & Outdoors';
				break;
		}
		echo $comm;
		
		?>
		Committee.
	<?php } ?>		

	</p>
	<br>
	<?php
	}
	?>
			

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>