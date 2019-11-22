<!DOCTYPE html>
<html lang="en">

            <?php  $this->load->view('member/include/head') ?>
	<body>
		<div class="left-sidebar-pro">
			<?php $this->load->view('member/include/sidebar_menu') ?>
		</div>
		<!-- Start Welcome area -->
    	<div class="all-content-wrapper">
    		<?php  $this->load->view('member/include/topnavbar',$userLogin) ?>
				<?php $this->load->view($v_content) ?>

    		<?php $this->load->view('member/include/footer') ?>
    	</div>

		<?php include 'include/scripts.php' ?>
	</body>
</html>
