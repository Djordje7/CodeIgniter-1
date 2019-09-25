<div class="container mt-5">
	<div class="row">
		<div class="col">

			<table class="table">
				<tr>
					<th>Anzahl</th>
					<th>EAN</th>
					<th></th>
				</tr>
				<?php $summe=0;?>
				
				<?php foreach ($not_found as $row) { ?>
				<tr>
				<?php $summe+=$row->anzahl?>
					<td><?=$row->anzahl?></td>
					<td><a target="_blank" href="https://www.google.com/search?q=+<?=$row->ean?>"><?=$row->ean?></a></td>
					<td><a href="<?=base_url()?>pages/add_spiel/<?=$row->ean?>" class="btn btn-primary">Erfassen</a></td>
				</tr>
					
				<?php } ?>
			</table> 
			<div class="alert alert-primary" role="alert">
				<?=$summe?> Suchanfragen mit <?=count($not_found)?> verschiedenen EAN
			</div>
        </div>
    </div>
</div>