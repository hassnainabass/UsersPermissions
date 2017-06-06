<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h1><i class="fa fa-users"></i> Users Permissions <small>Please manage permissions for : <?= ucwords($user->username." - ".$user->role ) ?></small></h1>
    <hr />
  </div>
</div>

<?= $this->Form->create(); ?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php 
$counter = 1;
foreach ($result as $key => $value): 
  foreach ($value as $child_key => $child_value): 
?>
      

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="<?= $child_key ?>Heading">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $child_key ?>Collapse" aria-expanded="<?= ($counter=='1') ? 'true' : 'false' ?>" aria-controls="<?= $child_key ?>Collapse">
          <?= $child_key ?>
        </a>
      </h4>
    </div>
    <div id="<?= $child_key ?>Collapse" class="panel-collapse collapse <?= ($counter=='1') ? 'in' : '' ?>" role="tabpanel" aria-labelledby="<?= $child_key ?>Heading">
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            Select permissions for <i><strong><?= $child_key ?> Module</strong></i> below:
          </div>
        </div>
        <?php foreach ($child_value as $grand_child_key => $grand_child_value):?>
          <div class="checkbox">
            <label>
            <?php $exist = $this->Match->matchPermission($child_key.'-'.$grand_child_value, $permissions); ?>
              <input type="checkbox" name="permission[]" value="<?= $child_key.'-'.$grand_child_value ?>" <?= ($exist) ? 'checked' : '' ?> />
              <?= ucwords($grand_child_value ) ?>
            </label>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

<?php 
  $counter += 1;
  endforeach;
endforeach; 
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-block">
    <hr />
    <?= $this->Form->button('Update', ['class'=>'btn btn-success', 'style'=>'']); ?>
  </div>
</div>

</div>
<?= $this->Form->end(); ?>