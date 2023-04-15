<div class="my-err <?php if(isset($_COOKIE["notice"])){ echo "myerr_act";} if(isset($_COOKIE["notice-x"])){ echo " myerr_g";} ?> ">
			<button onclick="closeNote(this)"><i class="fa fa-close"></i></button>
			<span>
			<?php
				 if(isset($_COOKIE["notice"])){
					echo $_COOKIE["notice"];
					setcookie("notice",".", time() - 86400, "/");
				 }
				 if(isset($_COOKIE["notice-x"])){
					setcookie("notice-x",".", time() - 86400, "/");
				 }
			?>
			</span>
		</div>