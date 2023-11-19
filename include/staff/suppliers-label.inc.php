<?php
if(!defined('OSTSCPINC') || !$thisstaff ) die('Access Denied');
?>


<html>
<body onload="window.resizeTo(450,400)">
<table style="font-family:arial; " >

	<tr>		
		<td><h2><b>TO:</b></h2></td>
	</tr>
	
	<tr>
		<td><?php echo $info['company']?></td>
	</tr>
	<tr>
		<td><?php echo $info['name']?></td>
	</tr>
	<tr>
		<td><?php echo $info['address']?></td>
	</tr>
	<tr>
		<td><?php echo $info['suburb']." ".$info['state']." ".$info['postcode']?></td>
	</tr>
</table>



<hr/>

<table style="font-family:arial; font-size:13px;" align="right" >

	<tr>		
		<td><p><b>FROM:</b></p></td>
	</tr>
	<tr>		
		<td><img src="../scp/images/ost-logo.png" height="50" width="120"></td>
	</tr>
	<tr>
		<td>Integra Corporation Pty Ltd</td>
	</tr>
	<tr>
		<td>133 Leichhard Street</td>
	</tr>
	<tr>
		<td>Brisbane QLD 4000</td>
	</tr>
	<tr>
		<td>T 07 3339 9333</td>
	</tr>
</table>
</body>
</html>
