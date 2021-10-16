<?php
/**
 * This class will only hold the parameters to the request
 * @author Sahil Gulati <sahil.gulati1991@outlook.com>
 */
namespace APIBase;

class Parameters {
    /**
     * @var Array GET Parameters as well as Separator parameters 
     */
    public static $GETVARS=array();
    /**
     * @var Array POST Parameters 
     */
    public static $POSTVARS=array();
    /**
     * @var Array FILE Parameters 
     */
    public static $FILEVARS=array();

    /**
     * This function will be responsible for
     * registering page variables
     */
    public static function setPageVariables() {
        $requestUri = $_SERVER["REQUEST_URI"];
        $urlParameters=parse_url($requestUri);
        list(
            self::$GETVARS["complete_request_uri"],
            self::$GETVARS["query_string"]) = 
        array(
            $urlParameters["path"],
            @$urlParameters["query"]
        );
        self::$GETVARS["complete_request_uri"]=rtrim(self::$GETVARS["complete_request_uri"],"/");
        self::$GETVARS["request_uri"]=$urlParameters["path"];
        @parse_str(self::$GETVARS["query_string"], $params);
        self::$GETVARS=array_merge(self::$GETVARS,$params);
        self::$GETVARS=array_merge(self::$GETVARS,$_GET);
        self::$POSTVARS=$_POST;
        self::$FILEVARS=$_FILES;
        self::$COOKIEVARS=$_COOKIE;
    }
}