<div class="container mt-5">
	<div class="row">
		<div class="col">

        <table class="table">
				<tr>
					<th>Anzahl</th>
					<th>EAN</th>
				</tr>
				<?php foreach ($not_found as $row) { ?>
				<tr>
					<td><?=$row->Anzahl?></td>
					<td><a target="_blank" href="https://www.google.com/search?q=+<?=$row->ean?>"><?=$row->ean?></a></td>
				</tr>
				<?php } ?>
			</table>  

        </div>
    </div>
</div>