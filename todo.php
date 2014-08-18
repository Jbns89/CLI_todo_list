<?php
$items =
[
	'Wake up','Take shower','Brush Teeth','Get dressed'
];
do
	{
		foreach ($items as $list => $activity) 
		{
			$list++;
			echo "[{$list}] {$activity} \n";
		}
		echo "(N)ew Item (R)emove Item (Q)uit" . PHP_EOL;
		$input = trim(fgets(STDIN));
		if (ucfirst($input) == 'N')
		{
			echo 'Please enter item' . PHP_EOL;
			$items[] = trim(fgets(STDIN));
		}
		elseif (ucfirst($input) == 'R')
		{
			echo 'Please enter item you want to remove' . PHP_EOL;
			$list = trim(fgets(STDIN));
			unset($items[$list-1]);
		}
	} while (ucfirst($input) != 'Q');
echo  "Goodbye! \n";
exit(0);