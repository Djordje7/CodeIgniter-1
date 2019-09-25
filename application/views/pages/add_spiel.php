<script>
    $(document).ready(function(){
        $('.select2-autocomplete').each(function(){
            var placeholder = $(this).attr("placeholder");
            var field = $(this).attr("name");
        	$(this).select2({
                placeholder: placeholder,
                minimumInputLength: 3,
                ajax: {
                    url: '<?=base_url()?>pages/get_json/' + field,
                    dataType: 'json'
                },
                tags: true,
                createTag: function (params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                }
            });
		});
    });
</script>
<div class="container mt-5">
	<div class="row">
		<div class="col">
			<h1>Spiel mit EAN <?=$ean?> erfassen</h1>
			<a target="_blank" href="https://www.google.com/search?q=+<?=$ean?>">Google Suche nach <?=$ean?></a>
			<br>
			<a target="_blank" href="https://www.google.com/search?tbm=isch&q=+<?=$ean?>">Google Bildersuche nach <?=$ean?></a>

			<br><br><br>

			<?php
			/*
			 * `ean`,
			`titel`
			`verlag`
			`autor`
			`illustration`
			`alter`
			`alter_bis`
			`azspieler`
			`spieldauer`
			`beschreibung_titel`
			`beschreibung`
			`inhalt`
			`jahr`
			`artikelnr_verlag`
			`sprache_regeln`
			`text_im_spiel`
			`level`
			`zielgruppe`
			`externe_id`
			`herkunft_id`
			 */
			?>

			<?= form_open();?>
				<div class="form-group">
					<input type="text" maxlength="100" class="form-control" id="ean" name="ean" value="<?=$ean?>" required>
				</div>
				<div class="form-group">
					<input type="text" maxlength="50" class="form-control" id="titel" name="titel" placeholder="Titel" required>
				</div>
				<div class="form-group">
					<select class="form-control select2-autocomplete" placeholder="Verlag" id="verlag" name="verlag" maxlength="50" required></select>
				</div>
				<div class="form-group">
					<input type="text" maxlength="50" class="form-control" id="autor" name="autor" placeholder="autor">
				</div>
				<div class="form-group">
					<input type="text" maxlength="50" class="form-control" id="illustration" name="illustration" placeholder="Illustration">
				</div>
				<div class="form-group">
					<input type="number" class="form-control" id="alter" name="alter" placeholder="Alter">
				</div>
				<div class="form-group">
					<input type="number" class="form-control" id="alter_bis" name="alter_bis" placeholder="Alter bis">
				</div>
				<div class="form-group">
					<select class="form-control select2-autocomplete" placeholder="Anzahl Spieler" id="azspieler" name="azspieler" maxlength="50"></select>
				</div>
				<div class="form-group">
					<select class="form-control select2-autocomplete" maxlength="30"  id="spieldauer" name="spieldauer" placeholder="Spieldauer"></select>
				</div>
				<div class="form-group">
					<input type="text" maxlength="255" class="form-control" id="beschreibung_titel" name="beschreibung_titel" placeholder="Beschreibung Titel">
				</div>
				<div class="form-group">
					<textarea class="form-control" cols="30" rows="10" id="beschreibung" name="beschreibung" placeholder="Beschreibung"></textarea>
				</div>
				<div class="form-group">
					<textarea class="form-control" cols="30" rows="10" id="inhalt" name="inhalt" placeholder="Inhalt"></textarea>
				</div>
				<div class="form-group">
					<input type="number" class="form-control" id="jahr" name="jahr" placeholder="Jahr">
				</div>

				<button type="submit" class="btn btn-primary">Speichern</button>
			<?= form_close()?>
		</div>
    </div>
</div>



