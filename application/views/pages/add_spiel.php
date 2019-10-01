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
			$('.select2-multiple').select2({
				placeholder: 'Genres'
			})
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
						<input type="text" maxlength="50" class="form-control" id="titel" name="titel" placeholder="Titel" require>
					</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="text" maxlength="100" class="form-control" id="ean" name="ean" value="<?=$ean?>">
					</div>
					<div class="form-group col-md-6">
						<input type="number" maxlength="11" class="form-control" id="externe_id" name="externe_id" placeholder="externe_id">
					</div>
				</div>
				
					<div class="form-group">
						<select class="form-control select2-multiple" id="genres" name="genres[]" multiple="multiple" maxlength="30">
							<option value=""></option>
							<?php 
								foreach($genre as $row){?>
									<option value="<?=$row->id?>"><?=$row->genre?></option>
								<?php }
							?>	
						</select>
					</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="text" maxlength="50" class="form-control" id="autor" name="autor" placeholder="autor">
					</div>
				
					<div class="form-group col-md-6">
						<input type="text" maxlength="50" class="form-control" id="illustration" name="illustration" placeholder="Illustration">
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="number" class="form-control" id="alter" name="alter" placeholder="Alter">
					</div>

					<div class="form-group col-md-6">
						<input type="number" class="form-control" id="alter_bis" name="alter_bis" placeholder="Alter bis">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<select class="form-control select2-autocomplete" maxlength="30"  id="spieldauer" name="spieldauer" placeholder="Spieldauer"></select>
					</div>
					<div class="form-group col-md-6">
						<select class="form-control select2-autocomplete" placeholder="Anzahl Spieler" id="azspieler" name="azspieler" maxlength="50"></select>
					</div>

				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<select class="form-control" id="level" name="level">
							<option value="">Level</option>
							<?php 
								foreach($level as $row){?>
									<option value="<?=$row->level?>"><?=$row->level_text?></option>;
								<?php }
							?>	
						</select>
					</div>		
				
					<div class="form-group col-md-6">
						<select class="form-control" id="zielgruppe" name="zielgruppe" require>
							<option value="">Zielgruppe</option>
							<?php 
								foreach($zielgruppe as $row){?>
									<option value="<?=$row->id?>"><?=$row->zielgruppe?></option>;
								<?php }
							?>	
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<select class="form-control select2-autocomplete" placeholder="Verlag" id="verlag" name="verlag" maxlength="50" require></select>
					</div>
					<div class="form-group col-md-6">
						<input type="text" maxlength="255" class="form-control" id="artikelnr_verlag" name="artikelnr_verlag" placeholder="artikelnr_verlag">
					</div>

				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<select class="form-control" id="herkunft_id" name="herkunft_id">
							<option value="">Herkunft</option>
							<?php 
								foreach($herkunft as $row){?>
									<option value="<?=$row->id?>"><?=$row->name?></option>;
								<?php }
							?>	
						</select>
					</div>
				
					<div class="form-group col-md-6">
						<select class="form-control" id="text_im_spiel" name="text_im_spiel">
							<option value="">Text im Spiel</option>
							<option value="0">Nein</option>
							<option value="1">Ja</option>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="text" maxlength="2" class="form-control" id="sprache" name="sprache" placeholder="sprache">
					</div>
					<div class="form-group col-md-6">
						<input type="text" maxlength="20" class="form-control" id="sprache_regeln" name="sprache_regeln" placeholder="sprache_regeln">
					</div>
				</div>

				<div class="form-group">
						<select class="form-control" id="..." name="...">
							<option value="">Zubehör</option>
							<?php 
								foreach($level as $row){?>
									<option value="<?=$row->level?>"><?=$row->level_text?></option>;
								<?php }
							?>	
						</select>
				</div>
					<div class="form-group">
						<input type="text" maxlength="255" class="form-control" id="beschreibung_titel" name="beschreibung_titel" placeholder="Beschreibung Titel" >
					</div>
					<div class="form-group">
						<textarea class="form-control" cols="30" rows="10" id="beschreibung" name="beschreibung" placeholder="Beschreibung"></textarea>
					</div>
					
					<div class="form-group">
						<textarea class="form-control" cols="30" rows="10" id="inhalt" name="inhalt" placeholder="Inhalt"></textarea>
					</div>
					<div class="form-group">
						<input type="number" maxlength="11" class="form-control" id="jahr" name="jahr" placeholder="Jahr">
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" name="gesperrt" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Sperren!</label>
					
						<?php 
						if(isset($_POST['gesperrt'])){
							$checkbox = true;
						}else{
							$checkbox = false;
						}
						?>
						
					</div>
				

				
					<button type="submit" class="btn btn-primary">Speichern</button>
			<?= form_close()?>
		</div>
    </div>
</div>