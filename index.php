<?php

	include 'inc/bootstrap.php';


	if (!isset($_GET['p'])) $_GET['p'] = 'index';

	$file = 'text/'. $_GET['p'] .'.md';
			
	if(file_exists($file)){
		$c['content'] = Markdown(file_get_contents($file));
	}
	else {
		header('HTTP/1.0 404 Not Found');
        die('<h1>File Not Found</h1>
             <p>
                You enter a dark and musty smelling room and fumble for a light switch. 
                A dim bare blub hanging precariously from the ceiling turns on. You find 
                yourself surrounded by moldy manila folders, rusty old file cabinets, and 
                one stale grilled cheese sandwich. This must be the place... the legendary 
                File Not Found page rarely spoken of. 
             </p>
            ');
        
	}
	
	$c['runtime'] = round(((microtime(TRUE) - $c['runtime']) * 1000), 3);
    $c['peakram'] = humanFilesize(memory_get_peak_usage(TRUE));

	$c['template'] = file_get_contents('html/default.html');
	echo parseVars($c['template'], $c);
	
?>
