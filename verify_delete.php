<?php
$text=$_REQUEST['text'];


echo "<div class='overlay_form'>
			<h3>Do you want to delete $text Database?</h3>
			<p>Please proof that you are authorized to do so.</p>
			
				
				<div align='center'>
					<input type='password' id='password' name='$text' autofocus placeholder='enter password' class='form-control ' required>
				
				</div>
				<br><br>
				<div>
				<input type='button' value='submit' class='btn btn-success' onclick='verify_password()'>
				<input type='button' value='cancel' class='btn btn-warning'>
				</div>
			
		
</div>";


?>





		