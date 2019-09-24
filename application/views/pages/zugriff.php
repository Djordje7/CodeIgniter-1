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
                        <?php $summe=0;?>
                        <?php $summe2=0;?>
                        <?php $summe3=0;?>
                        <?php foreach ($zugriff as $rows) { ?>
                        <tr>
                            
                        <?php $summe+=$rows->zugriff_found?>
                        <?php $summe2+=$rows->not_found_and_still_missing?>
                        <?php $summe3+=$rows->not_found_but_existing_now?>
                    <td><?=$rows->ludothek?></td>
                    <td><?=$rows->zugriff_found?></td>
                    <td><?=$rows->not_found_and_still_missing?></td>
                    <td><?=$rows->not_found_but_existing_now?></td>
				</tr>
                <?php } ?>  
            </table> 
        </div>
    </div>
</div>

