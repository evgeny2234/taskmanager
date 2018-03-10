$( document ).ready(function() {

	countPercent();

  	//удаление блока целиком
  	$('body').on('click', '.delete_task_block', function(){
  		$(this).parent().parent().parent().parent().remove();
  		let blockId = $(this).attr('data-blockid');
  		$.ajax({
		  type: 'POST',
		  url: '../mvc/workflow/removeblock',
		  data: 'blockId='+blockId,
		  success: function(msg){
		    //console.log( 'Прибыли данные: ' + msg );
		  }
		});
  	});

  	// анимация при коике на заголовок
	$('body').on('click', '.block_title', function(){
		$(this).hide();
  		$(this).next().show();
  		$(this).next().children().focus();
	});

	//меняем заголовок блока
	$('body').on('blur', '.block_name', function(){

		let headtext = $(this).val();
		$(this).parent().hide();
		$(this).parent().prev().show();
		if(headtext) {
			$(this).parent().prev().text(headtext);
	  	}
	  	let blockId = $(this).data('blockid');

	  	$.ajax({
		  type: 'POST',
		  url: '../mvc/workflow/headrename',
		  data: 'blockId='+blockId+'&headtext='+headtext,
		  success: function(msg){
		    //alert( 'Прибыли данные: ' + msg );
		  }
		});
	});

	// отмечаем чекбоксы тасков
	$('body').on('click', '.task_checkbox', function(){

		let isChecked = $(this).prop('checked');
		let taskId = $(this).data('taskid');
		let blockId = $(this).parent().parent().parent().parent().parent().parent().parent().data('blockid');
		let taskName = $(this).next().val();
		let taskhash = $(this).parent().next().next().data('taskhash');
		if((taskId == undefined) && (taskhash == undefined)) {
			taskhash = Math.random().toString(36).substring(7);
			$(this).attr('data-taskhash',taskhash);
		}

		countPercent();

		$.ajax({
		  type: 'POST',
		  url: '../mvc/workflow/ischecked',
		  data: 'blockId='+blockId+'&taskId='+taskId+'&isChecked='+isChecked+'&taskName='+taskName+'&taskhash='+taskhash,
		  success: function(msg){
		    //alert( 'Прибыли данные: ' + msg );
		  }
		});	
		
	});	

	$('body').on('click', '.checkbox_label', function(){
		$(this).parent().hide();
		$(this).parent().next().show();
		$(this).parent().next().next().show();
		$(this).parent().next().next().next().next().show();
		$(this).parent().next().val($(this).text());
	});		

	// сохраняем изменения
	$('body').on('click', '.save_changes', function(e){

		$(this).parent().parent().next().show();
		$(this).next().next().hide();
		$(this).prev().hide();
		$(this).hide();
		$(this).prev().prev().children().last().text($(this).prev().val());
		$(this).prev().prev().show();

		let taskId = $(this).data('taskid');
		let taskhash = $(this).data('taskhash');

		if((taskId == undefined) && (taskhash == undefined)) {
			taskhash = Math.random().toString(36).substring(7);
			$(this).attr('data-taskhash',taskhash);
		}

		let taskName = $(this).prev().val(); 
		let blockId = $(this).parent().parent().parent().parent().parent().parent().data('blockid');

		countPercent();

		$.ajax({
		  type: 'POST',
		  url: '../mvc/workflow/taskname',
		  data: 'blockId='+blockId+'&taskId='+taskId+'&taskName='+taskName+'&taskhash='+taskhash,
		  success: function(msg){

		  	console.log(msg);
		  }
		});
	});

	// кнопки отмены с разными дейсвтиями 
	$('body').on('click', '.cancel_1', function(){

		$(this).parent().parent().next().show();
		$(this).parent().hide();
	});

	$('body').on('click', '.cancel_2', function(){

		$(this).prev().prev().prev().hide();
		$(this).prev().prev().hide();
		$(this).prev().hide();
		$(this).hide();
		$(this).prev().prev().prev().prev().show();
	});
	// -----------
	$('body').on('click', '.add_new_task', function(){

		let p = $(this).prev();
  		p.append($('#new_task').val());

  		$(this).hide();
  		$(this).prev().children().last().children().first().hide();
  		$(this).prev().children().last().children().first().next().focus();
	});

	$('body').on('click', '.remove_checkbox', function(){
		let blockId = $(this).parent().parent().parent().data('tasks-block');
		let taskhash = $(this).parent().next().next().data('taskhash');
		let taskId = $(this).prev().data('taskid');

		var response = ''
		$.ajax({
		  type: 'POST',
		  url: '../mvc/workflow/removetask',
		  data: 'blockId='+blockId+'&taskId='+taskId+'&taskhash='+taskhash,
		  success: function(msg){
		  	response = msg;
		  }
		});	

		$(this).parent().parent().remove();
		countPercent()

	});
	
	function countPercent() {

		var checked = 0;
		var unchecked = 0;
		var blockId;

		$('.tasks_block').each(function(){

			blockId = $(this).data('tasks-block');
			checked = 0;
			unchecked = 0;

			$(this).children().each(function(elem){

				if($(this).children().children().prop('checked') == true) {
					checked++;
					console.log('111');
					$(this).addClass('checked_block');
					$(this).children().children().last().addClass('checked_task');
				}
				else {
					unchecked++;
					$(this).removeClass('checked_block');
					$(this).children().children().last().removeClass('checked_task');
				}
			});

			let percent = ((checked*100)/(checked+unchecked));
			percent = Math.round(percent);

			if(isNaN(percent)) {percent = 0;}

			$('[data-progress-bar='+blockId+']')[0].style.width = percent+'%';
			$('[data-progress-bar='+blockId+']').parent().prev().text(percent+'%');

		});	
	}

});