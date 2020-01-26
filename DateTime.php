
<?php
date_default_timezone_set("Moldova,Chisinau");
//date_default_timezone_set("Russia,Moskow");
$CurrentTime = time();
$DateTime=strftime("%H:%M:%S",$CurrentTime);
$DateData=strftime("%d-%b-%Y",$CurrentTime);
$DateDataALL=strftime("%d-%b-%Y %H:%M:%S",$CurrentTime);


echo $DateTime;

?>