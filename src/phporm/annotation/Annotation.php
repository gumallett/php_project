<?php

namespace phporm\annotation;

class Annotation {

   private $name;
   private $props = array();

   private function __construct($name, $props = array()) {
      $this->name = $name;
      $this->props = $props;
   }

   public function getName() {
      return $this->name;
   }

   public function getProps() {
      return $this->props;
   }

   public function __get($key) {
      if($this->hasProp($key)) {
         return $this->props[$key];
      }

      return null;
   }

   public function hasProp($key) {
      return array_key_exists($key, $this->props);
   }

   public static function getAnnotation($docComment) {
      $docComment = self::trimComment($docComment);

      $lines = preg_split('/$\R?^/m', $docComment);
      $annotations = array();

      if($lines) {
         foreach($lines as $line) {
            $annotation = self::getSingleAnnotation($line);

            if($annotation) {
               $annotations[] = $annotation;
            }
         }

         switch(count($annotations)) {
            case 0:
               return null;
            case 1:
               return $annotations[0];
            default:
               return $annotations;
         }
      }

      return null;
   }

   private static function trimComment($docComment) {
      $docComment = trim($docComment, '/*');
      $docComment = trim($docComment);
      $docComment = trim($docComment, '* ');

      return $docComment;
   }

   private static function parseProps($props) {
      $props_arr = array();

      $props = trim($props, '()');
      $props = preg_split("/(,|\s)+/", $props);

      foreach($props as $prop) {
         $pair = explode('=', $prop);
         $props_arr[$pair[0]] = trim($pair[1], "\"'");
      }

      return $props_arr;
   }

   private static function getSingleAnnotation($docComment) {
      $docComment = self::trimComment($docComment);

      preg_match("/^\{@?(\w+)?(\(.+\))?/", $docComment, $matches);

      if(count($matches) > 0) {
         $name = $matches[1];

         $props_arr = array();

         if(count($matches) == 3) {
            $props_arr = self::parseProps($matches[2]);
         }

         return new Annotation($name, $props_arr);
      }

      return null;
   }
}