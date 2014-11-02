<?php

namespace phporm;

use phporm\annotation\Annotations;

class TableModel {

   private $RELATIONSHIPS = array('ManyToOne', 'OneToOne', 'OneToMany');

   private $attributes = array();
   private $relations = array();
   private $relation_types = array();

   private $record;
   //private $record_class;
   private $table_name;
   private $table_id;

   public function __construct(Record $object) {
      $this->table_name = static::determineTableName($object);
      $this->table_id = $object->getId();
      $this->record = $object;

      $annotations = new Annotations($object);

      foreach($annotations->getProperties() as $prop) {
         $prop->setAccessible(true);

         $col_name = $prop->getName();
         $value = $prop->getValue($object);

         if($annotations->hasAnnotation($col_name)) {
            $annotation = $annotations->$col_name;
            $anno_name = $annotation->getName();

            switch($anno_name) {
               case 'ManyToOne':
               case 'OneToOne':
                  $foreign_key = $annotation->column;

                  $foreign_key = $foreign_key ? $foreign_key : $col_name . '_id';
                  $required = $annotation->hasProp('required') ? $annotation->required : false;

                  if($value) {
                     if($value instanceof Record) {
                        $this->relations[$foreign_key] = new TableModel($value);
                        $value = $value->getId(); //placeholder id;
                     }

                     //probably an id?
                  }
                  else {

                  }

                  $this->relation_types[$col_name] = $annotation;
                  $this->attributes[$foreign_key] = $value;
                  break;

               case 'OneToMany':
                  $this->relation_types[$col_name] = $annotation;
                  break;

               //TODO: handle other anno types here
            }
         }
         else {
            if($col_name != 'id') {
               $this->attributes[$col_name] = $value;
            }
         }
      }
   }

   public function getAttributes() {
      return $this->attributes;
   }

   public function getAttributeNames() {
      return array_keys($this->attributes);
   }

   public function getAttributeValues() {
      return array_values($this->attributes);
   }

   public function getRelations() {
      return $this->relations;
   }

   public function getTableId() {
      return $this->table_id;
   }

   public function getTableName() {
      return $this->table_name;
   }

   public function getRecordClass() {
      return $this->record_class;
   }

   public function fetchEager() {
      foreach($this->relation_types as $col_name => $annotation) {
         $name = $annotation->getName();

         switch($name) {
            case 'OneToOne':
            case 'ManyToOne':
               //this works because mysqli->fetchObject() sets properties that may not exist in the class def, but are
               //returned from the query anyway, in this case foreign key names. May change.
               $foreign_key = $annotation->column;
               $foreign_key = $foreign_key ? $foreign_key : $col_name . '_id';

               $id = $this->record->$foreign_key;

               $class = $annotation->class;

               if(!$class) {
                  $class = self::getClassName($col_name);
               }

               $class = 'model\\' . $class;

               if($id) {
                  $found_record = $class::find("id=$id");
                  $setter = self::getSetter($col_name);
                  $this->record->$setter($found_record);
               }

               break;
            case 'OneToMany':
               $class = $annotation->class;

               if(!$class) {
                  $class = self::getClassName($col_name);
               }

               $class = 'model\\' . $class;
               $key = $annotation->key;


               $found_records = $class::findAll("$key=" . $this->record->getId());
               $setter = self::getSetter($col_name);
               $this->record->$setter($found_records);
         }
      }

      return $this->record;
   }

   public function doInsert() {
      $dao = DAO::get();
      $self = $this;

      return $dao->doInTransaction(function() use($self) {
         return $self->insertHelper();
      });
   }

   public function doUpdate() {
      $dao = DAO::get();
      $self = $this;

      return $dao->doInTransaction(function() use($self) {
         return $self->insertHelper(true);
      });
   }

   public function insertHelper($update = false) {
      $dao = DAO::get();

      foreach($this->relations as $col_name => $relation) {
         $success = $relation->insertHelper();
         $this->attributes[$col_name] = $relation->getTableId();

         if(!$success) {
            return false;
         }
      }

      if($this->table_id == null) {
         $insertedId = -1;
         $success = $dao->executeInsert($this->getInsertSql(), $this->attributes, $insertedId);

         if($success) {
            $this->updateId($insertedId);
         }
      }
      else {
         //TODO: Add updating.

         if($update) {
            $success = $dao->executeQuery($this->getUpdateSql(), $this->attributes);
         }
         else {
            $success = true;
         }
      }

      return $success;
   }

   private function updateId($id) {
      $this->record->setId($id);
      $this->table_id = $id;
   }

   private function getInsertSql() {
      $colNames = implode(',', $this->getAttributeNames());
      $tableName = $this->table_name;
      $placeholder = $this->getPlaceHolderStr();

      return "insert into $tableName ($colNames) values ($placeholder)";
   }

   private function getUpdateSql() {
      $sql = 'update '.$this->table_name.' set ';

      foreach($this->getAttributeNames() as $name) {
         $sql .= "$name=:$name";
         $sql .= ',';
      }

      $sql = rtrim($sql, ',');

      $sql .= ' where id=' . $this->table_id;
      return $sql;
   }

   private function getPlaceHolderStr() {
      $str = '';

      foreach($this->getAttributeNames() as $name) {
         $str .= ":$name,";
      }

      return rtrim($str, ',');
   }

   /**
    * Guesses the setter method given a property name.
    */
   private static function getSetter($prop_name) {
      $idx = stripos($prop_name, '_');
      $setter = 'set';

      if($idx) {
         $parts = explode('_', $prop_name);
         foreach($parts as $part) {
            $setter .= ucfirst($part);
         }
      }
      else {
         $setter .= ucfirst($prop_name);
      }

      //\Logger::log($setter);
      return $setter;
   }

   /**
    * Guesses the entity class name from a property field that the field refers to
    */
   private static function getClassName($prop_name) {
      $prop_name = preg_replace('/s$/', '', $prop_name);
      $idx = stripos($prop_name, '_');
      $class_name = '';

      if($idx) {
         $parts = explode('_', $prop_name);
         foreach($parts as $part) {
            $class_name .= ucfirst($part);
         }
      }
      else {
         $class_name .= ucfirst($prop_name);
      }

      //\Logger::log($class_name);
      return $class_name;
   }

   private static function determineTableName($record) {
      $annotations = new Annotations($record);

      $classAnnotation = $annotations->getClassAnnotation();

      Logger::log($classAnnotation->getName() . " " . $classAnnotation->name);
      if($classAnnotation->getName() == 'Table') {
         return $classAnnotation->name;
      }

      return '';
   }
}