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
    function laundryListView($id){
       $list=DB::table('laundrylist')->select('*')
            ->where('id',$id)->get();
        foreach($list as $row){
            $data=array(
                'guid'=>$row->gid,
                 'timespent'=>$row->timespent,
                 'totalprice'=>$row->totalprice,
                 'roomID'=>$row->roomId,
                'choose'=>$row->choose,
                'remain'=>$row->remain
            );
        }
          $data['gid']=$id;
        return View::make("laundries.shw",$data);
    }
  function laundryEditView($id){
      $list=DB::table('laundrylist')->select('*')
          ->where('id',$id)->get();
      foreach($list as $row){
          $data=array(
              'guid'=>$row->gid,
              'timespent'=>$row->timespent,
              'totalprice'=>$row->totalprice,
              'roomID'=>$row->roomId,
              'choose'=>$row->choose,
              'remain'=>$row->remain
          );
      }
      $data['gid']=$id;
      return View::make("laundries.shw1",$data);
  }

	public function gllists(){
		return View::make('laundries.alix');
	}

	public function glist(){
		$inputs = Input::all();
		$n = Glist::where('gid', $inputs['gid'])
            ->where('date',date('Y-m-d'))->count();
		if($n == 0){
            if($inputs['opt']=='Credit'){
			Glist::create(array(
						"gid"=> $inputs['gid'],
						"timespent"=>$inputs['t'],
						"totalprice"=>$inputs['to'],
						"date"=>date('Y-m-d'),
                        "roomId"=>Guest::find($inputs['gid'])->room_number,
                        "remain"=>$inputs['remain']
				));

			$g = Guest::find($inputs['gid']);
			$g->llist  = "no";
			$g->save();
			return "ok";
            }else{
                Glist::create(array(
                    "gid"=> $inputs['gid'],
                    "timespent"=>$inputs['t'],
                    "totalprice"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "roomId"=>Guest::find($inputs['gid'])->room_number
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
                "totalprice"=>$inputs['to'],
                "date"=>date('Y-m-d'),
                "roomId"=>Guest::find($inputs['gid'])->room_number,
                "remain"=>$inputs['remain']
            );
            Glist::where('gid',$inputs['gid'])->update($data_array);
            $g = Guest::find($inputs['gid']);
            $g->llist  = "no";
            $g->save();
            return "ok";
            }else{
                  $data_array=array(
                    "gid"=> $inputs['gid'],
                    "timespent"=>$inputs['t'],
                    "totalprice"=>$inputs['to'],
                    "date"=>date('Y-m-d'),
                    "roomId"=>Guest::find($inputs['gid'])->room_number
                );
                Glist::where('gid',$inputs['gid'])->update($data_array);
                $g = Guest::find($inputs['gid']);
                $g->llist  = "yes";
                $g->save();
                return "ok";
            }
        }
	}
    function checkEditSum($amount,$id){
        $cost=Glist::find($id)->remain;
        $total=Glist::find($id)->totalprice;
        if($amount>=$cost){
            $data_array=array(
                'totalprice'=>$total+$amount,
                 'remain'=>$amount-$cost
            );
         DB::table('laundrylist')->where('id',$id)->update($data_array);
         $g = Guest::find($id);
         $g->llist  = "yes";
         $g->save();
         return "ok";
        }else{
            $data_array=array(
                'totalprice'=>$total+$amount,
                'remain'=>$amount-$cost
            );
            DB::table('laundrylist')->where('id',$id)->update($data_array);
            $g = Guest::find($id);
            $g->llist  = "no";
            $g->save();
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

		$l      = Llist::whereRaw('item = ? and counttype = ? and gid = ? and category = ?', array($item,$count,$gid,$cate))->count();
		if($l == 0){
			$list   = Llist::create(array(
						"gid"=>$gid,
						"item"=>$item,
						"counttype"=>$count,
						"category"=>$cate,
						"cvalue"=>$cvalue
				));
		}else{
			$ls          = Llist::whereRaw('item = ? and counttype = ? and gid = ? and category = ?', array($item,$count,$gid,$cate))->first();
			$ls->cvalue  = $cvalue;
			$ls->save();
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
