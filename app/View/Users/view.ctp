<div class="users view">
	<div class="page-header">
		<h1 class="title-page">Users</h1>
		<span class="slogan"></span>
	</div>
	<div class="col-md-12 little-title-section">
		<span class="little-title">User</span>
		<div class="actions">
		</div>
	</div>


	<div class="card view-card">
		<div class="card-body">
			<div class="col-12">
				<div class="row row-gap-3">
					<div class="col-md-3">
	<div class="info">
		<label>Role</label>
		<span>
			<?php echo $this->Html->link($user['Role']['id'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
		</span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Name'); ?></label>
		<span><?php echo h($user['User']['name']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Username'); ?></label>
		<span><?php echo h($user['User']['username']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Password'); ?></label>
		<span><?php echo h($user['User']['password']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Etat'); ?></label>
		<span><?php echo h($user['User']['etat']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Created'); ?></label>
		<span><?php echo h($user['User']['created']); ?></span>
	</div>
</div>
<div class="col-md-3">
	<div class="info">
		<label><?php echo __('Code'); ?></label>
		<span><?php echo h($user['User']['code']); ?></span>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>

</div>