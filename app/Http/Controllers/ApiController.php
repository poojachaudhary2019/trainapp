<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\destinations as Destinations;
use App\Models\train as Trains;
use App\Models\ticket as Ticket;
use Validator;

class ApiController extends Controller
{
    
    public function __construct()
    {

    }

    public function getDestinations(Request $request)
    {
        if($request->has('keyword'))
        {
            $destinations = Destinations::where('name', 'LIKE', $request->get('keyword').'%')->get();
        
        }else {

            $destinations = Destinations::get();
        }

        if($destinations->isEmpty())
        {
            $response = array(
                'status' => 400,
                'data' => NULL,
                'message' => 'No Destinations found'
    
            );

            return response()->json($response, 400);
        }

        $response = array(
            'status' => 200,
            'data' => $destinations,
            'message' => 'Destinations fetched successfully'

        );

        return response()->json($response, 200);
    }

    public function getTrains(Request $request)
    {
        $trains = new Trains();
        if($request->has('from') && $request->get('from') != NULL)
        {
            $trains = Trains::where('from', $request->get('from'));
        
        }

        if($request->has('to') && $request->get('to') != NULL)
        {
            $trains = Trains::where('to', $request->get('to'));
        
        }

        if($request->has('fromDate') && $request->get('fromDate') != NULL)
        {
            $trains = Trains::where('trainDeparture','>=', $request->get('fromDate'));
        
        }

        if($request->has('toDate') && $request->get('toDate') != NULL)
        {
            $trains = Trains::where('trainArrival', '<=', $request->get('toDate'));
        
        }

        if($request->has('noOfPassengers') && $request->get('noOfPassengers') != NULL)
        {
            $trains = Trains::where('availableSeats','>=', $request->get('noOfPassengers'));
        
        }

        $trains = $trains->get();

        if($trains->isEmpty())
        {
            $response = array(
                'status' => 400,
                'data' => NULL,
                'message' => 'No trains found'
    
            );

            return response()->json($response, 400);
        } 

        $response = array(
            'status' => 200,
            'data' => $trains,
            'message' => 'Trains fetched successfully'

        );

        return response()->json($response, 200);
    }

    public function bookTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trainId' => 'required',
            'price' =>  'required',
            'noOfPassengers' =>  'required',
            'contactName' =>  'required',
            'contactEmail' =>  'required',
            'contactPhone' =>  'required',
            'contactAddress' =>  'required',
        ]); 

        if ($validator->fails()) {
            $error = $validator->errors();
            $response = array(
                'status' => 400,
                'data' => $error->toArray(),
                'message' => 'Validation errors Found'
    
            );
    
            return response()->json($response, 400);

        }

        $ticket = new Ticket();
        $ticket->trainId = $request->get('trainId');
        $ticket->price = $request->get('price');
        $ticket->noOfPassengers = $request->get('noOfPassengers');
        $ticket->amount = $request->get('price')*$request->get('noOfPassengers');
        $ticket->contactName = $request->get('contactName');
        $ticket->contactEmail = $request->get('contactEmail');
        $ticket->contactPhone = $request->get('contactPhone');
        $ticket->contactAddress = $request->get('contactAddress');
        $ticket->pnr = rand(1000,999999);
        $ticket->status = 'paid';
        $ticket->paymentMethod = 'vipps';
        $ticket->paymentNotes = '';
        $ticket->save();

        $response = array(
            'status' => 200,
            'data' => $ticket,
            'message' => 'Ticket booked successfully'

        );

        return response()->json($response, 200);

    }

    public function getTicket($pnr)
    {
        $ticket = Ticket::where('pnr', $pnr)->first();

        if($ticket)
        {
            $response = array(
                'status' => 200,
                'data' => $ticket,
                'message' => 'Ticket fetched successfully'
    
            );
    
            return response()->json($response, 200);
        }

        $response = array(
            'status' => 200,
            'data' => NULL,
            'message' => 'Invalid Pnr'

        );

        return response()->json($response, 200);

    }
    
}
