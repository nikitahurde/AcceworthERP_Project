<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    //
    function getData($cond=""){

      $this->db->select("dp.*,dm.depot_name,ma.acc_name");
      $this->db->from("despatch as dp");
      $this->db->join("master_depot as md","md.depot_code = dp.depot","left");
      $this->db->join("master_acc as ma","ma.acc_code = dp.party","left");
       $this->db->where($cond);
      return $this->db->get();
    }
}
