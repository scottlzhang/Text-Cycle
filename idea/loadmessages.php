<?php	
    		echo "<table class='detail'";
				foreach($row->dialog as $msgs){
				$direction = $msgs->direction;	
				if($direction)
					$name = $fname." ".$lname;
				else
					$name = $row->partner_name;					
				echo "<tr><td class ='msgs' id='direction".$msgs->direction."'>
						<img src='silhouette.png' />
						<p id='name'>".$name."</p>
						<p id='msg_body'>".$msgs->body."</p>
			
				  		<p id='timestamp'>".$row->dialog[$msgindex]->time."</p>
						</td></tr>";
					$msgindex++;
				}
			echo"<tr><td>
					<textarea rows='5' cols='110' name='message' id='reply".$counter."' 
					 placeholder='Enter message'></textarea>
					 <input type='button' name='reply' id='reply_button' value='reply'
					 onClick='replymsg(".$row->isbn.",".$row->partner.",".$counter.")'/>
					 
				 </td></tr>";
			echo "</table></div>";
		$counter++;
?>