<body>
    <div class="container">

        <?php $this->load->view($top); ?>

    	<?php // $this->load->view($left); ?>

    	<div>
    		<?php $this->load->view($messages); ?>

    		<div class="header">
    			<?php if (isset($breadcrumb)) : ?>
    				<ol class="breadcrumb">
    					<?php foreach ((array) $breadcrumb  as $value) : ?>
    						<li>
    							<i class="<?php echo (isset($value['icon']) ? $value['icon'] : ''); ?>"></i>
    							<?php if (isset($value['url'])) : ?>
    								<a href="<?php echo (isset($value['url']) ? $value['url'] : ''); ?>"><?php echo $value['text']; ?></a>
    							<?php else : ?>
    								<?php echo $value['text']; ?>
    							<?php endif; ?>
    						</li>
    					<?php endforeach; ?>
    				</ol>
    			<?php endif; ?>
    		</div>

    		<?php $this->load->view($view); ?>
    	</div>

    	<?php // $this->load->view($right); ?>

    	<?php $this->load->view($bottom); ?>

    	<?php if (ENVIRONMENT == 'development') : ?>
    		<p class="text-center text-muted">
    			CI Version: <strong><?php echo CI_VERSION; ?></strong>,
    			Elapsed Time: <strong>{elapsed_time}</strong> seconds,
    			Memory Usage: <strong>{memory_usage}</strong>
    		</p>
    	<?php endif; ?>
    </div>