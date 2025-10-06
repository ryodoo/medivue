<div class="trempages index"></div>
<div class="page-header">
	<h1 class="title-page">Recherche par bac</h1>
	<span class="slogan"></span>
</div>
<div class="col-md-5">
	<div class="search-section">

		<?php echo $this->Form->create('Trempage'); ?>
		<?php echo $this->Form->input('bac_ref', array("maxlength"=>25,"type" => "text","label" => "Code bar du bac", 'placeholder' => '')); ?>
		<?php echo $this->Form->end(array('label' => 'Rechercher', 'class' => 'btn btn-primary-rounded')); ?>
	</div>
</div>
<div class="col-md-12 filter-section"></div>

</div>