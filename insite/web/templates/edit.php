<?php
	function isSelected($value, $default){
		$result = NULL;	
			
		if($value == $default){
			$result = 'selected';
		}
		
		return $result;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>inSite Admin Management - <?php echo $this->data['page_title']; ?></title>
	<link rel="stylesheet" href="../templates/css/style.css" type="text/css" media="all" />
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="../"><img src="../templates/logo.png" id="logo" />inSITe</a></h1>
			<div id="top-navigation">
				Welcome <a href="#"><strong>Administrator</strong></a>
				<span>|</span>
				<a href="#">Help</a>
				<span>|</span>
				<a href="#">Profile Settings</a>
				<span>|</span>
				<a href="#">Log out</a>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="../" class="active"><span>Dashboard</span></a></li>
			    <li><a href="#"><span>New Issue</span></a></li>
			    <li><a href="#"><span>User Management</span></a></li>
			    <li><a href="#"><span>About</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
			<a href="../">Dashboard</a>
			<span>&gt;</span>
			Issue List
		</div>
		<!-- End Small Nav -->
		
		<!-- Message Error -->
		<?php
		if($this->data['msg'] != NULL){
		?>
			<div class="msg msg-error">
			<p><strong><?php echo $this->data['msg']; ?></strong></p>
		</div>
		<?php
		}
		?>
		<!-- End Message Error -->
		
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Update Issue</h2>
					</div>
					<!-- End Box Head -->
					
					<form action="../issue/<?php echo $this->data['data']['id']; ?>" method="post">
						
						<!-- Form -->
						<div class="form">
								<p>
									<label>Issue Title</label>
									<input type="text" class="field size1" disabled value="<?php echo $this->data['data']['issue_name']; ?>" />
								</p>	
								<p class="inline-field">
									<label>Date/Time Reported</label>
									<input type="text" class="field size1" disabled value="<?php echo $this->data['data']['date_time']; ?>" />
								</p>
								<p>
									<label>Location</label>
									<input type="text" class="field size1" disabled value="<?php echo $this->data['data']['full_location']; ?>" />
								</p>
								<p>
									<label>Description</label>
									<?php echo $this->data['data']['image_display']; ?>
									<textarea class="field size1" rows="10" cols="30" disabled><?php echo $this->data['data']['description']; ?></textarea>
								</p>
								<p>
									<label>Urgency Level</label>
									<select class="field size3" disabled>
										<option value="" <?php echo isSelected($this->data['data']['urgency_level'], 'Very low'); ?>>Very low</option>
										<option value="" <?php echo isSelected($this->data['data']['urgency_level'], 'Low'); ?>>Low</option>
										<option value="" <?php echo isSelected($this->data['data']['urgency_level'], 'Normal'); ?>>Normal</option>
										<option value="" <?php echo isSelected($this->data['data']['urgency_level'], 'High'); ?>>High</option>
										<option value="" <?php echo isSelected($this->data['data']['urgency_level'], 'Very high'); ?>>Very high</option>
									</select>
								</p>
								<p>
									<label>Reported by</label>
									<input type="text" class="field size1" disabled value="<?php echo $this->data['data']['reporter_name']; ?>" />
								</p>
								<p>
									<label>Email</label>
									<input type="text" class="field size1" disabled value="<?php echo $this->data['data']['email']; ?>" />
								</p>
								<p>
									<label>Contact</label>
									<input type="text" class="field size1" disabled value="<?php echo $this->data['data']['contact']; ?>" />
								</p>
								<p>
									<label>Status</label>
									<select name="status" class="field size4">
										<option value="Pending" <?php echo isSelected($this->data['data']['status'], NULL); ?>>Pending</option>
										<option value="In progress" <?php echo isSelected($this->data['data']['status'], 'In progress'); ?>>In progress</option>
										<option value="Resolved" <?php echo isSelected($this->data['data']['status'], 'Resolved'); ?>>Resolved</option>
									</select>
								</p>
								<p>
									<label>Status Comment</label>
									<textarea name="status_comment" class="field size1" rows="10" cols="30"><?php echo $this->data['data']['status_comment']; ?></textarea>
								</p>	
							
						</div>
						<!-- End Form -->
						
						<!-- Form Buttons -->
						<div class="buttons">
							<input type="submit" class="button" value="submit">
						</div>
						<!-- End Form Buttons -->
					</form>
				</div>

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			<div id="sidebar">
				
			</div>
			<!-- End Sidebar -->
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; 2015 - inSITe</span>
		<span class="right">
			Singapore Institute of Technology
		</span>
	</div>
</div>
<!-- End Footer -->
	
</body>
</html>