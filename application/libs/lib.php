<?php

class Lib{
    
    static $css_path;
    static $image_path;
    static $file_path;
    static $javascript_path;
    static $google_analytics_account;
    static $site;
    static $notAllowedExtensions = array('.sh','.php','.sql','.exe','.asp','.bat','.ini','.css','.js');
        
    public static function getCssPath(){
        return self::$site . self::$css_path;
    }//end getCssPath
    
    public static function getFilePath(){
        return self::$site . self::$file_path;
    }//end getFilePath
    
    public static function getGoogleAnalyticsAccount(){
        return self::$google_analytics_account;
    }//endGoogleAnalyticsAccount
    
    public static function getImagePath(){
        return self::$site . self::$image_path;
    }//end getImagePath
    
    public static function getJavascriptPath(){
        return self::$site . self::$javascript_path;
    }//end getJavascriptPath
    
    public static function getNotAllowedExtensions(){
        return self::$notAllowedExtensions;
    }//return getNotAllowedExtensions
    
    public static function getSite(){
        return self::$site;
    }//end getSite
    
    public static function getRootPath(){
        return $_SERVER['Documet.root'] . '/';
    }//end getSitePath
    
    public static function getGoogleAnalytics(){
        $google_analytics = <<< GACODE
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-{ga_account}']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
GACODE;
        
         $google_analytics = str_replace('{ga_account}',self::$google_analytics_account,$google_analytics);   

         return $google_analytics;
         
    }//end getGoogleAnalitycs
    
    public static function loadJavascriptCode($src=''){
        return '<script type="text/javascript" src="' . $src . '">';
    }
    
    public static function mailValidator($mail){
        if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$mail)) {
            return true;
        }
        return false;
    }//end mailValidator
        
    public static function setCssPath($css_path){
        self::$css_path = $css_path;
    }//end setCssPath
    
    public static function setDefaultInitConfiguration($timeZone='Etc/GMT+3'){
        date_default_timezone_set($timeZone);        
    }//end setDefaultInitConfiguration
    
    public static function setFilePath($file_path){
        self::$file_path = $file_path;
    }//end setFilePath
    
    public static function setGoogleAnalyticsAccount($account){
        self::$google_analytics_account = $account;
    }//end setGoogleAnalyticsAccount
    
    public static function setJavascriptPath($javascript_path){
        self::$javascript_path = $javascript_path;
    }//end setJavascriptPath
    
    public static function setImagePath($image_path){
        self::$image_path = $image_path;
    }//end setImagePath
    
    public static function printImage($image){
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . self::$site . $image)){
            echo '<img src="' . $_SERVER['DOCUMENT_ROOT'] . '/' . self::$site . $image . '" />';
        }else{
            echo '<img src="' . self::$image_path . 'none.jpg" />';
        }
    }//end printImage
    
    public static function setNotAllowedExtensions($notAllowedExtensions){
        self::$notAllowedExtensions = $notAllowedExtensions;
    }//return setNotAllowedExtensions
    
    public static function setSite($site){
        self::$site = $site . '/';
    }//end setSite

    
}
?>
