<?php

return [
	// ...
	'font_path' => base_path('resources/fonts/'),
	'font_data' => [
		'khmerfont' => [
			'R'  => 'KhmerOSsiemreap.ttf',    // regular font
			'B'  => 'KhmerOSmuollight.ttf',       // optional: bold font
			'I'  => 'KhmerOSsiemreap.ttf',     // optional: italic font
			'BI' => 'KhmerOSsiemreap.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			//'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		]
	]
];  