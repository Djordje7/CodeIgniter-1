<div class="container mt-5">
	<div class="row">
		<div class="col">
			<table class="table">
				<tr>
					<th>Ludothek</th>
					<th>Zugriff found</th>
					<th>not_found_and_still_missing</th>
					<th>not_found_but_existing_now</th>
                </tr>	
                        <?php $summe_zugriff_found=0;
                              $summe_still_missing=0;
                              $summe_existing_now=0; ?>
                        <?php foreach ($zugriff as $rows) { ?>
                    <tr>             
                        <?php $summe_zugriff_found+=$rows->zugriff_found;
                            $summe_still_missing+=$rows->not_found_and_still_missing;
                            $summe_existing_now+=$rows->not_found_but_existing_now;?>
                            
                    <td><?=$rows->ludothek?></td>
                    <td><?=$rows->zugriff_found?></td>
                    <td><?=$rows->not_found_and_still_missing?></td>
                    <td><?=$rows->not_found_but_existing_now?></td>
				    </tr>
                <?php } ?>  
            </table> 
            <div class="alert alert-primary" role="alert">
                Es haben <?=$summe_zugriff_found?> versucht zugriff zu bekommen.
            </div> 
            <div class="alert alert-secondary" role="alert">
                Es wurden <?=$summe_still_missing?> zugriffe nicht gefunden und weiterhin fehlend.
            </div>
            <div class="alert alert-dark" role="alert">
                Es wurden <?=$summe_existing_now?> zugriffe nicht gefunden aber existieren nun.
            </div>
        </div>
    </div>
</div>

