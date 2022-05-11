<div id='container'>
	<div id='navigation'>
    	<ul>
        	<li><a href='?news'>Sākums</a></li> 
			<li><a href='#'>Galerijas</a></li>
			<li><a href='#'>Mūzika</a></li>
            <li><a href='#'>Vestules</a></li>
            <li><a href="?acp">Admin panel</a></li>
			   
            
            <li style='float:right'><b><a href='#'>Iziet </a></b> </li>
        </ul>
	</div>

	<div id='navigation2'>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/Document Applications.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/sale.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/user-unregistered.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/online.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/present.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/forum_stats.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/message.png'> Links</a>
		<a href='#'><img style='margin-bottom: -1px;' height='10px' src='img/message.png'> Links</a>

	</div>
	<div id='left-panel'>
    	 	Hello, 
				<a href=''><font color='red'>
				 <?php echo getUserData('firstname') . " &nbsp;" . getUserData('lastname'); ?>
 			</font></a>
    	<br/>
    	<div class='img'>       
        	<img style='border: 2px solid #eee;' width='175px' height='175px' src='<?php echo getUserData('picture')?>'>

        </div>
        <div class='content'>
        			» <a href='#'>Mans Prfils</a><br/>
				» <a href='#'>Labot profilu</a><br/>
				» <a href='#'>Vestules</a><br/>

        </div>
		<div style='padding: 2px'></div>
	</div>