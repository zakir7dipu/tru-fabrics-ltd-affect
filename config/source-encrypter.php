<?php

return [
	'source'      => [
		'app', 
		'database', 
		'routes', 
		'Modules/CMS/app',
		'Modules/CMS/database',
		'Modules/CMS/routes',
		'Modules/Commercial/app',
                'Modules/Commercial/database',
                'Modules/Commercial/routes',
                'Modules/IMS/app',
                'Modules/IMS/database',
		'Modules/IMS/routes',
                'Modules/ImportGoods/app',
                'Modules/ImportGoods/database',
		'Modules/ImportGoods/routes',
                'Modules/Language/app',
                'Modules/Language/database',
		'Modules/Language/routes',
                'Modules/Productions/app',
                'Modules/Productions/database',
		'Modules/Productions/routes',
                'Modules/Products/app',
                'Modules/Products/database',
		'Modules/Products/routes',
                'Modules/Report/app',
                'Modules/Report/database',
		'Modules/Report/routes',
                'Modules/StoreInventory/app',
                'Modules/StoreInventory/database',
		'Modules/StoreInventory/routes',
	], // Path(s) to encrypt
    'destination' => 'encrypted', // Destination path
    'key_length'  => 6, // Encryption key length
];
