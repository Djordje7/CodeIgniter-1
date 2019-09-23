<div class="container mt-5">
	<div class="row">
		<div class="col">

			<table class="table">
				<tr>
					<th>Anzahl</th>
					<th>EAN</th>
				</tr>	
				<?php $summe=0;?>
				
				<?php foreach ($not_found as $row) { ?>
				<tr>
				<?php $summe+=$row->anzahl?>
					<td><?=$row->anzahl?></td>
					<td><a target="_blank" href="https://www.google.com/search?q=+<?=$row->ean?>"><?=$row->ean?></a></td>
				</tr>
					
				<?php } ?>
			</table> 
			<div class="alert alert-primary" role="alert">

				<?=$summe?> Suchanfragen mit <?=count($not_found)?> verschiedenen EAN
			</div>
        </div>
    </div>
</div>



