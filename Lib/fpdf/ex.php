<?php

declare(strict_types=1);
require 'fpdf_merge.php';

$merge = new FPDF_Merge();
$merge->add('doc1.pdf');
$merge->add('doc2.pdf');
$merge->output();
