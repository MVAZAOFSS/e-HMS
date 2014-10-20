<?php

class LaundriesController extends BaseController {



	public function __construct(){
		$this->beforeFilter('auth', array('*'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function viewlist(){
		$id     =  Input::get('id');
		$list   =  Glist::find($id);
		$lists  =  Llist::where('gid', $id)->get();
		$gid    =  $id;
		return View::make("laundries.shw", compact('gid'))->with('list', $list);
	}

	public function viewlist1(){
		$id     =  Input::get('id');
		$list   =  Glist::find($id);

		$gid    =  $id;
		return View::make("laundries.shw1", compact('gid'))->with('list', $list);
	}
    function laundryListView($id,$date){
       $list=DB::table('laundrylist')->select('*')
            ->where('id',$id)->where('date',$date)->get();
        foreach($list as $row){
            $data=array(
                'guid'=>$row->gid,
                 'timespent'=>$row->timespent,
                'totalpiece'=>$row->totalpiece,
                'totalprice'=>$row->totalprice,
                 'roomID'=>$row->roomId,
                'choose'=>$row->choose,
                'remain'=>$row->remain,
                'date'=>$row->date,
                'money_mode'=>$row->money_mode,
                'payment_mode'=>$row->payment_mode
            );
        }
          $data['gid']=$id;
        return View::make("laundries.shw",$data);
    }
  function laundryEditView($id,$date){
      $list=DB::table('laundrylist')->select('*')
          ->where('id',$id)->where('date',$date)->get();
      foreach($list as $row){
          $data=array(
              'guid'=>$row->gid,
              'timespent'=>$row->timespent,
              'totalpiece'=>$row->totalpiece,
              'totalprice'=>$row->totalprice,
              'roomID'=>$row->roomId,
              'choose'=>$row->choose,
              'remain'=>$row->remain,
              'date'=>$row->date,
              'money_mode'=>$row->money_mode,
              'payment_mode'=>$row->payment_mode
          );
      }
      $total=Glist::find($id)->totalprice;
      $cost=Glist::find($id)->remain;
      if($total==$cost){
          DB::table('laundrylist')->where('id',$id)->update(array('payment_mode'=>'paid'));
          $data['gid']=$id;
          return View::make("laundries.laundryPay",$data);
      }else{
          $data['gid']=$id;
          return View::make("laundries.laundryPay",$data);
      }

  }
    function laundryListViewSales($id,$date,$name){
        $list=DB::table('customerCost')->select('*')
            ->where('id',$id)->where('date',$date)->where('customerName',$name)->get();
        foreach($list as $row){
            $data=array(
                'name'=>$row->customerName,
                'timespent'=>$row->timespent,
                'totalpiece'=>$row->totalpiece,
                'totalprice'=>$row->totalprice,
                'choose'=>$row->choose,
                'date'=>$row->date,
                'money_mode'=>$row->money_mode,
                'payment_mode'=>$row->payment_mode
            );
        }
        $data['gid']=$id;
        return View::make("laundries.shwSales1",$data);
    }

    function laundryEditViewSales($id,$date,$name){
        $list=DB::table('customerCost')->select('*')
            ->where('id',$id)->where('date',$date)->where('customerName',$name)->get();
        foreach($list as $row){
            $data=array(
                'name'=>$row->customerName,
                'timespent'=>$row->timespent,
                'totalpiece'=>$row->totalpiece,
                'totalprice'=>$row->totalprice,
                'remain'=>$row->remain,
                'choose'=>$row->choose,
                'date'=>$row->date,
                'money_mode'=>$row->money_mode,
                'payment_mode'=>$row->payment_mode
            );
        }
        $total=Customer::find($id)->totalprice;
        $cost=Customer::find($id)->remain;
        if($total==$cost){
            DB::table('customerCost')->where('id',$id)->update(array('payment_mode'=>'paid'));
         $data['gid']=$id;
         return View::make("laundries.shwSales",$data);
        }else{
            $data['gid']=$id;
            return View::make("laundries.shwSales",$data);
        }
    }

	public function gllists(){
		return View::make('laundries.alix');
	}

	public function glist(){
		$inputs = Input::all();
		$n = Glist::where('gid', $inputs['gid'])
            ->where('date',date('Y-m-d'))->count();
		if($n==0){
            if($inputs['opt']=='Credit'){
			Glist::create(array(
						"gid"=> $inputs['gid'],
						"timespent"=>$inputs['t'],
						"totalpiece"=>$inputs['to'],
						"date"=>date('Y-m-d'),
                        "choose"=>$inputs['v'],
                        "roomId"=>Guest::find($inputs['gid'])->room_number,
                        "money_mode"=>$inputs['opt'],
                        "payment_mode"=>'no'
				));

			$g = Guest::find($inputs['gid']);
			$g->llist  = "no";
			$g->save();
			return "ok";
            }else{
                Glist::create(array(
                    "gid"=> $inputs['gid'],
                    "timespent"=>$inputs['t'],
                    "totalpiece"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "choose"=>$inputs['v'],
                    "roomId"=>Guest::find($inputs['gid'])->room_number,
                    "money_mode"=>$inputs['opt'],
                    "payment_mode"=>'paid'
                ));
                $g = Guest::find($inputs['gid']);
                $g->llist  = "yes";
                $g->save();
                return "ok";
            }

		}else{
            if($inputs['opt']=='Credit'){
            $data_array=array(
                "gid"=> $inputs['gid'],
                "timespent"=>$inputs['t'],
                "totalpiece"=>$inputs['to'],
                "date"=>date('Y-m-d'),
                "choose"=>$inputs['v'],
                "roomId"=>Guest::find($inputs['gid'])->room_number,
                "money_mode"=>$inputs['opt'],
                "payment_mode"=>'no'
            );
            Glist::where('gid',$inputs['gid'])->where('date',date('Y-m-d'))->update($data_array);
            $g = Guest::find($inputs['gid']);
            $g->llist  = "no";
            $g->save();
            return "ok";
            }else{
                  $data_array=array(
                    "gid"=> $inputs['gid'],
                    "timespent"=>$inputs['t'],
                    "totalpiece"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "choose"=>$inputs['v'],
                    "roomId"=>Guest::find($inputs['gid'])->room_number,
                    "money_mode"=>$inputs['opt'],
                    "payment_mode"=>'paid'
                );
                Glist::where('gid',$inputs['gid'])->where('date',date('Y-m-d'))->update($data_array);
                $g = Guest::find($inputs['gid']);
                $g->llist  = "yes";
                $g->save();
                return "ok";
            }
        }
	}
    function laundryConfirmation(){
        $input=Input::all();
        $amount=$input['amount'];
        $gid=$input['gid'];
        $res=DB::table('laundrylist')->select('*')
            ->where('id',$gid)->get();
        if($res){
          DB::table('laundrylist')->where('id',$gid)->update(array('totalprice'=>$amount));
             echo '<p class="alert alert-success"> Laundry confirmed</p>';

        }
    }
    function laundryConfirmationSales(){
        $input=Input::all();
        $amount=$input['amount'];
        $name=$input['name'];
        $res=DB::table('customerCost')->select('*')
            ->where('customerName',$name)->get();
        if($res){
            DB::table('customerCost')->where('customerName',$name)->update(array('totalprice'=>$amount));
            echo '<p class="alert alert-success"> Laundry confirmed</p>';

        }
    }
    function checkEditSum(){
        $input=Input::all();
        $id=$input['gid'];
        $guid=$input['guid'];
        $amount=$input['remain'];
        $cost=Glist::find($id)->remain;
        $total=Glist::find($id)->totalprice;
        if($cost ==$total){
            $data_array=array(
                'remain'=>$amount+$cost,
                'payment_mode'=>'paid'
            );
         DB::table('laundrylist')->where('id',$id)->update($data_array);
         $g = Guest::find($guid);
         $g->llist  = "yes";
         $g->save();
         return "ok";
        }elseif($amount >$total){
            echo'<p class="alert alert-warning"> That amount is large than the expected</p>';

        }else{
            $data_array=array(
                'remain'=>$amount+$cost,
                'payment_mode'=>'no'
            );
            DB::table('laundrylist')->where('id',$id)->update($data_array);
            $g = Guest::find($guid);
            $g->llist  = "no";
            $g->save();
            return "ok";
        }
}
    function checkEditSumSalesAction(){
        $input=Input::all();
        $id=$input['gid'];
        $amount=$input['remain'];
        $cost=Customer::find($id)->remain;
        $total=Customer::find($id)->totalprice;
        if($total ==$cost){
            $data_array=array(
                'remain'=>$amount+$cost,
                'status'=>'yes',
                'payment_mode'=>'paid'
            );
            DB::table('customerCost')->where('id',$id)->update($data_array);
            return "ok";
        }elseif($amount >$total){
            echo'<p class="alert alert-warning"> That amount is large than the expected</p>';

        }else{
            $data_array=array(
                'remain'=>$cost+$amount,
                'payment_mode'=>'no'
            );
            DB::table('customerCost')->where('id',$id)->update($data_array);
            return "ok";
        }
    }

	public function llist(){
		$inputs = Input::all();
		$item   = $inputs['i'];
		$count  = $inputs['c'];
		$cate   = $inputs['cate'];
		$cvalue = $inputs['cv'];
		$gid    = $inputs['gid'];

		$l= Llist::whereRaw('item = ? and counttype = ? and gid = ? and category = ? and date =?', array($item,$count,$gid,$cate,date('Y-m-d')))->count();
		if($l == 0){
			 Llist::create(array(
						"gid"=>$gid,
						"item"=>$item,
						"counttype"=>$count,
						"category"=>$cate,
						"cvalue"=>$cvalue,
                        "date"=>date('Y-m-d')
				));
		}else{
			$ls= Llist::whereRaw('item = ? and counttype = ? and gid = ? and category = ? and date =?', array($item,$count,$gid,$cate,date('Y-m-d')))->first();
			$ls->cvalue  = $cvalue;
			$ls->save();
		}

	}
    public function customerListAction(){
        $inputs = Input::all();
        $item   = $inputs['i'];
        $count  = $inputs['c'];
        $cate   = $inputs['cate'];
        $cvalue = $inputs['cv'];
        $name   = $inputs['name'];

        $l= CustomerList::whereRaw('item = ? and counttype = ? and name = ? and category = ? and date =?', array($item,$count,$name,$cate,date('Y-m-d')))->count();
        if($l == 0){
            CustomerList::create(array(
                "name"=>$name,
                "item"=>$item,
                "counttype"=>$count,
                "category"=>$cate,
                "cvalue"=>$cvalue,
                "date"=>date('Y-m-d')
            ));
        }else{
            $ls= CustomerList::whereRaw('item = ? and counttype = ? and name = ? and category = ? and date =?', array($item,$count,$name,$cate,date('Y-m-d')))->first();
            $ls->cvalue  = $cvalue;
            $ls->save();
        }

    }
    public function customersAction(){
        $inputs = Input::all();
        $n = Customer::where('customerName', $inputs['name'])
            ->where('date',date('Y-m-d'))->count();
        if($n==0){
            if($inputs['opt']=='Credit'){
                Customer::create(array(
                    "customerName"=> $inputs['name'],
                    "timespent"=>$inputs['t'],
                    "totalpiece"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "choose"=>$inputs['v'],
                    "money_mode"=>$inputs['opt'],
                    "payment_mode"=>'no'
                ));

              }else{
                Customer::create(array(
                    "customerName"=> $inputs['name'],
                    "timespent"=>$inputs['t'],
                    "totalpiece"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "choose"=>$inputs['v'],
                    "status"=>'yes',
                    "money_mode"=>$inputs['opt'],
                    "payment_mode"=>'paid'
                ));

            }

        }else{
            if($inputs['opt']=='Credit'){
                $data_array=array(
                    "customerName"=> $inputs['name'],
                    "timespent"=>$inputs['t'],
                    "totalpiece"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "choose"=>$inputs['v'],
                    "money_mode"=>$inputs['opt'],
                    "payment_mode"=>'no'
                );
                Customer::where('customerName',$inputs['name'])->where('date',date('Y-m-d'))->update($data_array);

            }else{
                $data_array=array(
                    "customerName"=> $inputs['name'],
                    "timespent"=>$inputs['t'],
                    "totalpiece"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "choose"=>$inputs['v'],
                    'status'=>'yes',
                    "money_mode"=>$inputs['opt'],
                    "payment_mode"=>'paid'
                 );
                Customer::where('customerName',$inputs['name'])->where('date',date('Y-m-d'))->update($data_array);

            }
        }
    }

	public function index()
	{
		$laundries = Laundrie::all();
        return View::make('laundries.index', compact('laundries'));
	}

	public function listgl(){
		return View::make('laundries.list');
	}
    function listSalesLaundry(){
        return View::make('laundries.listsales');
    }
    function getSalesLaundryAction(){
      return View::make('laundries.allSalesLaundry');
    }
    function customerEditFormAction(){
        $input=Input::all();
        $data['name']=$input['name'];
         return View::make('laundries.customerForm',$data);
    }
	public function plistgl(){
		$inputs  = Input::all();
		$g       = $inputs['g'];
		if($g != ""){

				$start   = strpos($g, "(") + 1;
				$end     = -1;	
				$room    = substr($g, $start, $end);

				$roomid  = Room::where('name', $room)->first()->id;
				$guest   = Guest::whereRaw('room_number = ? and checked = "no" and released="no" and cancelled="no" ', array($roomid))->first();
						
				$gid     = $guest->id;

				return View::make('laundries.show', compact('gid'));
				
				
		}else{
			return "<div class='alert alert-danger'> <span class='glyphicon glyphicon-info-sign'></span> Make you have enter the correct guest, </div>";
		}
		

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('laundries.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$laundry = Laundrie::whereRaw('name = ? and  category = ?', array($inputs['name'], $inputs['category'] ))->count();
		if($laundry == 0){
			$r = Laundrie::create($inputs);
			return View::make('laundries.create')->with('msg', 'Successfully, added ');
		}else{
			return View::make('laundries.create')->with('emsg', 'Item exists! please choose another');
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('laundries.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$laundry = Laundrie::find($id);
        return View::make('laundries.edit', compact('laundry'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$laundry   = Laundrie::find($id);
		$inputs = Input::all();
		$name = $laundry->name;
		if($name != $inputs['name']){
			$r = Laundrie::whereRaw('name = ? and category = ?', array($inputs['name'],$inputs['category'] ))->count();
			if($r==0){
				$laundry->name = $inputs['name'];
				$laundry->cost = $inputs['cost'];
				$laundry->category = $inputs['category'];
				$laundry->save();
				return View::make('laundries.edit', compact('laundry'))->with('msg', 'Successfully updated');
			}else{
				return View::make('laundries.edit', compact('laundry'))->with('emsg', 'Item exists');
			}
		}else{
				$laundry->name = $inputs['name'];
				$laundry->cost = $inputs['cost'];
				$laundry->category = $inputs['category'];
				$laundry->save();
				return View::make('laundries.edit', compact('laundry'))->with('msg', 'Successfully updated');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$l = Laundrie::find($id);
		$l->delete();
	}

}
