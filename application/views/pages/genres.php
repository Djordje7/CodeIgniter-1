<div class="container mt-5">
	<div class="row">
		<div class="col">

			<table class="table">
				<tr>
					<th>ID</th>
					<th>Genre</th>
				</tr>
				<?php foreach ($genres as $genre) { ?>
				<tr>
					<td><?=$genre->id?></td>
					<td><a href="/pages/genre/<?=$genre->id?>"><?=$genre->genre?></a></td>
				</tr>
				<?php } ?>
			</table>

		</div>
	</div>
</div>
