<?php

class View
{
	function generate($content_view, $template_view, $data1, $data2)
	{
		include 'app/views/main_template.tpl';
		include 'app/views/header.tpl';
		include 'app/views/footer.tpl';
		include 'app/views/'.$template_view;
	}
}