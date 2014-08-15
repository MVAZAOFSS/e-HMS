<?php
class AccountantController extends BaseController{
	public function income(){
		return View::make('accountant.income');
	}
	public function expenditure(){
		return View::make('accountant.expenditure');
	}
	public function report(){
		return View::make('accountant.report');
	}
        function report_display($income='',$date=''){
            if($income=='income'){
            $data1=  $this->foodTotal($income, $date);
            $data2=  $this->foodSales($income, $date);
            $data3=  $this->guestsold($income, $date);
            $data4=  $this->drinksales($income, $date);
            $data=$data1+$data2+$data3+$data4;
            return View::make('accountant.reportincome',$data);
        }elseif ($income=='expenditure') {
            $data=  $this->Total_expenditure($income, $date);
            return View::make('accountant.reportexpt',$data);
        }
        }
        function foodTotal($income,$date){
            if($income=='income'){
            $table=DB::table('foodbills')
                    ->where('date',$date)
                     ->get(array(
                         'amount',
                         DB::raw('SUM(foodbills.amount) AS amount')
                     ));
                     foreach ($table as $row){
                         $data_check=array(
                             'amount'=>$row->amount
                         );
                     }
                   return $data_check;
        }
        }
        function foodSales($income,$date){
            if($income=='income'){
                $table=DB::table('foodsales')
                        ->join('restaurants','restaurants.name','=','foodsales.food')
                        ->where('date',$date)
                        ->get(array(
                            'cost',
                            DB::raw('SUM(restaurants.cost) AS cost')
                        ));
                        foreach ($table as $row){
                            $data_array=array(
                                'salescost'=>$row->cost    
                            );
                        }
                        return $data_array;
            }
        }
        function guestsold($income,$date){
            if($income=='income'){
               $table=DB::table('guests')
                     ->join('rooms','rooms.id','=','guests.room_number')
                     ->where('checkin',$date)
                    ->get(array(
                        'cost',
                        DB::raw('SUM(rooms.cost) AS cost')
                    ));
                    foreach ($table as $row){
                        $data_array=array(
                            'roomscost'=>$row->cost
                        );
                    }
                    return $data_array;
            }
        }
        function drinksales($income,$date){
            if($income=='income'){
                $table=DB::table('drinksales')
                        ->join('bars','bars.name','=','drinksales.drink')
                        ->where('date',$date)
                        ->get(array(
                            'cost',
                            DB::raw('SUM(bars.cost) AS cost')
                        ));
                        foreach ($table as $row){
                            $data_array=array(
                                'barcost'=>$row->cost
                            );
                        }
                        return $data_array;
            }
        }
        function expenditure_insert(){
            $inputs=Input::all();
            $rules=array(
                'option'=>'required',
                'amount'=>'required|numeric',
                'date'=>'required'
            );
            $validator=Validator::make($inputs,$rules);
            if($validator->fails()){
                return View::make('accountant.expenditure')->withErrors($validator);
            }  else {
                $data_array=array(
                 'cost'=>Input::get('amount'),
                 'expenditure_name'=>Input::get('option'),
                 'expenditure_reasons'=>Input::get('other'),
                 'date'=>Input::get('date')
                 );
             $query=DB::table('expenditures')->where('date',Input::get('date'))->get();
             if($query){
             DB::table('expenditures')->where('date',Input::get('date'))->update($data_array);
             $data['sms']='<p class="alert alert-success">Expenditure recorded successifuly</p>';
                return View::make('accountant.expenditure',$data);
          }  else {
             DB::table('expenditures')->insert($data_array);
             $data['sms']='<p class="alert alert-success">Expenditure recorded successifuly</p>';
                return View::make('accountant.expenditure',$data);
         }
     }
    }
    function Total_expenditure($income,$date){
        if($income=='expenditure'){
            $res=DB::table('expenditures')
                     ->where('date',$date)
                    ->get(array(
                        'cost',
                        DB::raw('SUM(cost) AS cost')
                    ));
                    foreach ($res as $row){
                        $data_array=array(
                            'expcost'=>$row->cost
                        );
                    }
                    return $data_array;
        }
    }
}
               