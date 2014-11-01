<?php
/**
 * Created by PhpStorm.
 * User: mahane
 * Date: 9/25/14
 * Time: 11:55 AM
 */
class BillsBothController extends BaseController {
    function indexBoth(){
        return View::make('bills.indexBoth');
    }
    public function allsaleBoth(){
        return View::make('bills.allsalesBoth');
    }

    public function submitsaleBoth(){
       if(Auth::user()->role ==8){
            $inputs = Input::all();
            DrinkSales::create(array(
                "drink"=>$inputs['d'],
                "service"=>$inputs['t'],
                "date"=>date('Y-m-d'),
                "added_by"=>Auth::user()->id,
                "no_drinks"=>$inputs['idadi']
            ));

            $sales = DrinkSales::whereRaw('date = ? and service = ?', array(date('Y-m-d'), $inputs['t']))->get();
            return View::make('bills.saleshowBoth', compact('sales'));
        }
    }

    public function salesBoth(){
        return View::make('bills.salesBoth');
    }

    public function allBoth(){
        return View::make('bills.allBoth');
    }


    public function createBoth()
    {
        return View::make('bills.createBoth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeBoth()
    {
       if(Auth::user()->role == 8) {
            $inputs   = Input::all();
            $mode     = $inputs['c'];
            $guestid  = $inputs['gid'];
            $amount   = $inputs['a'];
            $stime    = $inputs['s'];
            $total    = $inputs['t'];

            $gbill    = Bil::whereRaw('guestid = ? and servicetime = ? and date = ?', array($guestid, $stime, date('Y-m-d')))->first();

            if($mode == "cash"){



                if($amount > $total){
                    return "no";
                }else{
                    $gbill->paymentmode = $mode;
                    $gbill->amount      = $amount;
                    $gbill->remain = (double)($total - $amount);
                    $gbill->cleared='yes';
                    $gbill->save();
                    return "ok";
                }

            }else{
                $gbill->paymentmode = $mode;
                $gbill->save();
                return "ok";
            }
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
        return View::make('bills.showBoth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return View::make('bills.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    public function loadbillBoth(){
        $bid = Input::get('id');
        if(Auth::user()->role == 8){
            $bi = 	Bil::find($bid);
        }
       return View::make('bills.createBoth', compact('bi'));
    }

    public function servicetimeBoth(){
        if(Auth::user()->role ==8){
            $s   = Input::get('s');
            $id  = Input::get('g');

            if($s != "all"){
                $bn = Bil::whereRaw('guestid=? and servicetime = ?', array($id, $s))->count();
                if($bn == 0){
                    return View::make('bills.create')->with('error', 'No result found ')->with('stime', Bill::tm($s))->with('g', $id);
                }else{
                    $bi = Bil::whereRaw('guestid=? and servicetime = ?', array($id, $s))->first();
                    return View::make('bills.create', compact('bi'));
                }
            }else{
                $bi = Bil::whereRaw('guestid=?', array($id))->get();
                return View::make('bills.historyBoth', compact('bi'));
            }
        }

    }

    public function updatebillBoth(){
       if(Auth::user()->role == 8){
            $id     	  = Input::get('g');
            $amount  	  = Input::get('a');
            $total   	  = Input::get('t');
            $stime   	  = Input::get('s');

            $bill   	  = Bil::find($id);
            $amo          = $bill->amount;
            $newamount    = $amount + $amo;

            if($total < $newamount){
                $bi           = Bil::find($id);
                return View::make('bills.createBoth', compact('bi'));

            }else if($total==$newamount){
                $bill->amount = $newamount;
                $bill->cleared='yes';
                $bill->remain = (double)($total - $newamount);
                $bill->save();
                $bi           = Bill::find($id);
                return View::make('bills.createBoth', compact('bi'));
            }else{

                $bill->amount = $newamount;
                $bill->remain = (double)($total - $newamount);
                $bill->save();
                $bi           = Bil::find($id);
                return View::make('bills.createBoth', compact('bi'));
            }
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
        //
    }

    public function submitBoth(){
        $inputs  = Input::all();
        if (Auth::user()->role == 8){

            $g       = $inputs['g'];
            $d       = $inputs['d'];
            $t       = $inputs['t'];
            $idadi   =$inputs['idadi'];
            $cost= Bar::where('name',$d)->first()->cost;
            $drink    = $d . ",";

            $start   = strpos($g, "(") + 1;
            $end     = -1;
            $room    = substr($g, $start, $end);

            $roomid  = Room::where('name', $room)->first()->id;
            $guest   = Guest::whereRaw('room_number = ? and checked = "no" and released ="no" and cancelled="no" ', array($roomid))->first();

            $gid     = $guest->id;

            $b       = Bil::whereRaw('guestid=? and servicetime=? and date = ?', array($gid, $t, date('Y-m-d')))->count();

            $lg      = Auth::user()->id;

            if($b == 0){

                $bill    = Bil::create(array(
                    "guestid"=>$gid,
                    "drinks"=>$drink,
                    "servicetime"=>$t,
                    "added_by"=>$lg,
                    "date"=>date('Y-m-d'),
                    "remain"=>$cost,
                    "no_drinks"=>$idadi
                ));


            }else{

                $bil        = Bil::whereRaw('guestid=? and servicetime=? and date =? ', array($gid, $t, date('Y-m-d')))->first();
                $drinks      = $bil->drinks;
                $idadis      =$bil->no_drinks;
                $newdrinks   = $drinks . $drink ;
                $bil->drinks = $newdrinks;
                $bil->no_drinks =$idadis+$idadi;
                $bil->remain=  $bil->remain+$cost;
                $bil->save();



            }

            $bi = Bil::whereRaw('guestid=? and servicetime=?', array($gid, $t))->first();

            return View::make('bills.showBoth', compact('bi'));

        }
    }
    function billsprintbarBoth($id){
        $res=DB::table('barbills')->where('id',$id)->get();
        $pdf = PDF::loadView('bills.print_viewbarBoth',compact('res'));
        return $pdf->stream();
    }
    function sellsprintbarzBoth($id){
        $res=DB::table('drinksales')
            ->join('bars','bars.name','=','drinksales.drink')
            ->where('drinksales.id',$id)->get();
        $pdf=PDF::loadView('bills.print_sellsbarzBoth',  compact('res'));
        return $pdf->stream();
    }
}

