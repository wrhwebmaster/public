<?PHP

///////////////////////////////////////////////////////////////////////
function get_xml($url)
{
        $headers[] = "Accept-Encoding: gzip";
           //see: http://trog.qgl.org/20110729/differences-in-requesting-gziped-content-using-curl-in-php/

        $ch = curl_init();
        if (!$ch) {
            $MainMSG="Kindly let Webmaster know, thru email: <a href=\"mailto:someone@someplace.com\"><b>Webmaster</b></a>";
            #---- email the error ---->    emailUs($url);
            die("Couldn't initialize a cURL handle to access file: >>> ".$url. "<<<.<br>\n" .$MainMSG. "<br>");
            exit(1); // A response code other than 0 is a failure
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        #curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);   // The number of seconds to wait while trying to connect.
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);                   // Timeout in seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT,'someone@someplace.com');


        ob_start();          //--- Start buffering
        $data = curl_exec($ch);
        ob_end_clean(); //--- End buffering and clean output

        curl_close($ch);

        return $data;

}
///////////////////////////////////////////////////////////////////////

$url="http://www.someplace_unique.com/data/nwsweatherstory.kml";

$contents_of_XML_file=get_xml($url);

echo $contents_of_XML_file;

?>
