<?php

if(!function_exists('convert_rupiah')) {
   function convert_rupiah($value) {
      $hasil_rupiah = "Rp " . number_format($value,2,',','.');
      return $hasil_rupiah;
   }
}

?>