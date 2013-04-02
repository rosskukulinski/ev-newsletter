<?php

// where the fuck should this go?
function generateSelect($name = '', $options = array()) {
    $html = '<select name="'.$name.'" id="'.$name.'">';
   	foreach ($options as $value) {
       	$html .= '<option value="'.$value.'">'.$value.'</option>';
    }
    $html .= '</select>';
    return $html;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to EV's CA Event Creator</title>

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

<div id="container">
	<h1>Welcome to EV's CA Event Creator!</h1>

	<h2>Items labeled with * are required</h2>
	<div id="body">
		<?php 
			echo form_open('event_create/index');
			//echo form_fieldset('Event creation Form')
		?>
		<table>
		<tr>
			<td>
				<label for"event_name">*Event Name: (e.g. EV Goes to the Movies! Casablanca)</label>
		   </td>
			<td>
				<div class="textfield">
				<?php  
				
					echo form_error('event_name');
					$data = array(
						'name'        => 'event_name',
						'id'          => 'event_name',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
				?>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>
				<label for="event_type">*Event Type:</label>
			</td>
		<td>
		<? 
			$html = generateSelect('event_type', $event_types);
			echo $html;
		?>
	  </td>
	</tr>
	

	<tr>
	  <td>
			<label for="event_cost">*Event Copay (e.g. Free! or $5)</label>
	  </td>
	  <td>
	  		<?php  
					$data = array(
						'name'        => 'event_copay',
						'id'          => 'event_copay',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
      </td>
	</tr>
	<tr>
	  <td>
			<label for="event_date">*Event Date (e.g. 9/17/2012)</label>
      </td>
      <td>
      		<?php  
					$data = array(
						'name'        => 'event_date',
						'id'          => 'event_date',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_error('event_date');
					echo form_input($data);
			?>
	  </td>
	</tr>
	<tr>
		<td>
			<label for="event_start_time">*Event Start Time (e.g. 5pm)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'event_start_time',
						'id'          => 'event_start_time',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="event_end_time">Event End Time (e.g. 7:30pm)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'event_end_time',
						'id'          => 'event_end_time',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="event_location">*Event Location (e.g. Palo Alto Theatre)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'event_location',
						'id'          => 'event_location',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="meetup_time">Meetup Time (e.g. 4:40pm)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'meetup_time',
						'id'          => 'meetup_time',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="meetup_location">Meetup Location (e.g. GCC Parking Lot)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'meetup_location',
						'id'          => 'meetup_location',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="rsvp_link">RSVP Link</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'rsvp_link',
						'id'          => 'rsvp_link',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="rsvp_link">RSVP Date (e.g. 9/10/12)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'rsvp_date',
						'id'          => 'rsvp_date',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="rsvp_time">RSVP Time (e.g. 5pm)</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'rsvp_time',
						'id'          => 'rsvp_time',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="event_description">*Event Description</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'event_description',
						'id'          => 'event_description',
						'rows'        => '10',
						'cols'        => '60'
					);
					echo form_textarea($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="sponsored_by">*Account</label>
		</td>
		<td>
			<?php  
			$html = generateSelect('sponsored_by', $sponsors);
			echo $html;
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="ca_name">*CA Name</label>
		</td>
		<td>
			<?php  
			$html = generateSelect('ca_name', $cas);
			echo $html;
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="ca_email">*CA Email</label>
		</td>
		<td>
			<?php  
					$data = array(
						'name'        => 'ca_email',
						'id'          => 'ca_email',
						'maxlength'   => '60',
						'size'        => '60'
					);
					echo form_input($data);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="treasurer">*Treasurer</label>
		</td>
		<td>
			<?php  
			$html = generateSelect('treasurer', $treasurers);
			echo $html;
			?>
		</td>
	</tr>
	<tr>
	<td>

		<tr>
		<td>
		<?php
			echo form_submit('create_event', 'Create Event!');
		?>
		</td>
		</tr>
	</table>
		<?php
			echo form_close();
		?>
		
		
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>