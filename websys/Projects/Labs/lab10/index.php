<?php 
require 'functions.php';
require 'config.php';

$conn = connect($config['DB_HOST'],
				$config['DB_USERNAME'],
				$config['DB_PASSWORD'],
            'websys_shop');
            // 'practice');

$results = query('SELECT * FROM customers', $conn);

require 'index.view.php';
