<!DOCTYPE html>
<html>
<body>



<?php

function writeMsg() {
    #echo "Hello world!";
	return "Hello world!";
}

function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
			#echo "a"
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
		#print "a";
        fclose($handle);
    }
    return $data;
}

function read_stock($sym = 'AAPL', $range = '5d', $interval = '1d')
{
	$yahooURL = 'https://query1.finance.yahoo.com/v8/finance/chart/'.$sym.'?range='.$range.'&interval='.$interval;
    print_r($sym."\n");
    $res=file_get_contents($yahooURL);
    $d2 = json_decode($res, true);
	return $d2;
}
#echo writeMsg();
$stx = csv_to_array($filename='nasdaqlisted.txt', $delimiter='|');

$stxnum = count($stx);
print_r($stxnum);
#$stxnum = 600;
for ($x = 0; $x < $stxnum; $x++){
    print_r($stx[$x][Symbol]);
	print ("\n");
    $sym = $stx[$x][Symbol];
	#print_r($sym."\n");
#	$sym = 'AAPL';
    #sleep(1);
    $data = read_stock($sym, $range = '5d', $interval = '1d');
	#print_r($data);
	$fp = fopen('./csv/'.$sym.'.csv', 'w');
    #foreach ( $data as $line ) {
    #    $val = explode(",", $line);
    fwrite($fp, print_r($data, TRUE));
    #}
    fclose($fp);
#    $timestamp = $d2[chart][result][0][timestamp];
#    $data = $d2[chart][result][0][indicators][quote][0];
    #print_r($d2[chart][result][0]);
#    $open = $data[open];
#    $closed = $data[close];
#    $volume = $data[volume];
#    $cou = count($open);
#    print_r($cou);
#    print ",";
#    foreach($volume as $value) {
#        print_r($value);
#        print ",";
#     }
#     for ($x1 = 0; $x1 < $cou; $x1++){
#	    print_r($timestamp[$x1]);
#	    print ",";
#     }

#    print_r($open[$x]);
#    print_r($closed[$x]);
#    print_r($volume[$x]);
}


#$d3 = $d2['chart'];
#echo $d1;
#echo $d2;
#echo $d3;
#$body = $data['chart']['result'][0];
#echo $body;
#$tables = $body->find('table');
#echo $tables;
#echo lookup($sym);
#$yahooURL='https://finance.yahoo.com/quote/'.$sym.'/history?p='.$sym;
#$data = file_get_contents($yahooURL);
#echo $data;
#$title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : null;
#echo $title;

#$title = preg_replace('/[[a-zA-Z0-9\. \| ]* \| /','',$title);
#$title = preg_replace('/ Stock \- Yahoo Finance/','',$title);
#$name = $title;
#echo $name;
#echo writeMsg();





?>

<table border="1">
<?php foreach (range(1,4) as $row) { ?>
<tr>
<?php foreach (range(1,4) as $col) { ?>
<td><?php #echo $open[$row]; ?></td>
<?php  } ?>
</tr>
<?php } ?>
</table>

</body>
</html>