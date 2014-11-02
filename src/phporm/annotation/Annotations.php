<?php

namespace phporm\annotation;

use \ReflectionClass;

class Annotations {

   private $class_annotation;
   private $prop_annotations;
   private $properties;

   public function __construct($object) {
      $metadata = new ReflectionClass($object);
      $this->class_annotation = Annotation::getAnnotation($metadata->getDocComment());
      $this->properties = $metadata->getProperties();

      $arr = array();
      foreach($this->properties as $prop) {
         $comment = $prop->getDocComment();

         if($comment) {
            $annotation = Annotation::getAnnotation($comment);

            if($annotation) {
               $arr[$prop->getName()] = $annotation;
            }
         }
      }

      $this->prop_annotations = $arr;
   }

   public function __get($prop_name) {
      if($this->hasAnnotation($prop_name)) {
         return $this->prop_annotations[$prop_name];
      }

      return null;
   }

   public function hasAnnotation($prop_name) {
      return array_key_exists($prop_name, $this->prop_annotations);
   }

   public function getClassAnnotation() {
      return $this->class_annotation;
   }

   public function getPropAnnotations() {
      return $this->prop_annotations;
   }

   public function getProperties() {
      return $this->properties;
   }
}