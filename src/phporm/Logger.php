<?php

namespace phporm;
/**
 * Simple logging
 */
final class Logger {

   public static function log($message) {
      if(is_array($message)) {
         $msg = "Keys: " . implode(', ', array_keys($message));
         $msg .= " Values: " . implode(', ', array_values($message));
         $message = $msg;
      }

       if($message instanceof \DateTime) {
           file_put_contents("php://stderr", $message->format(\DateTime::ATOM)."\n");
       }
       else {
           file_put_contents("php://stderr", $message."\n");
       }
   }
}
