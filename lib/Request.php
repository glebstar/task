<?php

class Request
{
    /**
     * Returns previous URL
     * @return string
     */
    public static function prevUri()
    {
        return $_SERVER["HTTP_REFERER"];
    }
    
    /**
     * Returns true if post back
     * @return bool
     */
    public static function isPostBack()
    {
        $meth = $_SERVER["REQUEST_METHOD"];
        if ("POST" == $meth)
            return true;
        else
            return false;
    }
    
    /**
     * Returns client IP address
     * @return string
     */
    public static function getIp()
    {
        return $_SERVER["REMOTE_ADDR"];
    }
    
    public static function getUserAgent()
    {
        if ( isset($_SERVER['HTTP_USER_AGENT']) ) {
            return $_SERVER['HTTP_USER_AGENT'];
        } else {
            return 'unknown';
        }
    }
    
    /**
     * Returns value of variable from Query String
     * @return mixed
     *
     */
    public static function getVar($name, $default = null, $htmlspec=true)
    {
        $res = null;
        if (isset($_REQUEST[$name]))
            $res = @$_REQUEST[$name];
        else
            return $default;
        if ( $htmlspec ) {
            $res = str_replace('\\', "&#92;", htmlspecialchars($res));
        }
        return trim($res);
    }
    
    /**
     * returns uploaded file data
     * */
    public static function getFile($name)
    {
        if ( isset($_FILES[$name]) ) {
            if ( $_FILES[$name]['error'] !== 0 ) {
                return false;
            }
            return $_FILES[$name];
        }
        return false;
    }
    
    /**
     * Check whether file was uploaded
     * */
    public static function isFile($name)
    {
        if ( $_FILES[$name]["error"] != UPLOAD_ERR_NO_FILE )
            return true;
        else
            return false;
    }
    
    /**
     * Returns checkbox value
     * @return bool
     * */
    public static function getCheckBox($name)
    {
        $res = self::getVar($name);
        if ($res == "on")
            return true;
        else 
            return false;
    }
    
    /**
     * Returns integer value of query string variable
     * @param string $name Var name
     * @param int $default Default value
     * @return int
     */
    public static function getInt($name, $default = 0)
    {
        $res = null;
        if (isset($_REQUEST[$name]))
            $res = intval($_REQUEST[$name]);
        else 
            $res = $default;
        return $res;
    }
    
    /**
     * Returns Array from query string
     * @param string $name
     * @return array
     */
    public static function getArray($name, $default=null)
    {
        if ( !isset ($_REQUEST[ $name ]) ) {
            return $default;
        }
        
        // TODO Заслешить все значения !!!
        $res = $_REQUEST[$name];
        if (is_array($res))
        {
            self::stripArray($res);
            return $res;
        }
        else
        {
            return $default;
        }
    }
    
    public static function stripArray(&$array)
    {
        foreach ($array as $key => $value)
        {
            if(is_array($value))
            {
                self::stripArray($array[$key]);
            }
            else 
            {
                $res = addslashes($value);
            }
            $array[$key] = $res;
        }
    }
    
    public static function getRealArray($name, $default=array())
    {
        if ( !isset ($_REQUEST[ $name ]) ) {
            return $default;
        }
        
        return $_REQUEST[ $name ];
    }

    /**
     * Returns float value
     * @param string $name
     * @return float
     */
    public static function getFloat($name)
    {
        $res = $_REQUEST[$name];
        return floatval($res);
    }
    
    /**
     * РRedirect to URL
     * @param $uri - URL
     */
    public static function redirect($uri)
    {
        header("Location: " . $uri);
        exit;
    }
    
    public static function redirect301($uri)
    {
        header( "HTTP/1.1 301 Moved Permanently" ); 
        Header( "location: " . $uri );
        exit;
    }

    /**
     * Send headers
     * */
    public static function sendNoCacheHeaders()
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }
    
    public static function getJson($name, $default=array())
    {
        if ( isset($_REQUEST[$name]) ) {
            $res = json_decode($_REQUEST[$name], true);
            if ( $res ) {
                return $res;
            }
        }
        
        return $default;
    }
    
    public static function getBoolPostgres($name, $default='f')
    {
        if ( isset ($_REQUEST[$name]) && $_REQUEST[$name] ) {
            return 't';
        }
        
        if ( isset ($_REQUEST[$name]) ) {
            return 'f';
        }
        
        return $default;
    }
    
}