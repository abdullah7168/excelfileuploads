<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Booking;
use DB;
use Excel;

class ParsingController extends Controller
{

    public function getIndex(){
        $bookings = Booking::all();
        $mostpaidbookings = DB::table('bookings')
                                        ->max('final_price');

        return view('index',compact('bookings'),compact('mostpaidbookings'));
    }

    public function getBookingCount(){
        $bookings = DB::table('bookings')
                                ->where('booked','=','true')      
                                ->count();
        return json_encode($bookings); 
    }

    public function importExcel()
	{
		if(Input::hasFile('bookingsheet')){
			$path = Input::file('bookingsheet')->getRealPath();
			$data = Excel::load($path, function($reader) {
                $reader->takeRows(10);
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
                    $start_date = '';
                    $end_date = '';
                    foreach ($value->start_at as $v) {
                        $start_date[] = $v;
                    }
                    if(!empty($value->end_date)){
                        foreach ($value->end_date as $v) {
                            $end_date[] = $v;
                        }
                    } else {
                        $end_date[0] = '2017-10-31';
                    }
                    $insert[] = [
                                    'row_id'                => $value->id,
                                    'start_at'              => $start_date[0],
                                    'end_at'                => $end_date[0],
                                    'booked'                => $value->booked,
                                    'unavailable'           => $value->unavailable,
                                    'tentative_expires_at'  => $value->tentative_expires_at,
                                    'rental'                => $value->rental,
                                    'client'                => $value->client,
                                    'initial_price'         => $value->initial_price,
                                    'airbnb_cleaning_fee'   => $value->airbnb_cleaning_fee,
                                    'booking_com_fee'       => '',
                                    'final_price'           => $value->final_price,
                                    'notes'                 => $value->notes,
                                    'adults'                => $value->adults,
                                    'children'              => $value->children,
                                    'account'               => $value->account,
                                    'created_at'            => $value->created_at,
                                    'updated_at'            => $value->updated_at,
                                    'canceled_at'           => $value->canceled_at,
                                    'damage_deposit'        => $value->damage_deposit,
                                    'currency'              => $value->currency,
                                    'source'                => $value->source,
                                    'downpayment'           => $value->downpayment,
                                    'reference'             => $value->reference,
                                    'bookings_tags'         => $value->bookings_tags
                            ];
        
				}
				if(!empty($insert)){
					DB::table('bookings')->insert($insert);
                    return redirect('/index');
				}
			}
		}
		return back();
	}
}
