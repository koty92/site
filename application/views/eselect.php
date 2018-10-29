<div class='eselect_container <?= isset($id) ? 'container_' . $id : '';?>'>

	<div class='eselect_container_input_text'>
		<input type='hidden' class='eselect_input_val' name='<?= $name; ?>'  value='<?= isset($value) ? $value : ''; ?>' <?= isset($required) ? $required : ''; ?> id='<?= isset($id) ? $id : ''; ?>'>
		<input type='text' class='eselect_input_text' placeholder='<?= isset($placeholder) ? $placeholder : 'Please Select'; ?>' value='<?= isset($value_text) ? $value_text : ''; ?>' <?= isset($required) ? $required : ''; ?>>
		<img src='<?= base_url(); ?>assets/images/icons/arrow_down_grey.png' class='eselect_img_arrow_down'>
	</div>
			
	<div class='eselect_container_suggest'>
		<div class='eselect_container_input_select'>
			<div class='eselect_container_input_query'>
				<input type='text' class='eselect_input_query'>
			</div>
					
			<div class='eselect_container_select_result'>
				<?php
				echo '<div class="eselect_result_row" tabindex="1" data-value="">';
				if(isset($checkbox)) {
					echo '<input type="checkbox" class="eselect_checkbox_all">';
				}
				echo isset($placeholder) ? $placeholder : 'Please Select';
				echo '</div>';
				
				foreach($result as $r) {
					echo '<div class="eselect_result_row" tabindex="1" data-value="' . $r -> data_value . '">';
					$check = '';
					
					if(isset($checkbox)) {
						if(isset($checked)) {
							if(in_array($r -> data_value, $checked)) {
								$check = 'checked';
							}
						}
						
						echo '<input type="checkbox" class="eselect_checkbox" name="' . $name . '[]" value="' . $r -> data_value . '"' . $check . '>';
					}
					
					echo ucfirst($r -> data_text);
					echo '</div>';
				}
				?>
			</div>
		</div>
	</div>

</div>