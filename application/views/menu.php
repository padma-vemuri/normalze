<div id ="welcome">
	<?php
		if(isset($this->session->userdata['username'])){
			echo "<img src=\"/test/normalize/assets/images/user.png\"/>".$this->session->userdata['username']."";
		}
     ?>
</div>

<div name ="menu" id ="menu">
	<ul class ="menuicon" style="display: inline-block;">
		<a class="menu" href="/<?php echo "test/normalize/index.php/home"?>">
		<li> <img src="<?php echo base_url();?>/assets/images/home.png" /></li>
		<li>Home</li>
		</a>
	</ul>
	
	<ul class ="menuicon" style="display: inline-block;">
		<a class="menu" href="/<?php echo "test/normalize/index.php/home/emails"?>">
			<li> <img src="<?php echo base_url();?>/assets/images/mail.png" /></li>
			<li>Email</li>
		</a>
	</ul>
	
	<ul class ="menuicon" style="display: inline-block;">
			<a class="menu" href="/<?php echo "test/normalize/index.php/home/update"?>">
				<li> <img src="<?php echo base_url();?>/assets/images/create.png" /></li>
				<li>Issues</li>
			</a>
	</ul>
	<ul class ="menuicon" style="display: inline-block;">
			<a class="menu"href="/<?php echo "test/normalize/index.php/home/statusreports"?>">
				<li align ="center"> <img src="<?php echo base_url();?>/assets/images/repot.png" /></li>
				<li>Status Report</li>
			</a>
	</ul>
	<ul class ="menuicon" style="display: inline-block;">
			<a class="menu"href="/<?php echo "test/normalize/index.php/home/releaseprojects"?>">
				<li> <img src="<?php echo base_url();?>/assets/images/list.png" /></li>
				<li>Projects </li>
			</a>
	</ul>
	<ul class ="menuicon" style="display: inline-block;">
			<a class="menu" href="/<?php echo "test/normalize/index.php/home/charts"?>">
				<li> <img src="<?php echo base_url();?>/assets/images/charts.png" /></li>
				<li>Charts</li>
			</a>
	</ul>
</div>

<div class="logout">
	<input type='button' id="button" value="Logout" onClick="javascript:location.href = '/test/normalize/index.php/home/logout';" />
</div>