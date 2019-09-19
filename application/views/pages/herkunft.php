<div class="container mt-5">
	<div class="row">
		<div class="col">

			<table class="table">
				<tr>
					<th>ID</th>
					<th>Herkunft</th>
				</tr>
				<?php foreach ($herkunft as $h) { ?>
				<tr>
					<td><?=$h->id?></td>
					<td><?=$h->name?></td>
				</tr>
				<?php } ?>
			</table>

		</div>
	</div>
</div>
