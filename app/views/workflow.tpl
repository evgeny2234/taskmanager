<?php
	if(!$data1 && !$data2) {
		$data1 = 0;
		$blocksCounter = 0;
		$data2 = 0;
		$tasksCounter = 0;
	}
	else{
		$blocksCounter = count($data1);
		$tasksCounter = count($data2);
	}
?>
<script type="text/javascript" src="js/workflow.js"></script>
<link href="css/workflow.css" rel="stylesheet" type="text/css" />
<div class="row" style="margin-bottom: 20px;">
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

		<form class="form-horizontal" action="../mvc/workflow/createblock" method="post">	
			<input type="hidden" name="createNewBlock">
			<button class="btn btn-primary" id="create_new_block" type="submit" onclick="">Создать блок задач</button>
		</form>
		
	</div>
</div>

<div class="row all_tasks" >
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" id="all_tasks_container" data-blockhash="" >

		<?php  

			for($i = 0; $i<$blocksCounter; $i++) {

		?>
 
    	<div class="list_wrapper">
			<div class="task_block" data-blockid="<?php echo $data1[$i]['id']; ?>">
				<div class="container task_block_container">
					<div class="panel panel-default">
					  	<div class="panel-heading">
						  	<span data-blockid="<?php echo $data1[$i]['id']; ?>" class="delete_task_block" onclick="
						  	">x</span>
						    <h3 class="block_title panel-title"><?php echo $data1[$i]['blockname']; ?></h3>
						    <div class="input_block_name form-group">
							  <input data-blockid="<?php echo $data1[$i]['id']; ?>" type="text" placeholder="Название блока задач" class="block_name form-control" id="usr">
							</div>

							<div class="progress_bar">
								<span class="percent_text">%</span>
								<div class="progress">
								 	<div data-progress-bar="<?php echo $data1[$i]['id']; ?>" class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
								    	<span class="sr-only">0%</span>
								  	</div>
								</div>
							</div>
					  	</div>
					  	<div class="panel-body">
					  	
						    <div class="tasks_block" data-tasks-block="<?php echo $data1[$i]['id']; ?>">
						    	
						    	<?php

						    		for($j = 0; $j<$tasksCounter; $j++) {
						    			if($data2[$j]['block_id'] == $data1[$i]['id']) {

						    	?>

								<div class="input_task_name form-group">

									<div class="checkbox">
										<input data-blockid="<?php echo $data1[$i]['id']; ?>" data-taskid="<?php echo $data2[$j]['id']; ?>" <?php if($data2[$j]['status'] == 1) {echo 'checked';}  ?> style="margin-left: 0px;" type="checkbox" value="1" class="task_checkbox">
										<span class="remove_checkbox">X</span>
										<label class="checkbox_label" style="padding-left: 20px;"><?php echo $data2[$j]['taskname']; ?></label>
									</div>

								  	<input style="display: none;" autofocus type="text" placeholder="Название задачи" class="task_name form-control">
								  	<button data-blockid="<?php echo $data1[$i]['id']; ?>" data-taskid="<?php echo $data2[$j]['id']; ?>" style="display: none;" class="btn btn-primary save_changes">Сохранить</button>
								  	<button style="display: none;" class="btn btn-warning cancel_1">X</button>
								  	<button style="display: none;" class="btn btn-warning cancel_2">X</button>
								</div>

								<?php
										}

									}

						    	?>


						    </div>
						    <button class="add_new_task btn btn-default">Добавить задачу</button>
					  	</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

<textarea id="new_block" >
	
	<div class="task_block" >
		<div class="container task_block_container">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	<span class="delete_task_block" onclick="
			  	">x</span>
			    <h3 class="block_title panel-title">Название блока задач</h3>
			    <div class="input_block_name form-group">
				  <input type="text" placeholder="Название блока задач" class="block_name form-control" id="usr">
				</div>

				<div class="progress_bar">
					<span class="percent_text">%</span>
					<div class="progress">
					 	<div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					    	<span class="sr-only">0%</span>
					  	</div>
					</div>
				</div>

			  </div>
			  <div class="panel-body">
			  	
			    <div class="tasks_block">
			    </div>
			    <button class="add_new_task btn btn-default">Добавить задачу</button>
			  </div>
			</div>
		</div>
	</div>

</textarea>


<textarea id="new_task">

	<div class="input_task_name form-group">

		<div class="checkbox" style="display: none;">
			<input data-blockid="" data-taskid="" class="task_checkbox" style="margin-left: 0px;" type="checkbox" value="1">
			<span class="remove_checkbox">X</span>
			<label class="checkbox_label" style="padding-left: 20px;">Option 1</label>
		</div>

	  	<input autofocus type="text" placeholder="Название задачи" class="task_name form-control">
	  	<button onclick="

			this.nextElementSibling.style.display = 'none';

	  	" class="btn btn-primary save_changes">Сохранить</button>
	  	<button class="btn btn-warning cancel_1">X</button>
	  	<button style="display: none;" class="btn btn-warning cancel_2">X</button>

	</div>

</textarea>
