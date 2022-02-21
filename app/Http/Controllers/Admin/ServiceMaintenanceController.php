<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Item;
use App\Models\Report;
use App\Models\Service;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ServiceMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenances=Maintenance::orderBy('created_at', 'desc')->get();
        return view('Admin.serviceMaintenance.index',compact('maintenances'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $items = Item::join('inventory_item','inventory_item.item_id','=','items.id')
        ->where('inventory_item.quantity','!=',0)->select('items.*')->get();
        $cars=Car::all();
        $services=Service::all();
        $categories=Category::all();
        $subcategories=SubCategory::all();

        $subcategories=SubCategory::all();
        return view('Admin.serviceMaintenance.create', compact('customers', 'items','cars','services','categories','subcategories'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //dd($request->input('item_id'));
        $subTotal=0;
        $tax=0;
        $total=0;
        $SRsubTotal=0;
        $SRtax=0;
        $SRtotal=0;
        $IsubTotal=0;
        $Itax=0;
        $Itotal=0;
        //dd($request->input('item_id'));
        $maintenance =new Maintenance;
        $maintenance->car_id=$request->input('car_id');
        $maintenance->entrance_date=$request->input('entrance_date');
        $maintenance->duration=$request->input('duration');
        $maintenance->delivery_date=$request->input('delivery_date');
        $maintenance->comments=$request->input('comments');
        $maintenance->kms=$request->input('kms');

        $maintenance->user_id=auth()->user()->id;
        foreach ($request->input('service_id') as $key => $value){
            $service=Service::Find($value);
            foreach ($request->input('maintenanceKMs') as $index => $row) {
                if($key==$index){
                    $SRsubTotal= $service->cost;
                    $SRtax= $service->cost*$service->tax/100;
                    $SRtotal = $SRsubTotal + $SRtax;
                    $total+=$SRtotal;
                    $subTotal+=$SRsubTotal;
                    $tax+=$SRtax;
                    $maintenance->subtotal=$subTotal;
                    $maintenance->total=$total;
                    $maintenance->taxes=$tax;
                    $maintenance->save();
                    $next_km=$maintenance->kms+$row;
                    DB::table('maintenance_services')->insert(
                        array(
                            'entity_id'=>$service->id,
                            'maintenance_id'=>$maintenance->id,
                            'entity'=>'service',
                            'subtotal'=>$SRsubTotal,
                            'total'=>$SRtotal,
                            'taxes'=>$SRtax,
                            'maintenanceKMs'=>$row,
                            'next_maintenanceKMs'=>$next_km,
                        )
                    );
            
                }
            }
        
    
                   
                    
            }
        
            foreach ($request->input('item_id') as $key => $value){
                if($value !=null){
           
                $item=Item::Find($value);
                foreach ($request->input('quantity') as $index => $row) {
                    if($key == $index){
                        $IsubTotal= $row*$item->price;
                        $Itax= $item->price*$row*$item->category->tax->percentage/100;
                        $Itotal = $IsubTotal + $Itax;
                        $total+=$Itotal;
                        $subTotal+=$IsubTotal;
                        $tax+=$Itax;
                        $maintenance->subtotal=$subTotal;
                        $maintenance->total=$total;
                        $maintenance->taxes=$tax;
                        $maintenance->save();
                        DB::table('maintenance_services')->insert(
                            array(
                                'entity_id'=>$item->id,
                                'maintenance_id'=>$maintenance->id,
                                'quantity'=>$row,
                                'entity'=>'item',
                                'subtotal'=>$IsubTotal,
                                'total'=>$Itotal,
                                'taxes'=>$Itax
                            )
                        );
                       
                        $stock = DB::table('inventory_item')->where('item_id', $item->id)->first();
                        if($row>$stock->quantity)
                        {
                            $maintenance->delete();
                            return redirect(route('admin.maintenances.create'))->with('error', 'No enough data');
    
                        }
                        else{
                            $stock->quantity -= $row;
                            $stock = DB::table('inventory_item')->where('item_id', $item->id)->update(['quantity'=> $stock->quantity]); 
                        }
                    
                } 
            }
        }  
        }
    $maintenance->subtotal=$subTotal;
    $maintenance->taxes=$tax;
    $maintenance->total=$subTotal+$tax;
    $maintenance->save();  
     
    $report=new Report;
    $report->entity_id=$maintenance->id;
    $report->type='maintenance';
    $report->status='in';
    $report->payment_type='cash';
    $report->amount=$maintenance->total;
    $report->save();  
   
  
    return redirect(route('admin.serviceMaintenance.index'));


}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $maintenance=Maintenance::find($id);
       // dd($id);
        $servicesMaintenaces=Maintenance::join('maintenance_services','maintenance_services.maintenance_id','=','maintenances.id')
     ->select('maintenance_services.*','maintenances.*')
     ->where('maintenance_services.maintenance_id',$maintenance->id)->get();
    // dd($servicesMaintenaces);
        return view('Admin.serviceMaintenance.show',compact('maintenance','servicesMaintenaces'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
