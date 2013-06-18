<div id ="welcome">
	<?php
		if(isset($this->session->userdata['username'])){
			echo "<img src=\"/test/normalize/assets/images/user.png\"/>".$this->session->userdata['username']."";
		}
     ?>
</div>

<div name ="menu" id ="menu">
	<div class ="menuicon" style="display: inline-block;">
		
		<a class="menu" href="/<?php echo "test/normalize/index.php/home"?>">
			<div> <img src="<?php echo base_url();?>/assets/images/home.png" /></div>
			<div><pre>Home   </pre></a> </div>
	</div>

	<div class ="menuicon" style="display: inline-block;">

					
		<a class="menu" href="/<?php echo "test/normalize/index.php/home/update"?>">
			<div> <img src="<?php echo base_url();?>/assets/images/create.png" /></div>
			<div><pre>Issues  </pre></a> </div>
	</div>
	<div class ="menuicon" style="display: inline-block;">
		
		<a class="menu"href="/<?php echo "test/normalize/index.php/home/statusreports"?>">
			<div align ="center"> <img src="<?php echo base_url();?>/assets/images/repot.png" /></div>
			<div>  <pre>Status Report </pre> </a> </div>
	</div>
	
	<div class ="menuicon" style="display: inline-block;">
		
		<a class="menu"href="/<?php echo "test/normalize/index.php/home/releaseprojects"?>">
			<div> <img src="<?php echo base_url();?>/assets/images/list.png" /></div>
			<div><pre>Projects  </pre> </a> </div>
	</div>
	<div class ="menuicon" style="display: inline-block;">
		
		<a class="menu" href="/<?php echo "test/normalize/index.php/home/charts"?>">
			<div> <img src="<?php echo base_url();?>/assets/images/charts.png" /></div>
			<div><pre>Charts  </pre></a> </div>
	</div>
							
</div>

<div class="logout">
	<input type='button' id="button" value="Logout" onClick="javascript:location.href = '/test/normalize/index.php/home/logout';" />
</div>