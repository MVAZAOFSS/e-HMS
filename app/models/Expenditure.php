<?php
 class Expenditure extends Eloquent{
     public function __construct() {
         
     }
     function insert_exp($expinfo,$expendresons,$amount,$date){
         $data_array=array(
                 'cost'=>$amount,
                 'expenditure_name'=>$expinfo,
                 'expenditure_reasons'=>$expendresons,
                 'date'=>$date
                 );
         $query=DB::table('expenditures')->where('date',$date)->get();
         if($query){
             foreach ($query as $row){
                 $data=array(
                     'cost'=>$row->cost+$amount,
                     'expenditure_name'=>$expinfo,
                     'expenditure_reasons'=>$expendresons,
                     'date'=>$date
                 );
             }
             DB::table('expenditures')->where('date',$date)->update($data);
         }  else {
             DB::table('expenditures')->insert($data_array);
         }
     }
 }

