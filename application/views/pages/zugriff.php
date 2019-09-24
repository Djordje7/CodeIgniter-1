<div class="container mt-5">
	<div class="row">
		<div class="col">
			<table class="table">
				<tr>
					<th>Ludothek</th>
					<th>Zugriff found</th>
					<th>nicht gefunden</th>
					<th>wieder vorhanden</th>
                </tr>	
                <?php
                    $summe_zugriff_found=0;
                    $summe_still_missing=0;
                    $summe_existing_now=0; 
                
                    foreach ($zugriff as $rows) { ?>
                    <tr>             
                        <?php 
                        $summe_zugriff_found+=$rows->zugriff_found;
                        $summe_still_missing+=$rows->not_found_and_still_missing;
                        $summe_existing_now+=$rows->not_found_but_existing_now;
                        ?>
                            
                        <td><?=$rows->ludothek?></td>
                        <td><?=$rows->zugriff_found?></td>
                        <td><?=$rows->not_found_and_still_missing?></td>
                        <td><?=$rows->not_found_but_existing_now?></td>
                    </tr>
                <?php } ?> 
                <tr>
                    <th>Die Gesamt summe:</th>
                    <th><?=$summe_zugriff_found?></th>        
                    <th><?=$summe_existing_now?></th>
                    <th><?=$summe_still_missing?></th>      
                </tr>    
            </table> 
        </div>
    </div>
</div>

