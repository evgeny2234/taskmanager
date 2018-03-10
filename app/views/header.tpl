<nav class="navbar navbar-default">
  <div class="container-fluid header_block">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Trello V2</a>
      <!--
		вставить линк на домен
      -->
    </div>

    <div class="navbar-header" style="float: right;">
    <?php

    	if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]))   
		{ 
			echo '<a class="navbar-brand" href="../mvc/auth/logout">Logout</a>';
		}

	?>
	</div>

  </div>
</nav>