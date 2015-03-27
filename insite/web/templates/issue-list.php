<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>inSite Admin Management - <?php echo $this->data['page_title']; ?></title>
	<link rel="stylesheet" href="templates/css/style.css" type="text/css" media="all" />
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="index.php"><img src="templates/logo.png" id="logo" />inSITe</a></h1>
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
			    <li><a href="index.php" class="active"><span>Dashboard</span></a></li>
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
			<a href="index.php">Dashboard</a>
			<span>&gt;</span>
			Issue List
		</div>
		<!-- End Small Nav -->
		
		<!-- Message OK -->
		<?php
		if( $this->data['msg'] != NULL){
		?>
			<div class="msg msg-ok">
			<p><strong><?php echo $this->data['msg']; ?></strong></p>
		</div>
		<?php
		}
		?>
		<!-- End Message OK -->
		
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Issue List</h2>
						<div class="right">
							<label>Search</label>
							<input type="text" class="field small-field" />
							<input type="submit" class="button" value="search" />
						</div>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="13"><input type="checkbox" class="checkbox" /></th>
								<th>Title</th>
								<th>Date</th>
								<th>Reported by</th>
								<th>Urgency</th>
								<th>Status</th>
								<th width="110" class="ac">Control</th>
							</tr>
							<?php
								foreach ($this->data['data'] as $issue) {
									echo '<tr><td><input type="checkbox" class="checkbox" /></td>';
									echo '<td><h3><a href="issue/' . $issue['id'] .'">'.$issue['issue_name'].'</a></h3></td>
									<td>'.$issue['date_reported']. ' ' .$issue['time_reported']. '</td>
									<td>'.$issue['reporter_name'].'</td>
									<td>'.$issue['urgency_level'].'</td>
									<td>'.$issue['status'].'</td>';
									echo '<td align="center"><a href="issue/' .  $issue['id']. '" class="ico edit">Edit</a></td></tr>';
								}
							?>							
						</table>
						
						
						<!-- Pagging -->
						<div class="pagging">
							<div class="left">Showing 1-12 of 44</div>
							<div class="right">
								<a href="#">Previous</a>
								<a href="#">1</a>
								<a href="#">2</a>
								<span>...</span>
								<a href="#">Next</a>
								<a href="#">View all</a>
							</div>
						</div>
						<!-- End Pagging -->
						
					</div>
					<!-- Table -->
					
				</div>
				<!-- End Box -->
				
				

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			<div id="sidebar">
				
				<!-- Box -->
				<div class="box">
					
					<!-- Box Head -->
					<div class="box-head">
						<h2>Management</h2>
					</div>
					<!-- End Box Head-->
					
					<div class="box-content">
						<a href="#" class="add-button"><span>Add new Issue</span></a>
						<div class="cl">&nbsp;</div>

						<!-- Sort -->
						<div class="sort">
							<label>Sort by</label>
							<select class="field">
								<option value="">Title</option>
							</select>
							<select class="field">
								<option value="">Date</option>
							</select>
							<select class="field">
								<option value="">Reporter</option>
							</select>
						</div>
						<!-- End Sort -->
						
					</div>
				</div>
				<!-- End Box -->
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