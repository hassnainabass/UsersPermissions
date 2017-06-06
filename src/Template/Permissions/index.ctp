<?php
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1><i class="fa fa-users"></i> Users Permissions <small>Please select user to manage a permission</small></h1>
	</div>
</div>
<div class="table-responsive">
  <table class="table">
    <thead>
    	<th>ID</th>
    	<th>Username</th>
    	<th>Role</th>
    	<th class="actions">Actions</th>
    </thead>
    <tbody>
    	<?php foreach ($all_users as $key => $user): ?>
    	<tr>
    		<td><?= __($user->id) ?></td>
    		<td><?= __($user->username) ?></td>
    		<td><?= __($user->role) ?></td>
    		<td class="actions"><?= $this->Html->link('Permissions', ['action'=>'userpermission', $user->id]); ?></td>
    	</tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>