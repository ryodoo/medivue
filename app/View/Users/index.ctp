<div class="users index"></div>
<div class="page-header">
	<h1 class="title-page">Users</h1>
	<span class="slogan"></span>
</div>
<div class="col-md-5">
	<div class="search-section">
		<div class="input-group mb-3">
			<span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
			<input type="text" class="form-control" id="search_input" placeholder="Rechercher" aria-label="Search">
			<button class="btn btn-primary-rounded" type="button"><i class="fa-solid fa-magnifying-glass"></i> Rechercher</button>
		</div>
	</div>
</div>
<div class="col-md-12 filter-section"></div>
<div class="content-table">
	<table class="table table-akdital">
		<thead>
			<tr>
																								<th>role_id</th>
																				<th>name</th>
																				<th>username</th>
																				<th>password</th>
																				<th>etat</th>
																				<th>created</th>
																				<th>code</th>
													<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $user): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($user['Role']['id'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
		</td>
		<td><?php echo $user['User']['name']; ?></td>
		<td><?php echo $user['User']['username']; ?></td>
		<td><?php echo $user['User']['password']; ?></td>
		<td><?php echo $user['User']['etat']; ?></td>
		<td><?php echo $user['User']['created']; ?></td>
		<td><?php echo $user['User']['code']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?> / 
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?> /
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>

</div>