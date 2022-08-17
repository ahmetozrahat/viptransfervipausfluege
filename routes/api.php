<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\TransferPoint;
use App\Models\TransferOrder;
use App\Models\Ticket;
use App\Models\Vehicle;
use App\Models\Region;
use App\Models\TransferPrice;
use App\Models\Transfer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class,'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/transfer-point', function () {
        return TransferPoint::all();
    });

    Route::get('/orders', function () {
        return TransferOrder::select(
            'order_list.id',
            'order_list.order_id',
            'order_list.name',
            'order_list.email',
            'order_list.phone',
            'country_list.country_name',
            'order_list.direction',
            'airport_list.name as airport',
            'transfer_point.name as destination',
            'order_list.passenger_quantity',
            'order_list.baby_seat',
            'vehicle_list.name as vehicle',
            'order_list.flight_date',
            'order_list.flight_no',
            't1.name as terminal',
            'order_list.transfer_date',
            'order_list.transfer_point',
            'order_list.transfer_notes',
            'order_list.return_flight_date',
            'order_list.return_transfer_date',
            'order_list.return_flight_no',
            't2.name as return_terminal',
            'order_list.pickup_point',
            'order_list.return_transfer_notes',
            'order_list.original_price',
            'order_list.converted_price',
            'order_list.lang',
            'order_list.currency',
            'order_list.email_list_agreed',
            'order_list.created_at'
        )
            ->leftJoin('country_list', 'order_list.country', '=', 'country_list.id')
            ->leftJoin('airport_list', 'order_list.airport', '=', 'airport_list.id')
            ->leftJoin('transfer_point', 'order_list.destination', '=', 'transfer_point.id')
            ->leftJoin('vehicle_list', 'order_list.vehicle', '=', 'vehicle_list.id')
            ->leftJoin('terminal_list as t1', 'order_list.terminal', '=', 't1.id')
            ->leftJoin('terminal_list as t2', 'order_list.return_terminal', '=', 't2.id')
            ->orderBy('order_list.created_at', 'DESC')
            ->paginate(15);
    });

    Route::post('/order', function (Request $request) {
        $post_data = $request->validate([
            'order_id' => 'required|string'
        ]);

        return TransferOrder::select(
            'order_list.id',
            'order_list.order_id',
            'order_list.name',
            'order_list.email',
            'order_list.phone',
            'country_list.country_name',
            'order_list.direction',
            'airport_list.name as airport',
            'transfer_point.name as destination',
            'order_list.passenger_quantity',
            'order_list.baby_seat',
            'vehicle_list.name as vehicle',
            'order_list.flight_date',
            'order_list.flight_no',
            't1.name as terminal',
            'order_list.transfer_date',
            'order_list.transfer_point',
            'order_list.transfer_notes',
            'order_list.return_flight_date',
            'order_list.return_transfer_date',
            'order_list.return_flight_no',
            't2.name as return_terminal',
            'order_list.pickup_point',
            'order_list.return_transfer_notes',
            'order_list.original_price',
            'order_list.converted_price',
            'order_list.lang',
            'order_list.currency',
            'order_list.email_list_agreed',
            'order_list.created_at'
        )
            ->leftJoin('country_list', 'order_list.country', '=', 'country_list.id')
            ->leftJoin('airport_list', 'order_list.airport', '=', 'airport_list.id')
            ->leftJoin('transfer_point', 'order_list.destination', '=', 'transfer_point.id')
            ->leftJoin('vehicle_list', 'order_list.vehicle', '=', 'vehicle_list.id')
            ->leftJoin('terminal_list as t1', 'order_list.terminal', '=', 't1.id')
            ->leftJoin('terminal_list as t2', 'order_list.return_terminal', '=', 't2.id')
            ->where('order_list.order_id', '=', $post_data['order_id'])
            ->first();
    });

    Route::get('/hotels', function () {
        return TransferPoint::select(
            'transfer_point.id',
            'transfer_point.name',
            'transfer_point.region',
            'region_list.name as region_name'
        )
            ->leftJoin('region_list', 'transfer_point.region', '=', 'region_list.id')
            ->paginate(15);
    });

    Route::post('/hotels', function (Request  $request) {
        $post_data = $request->validate([
            'name' => 'required|string',
            'region' => 'required|integer'
        ]);

        return TransferPoint::create([
            'name' => $post_data['name'],
            'region' => $post_data['region']
        ]);
    });

    Route::get('/regions', function () {
       return Region::all();
    });

    Route::get('/vehicles', function () {
        return Vehicle::all();
    });

    Route::post('/vehicle', function (Request $request) {
        $post_data = $request->validate([
            'name' => 'required|string',
            'seat_quantity' => 'required|integer',
            'baby_seat' => 'required|integer',
            'baggage_quantity' => 'required|integer',
            'image' => 'required|string'
        ]);

        $image_name = 'vehicle_' . time() . '.jpg';
        $image_path = public_path() . '/img/vehicles/' . $image_name;
        $image = $post_data['image'];
        $image = substr($image, strpos($image, ",")+1);
        $image_data = base64_decode($image);
        $result = file_put_contents($image_path, $image_data);

        if ($result != null) {
            $vehicle = new Vehicle;

            $vehicle->name = $post_data['name'];
            $vehicle->seat_quantity = $post_data['seat_quantity'];
            $vehicle->baby_seat = $post_data['baby_seat'];
            $vehicle->baggage_quantity = $post_data['baggage_quantity'];
            $vehicle->image = $image_name;

            $vehicle->save();
            $vehicle->fresh();
            return $vehicle;
        }

        return false;
    });

    Route::put('/vehicle', function (Request $request) {
        $post_data = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'seat_quantity' => 'required|integer',
            'baby_seat' => 'required|integer',
            'baggage_quantity' => 'required|integer'
        ]);

        Vehicle::select('vehicle_list.*')
            ->where('id', $post_data['id'])
            ->update([
                'name' => $post_data['name'],
                'seat_quantity' => $post_data['seat_quantity'],
                'baby_seat' => $post_data['baby_seat'],
                'baggage_quantity' => $post_data['baggage_quantity'],
            ]);

        return Vehicle::select('vehicle_list.*')
            ->where('id', $post_data['id'])
            ->first();
    });

    Route::delete('/vehicle', function (Request $request) {
        $post_data = $request->validate([
            'id' => 'required|integer'
        ]);

        return Vehicle::where('id', $post_data['id'])
            ->delete();
    });

    Route::get('/tickets', function () {
        return Ticket::select('ticket_list.*')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
    });

    Route::get('/prices', function () {
        $transfers =  Transfer::all();
        $list = [];

        foreach ($transfers as $transfer) {
            $prices = TransferPrice::select(
                'transfer_prices.id',
                'region_list.name',
                'transfer_prices.seat_quantity',
                'transfer_prices.price'
            )
                ->where('transfer', '=', $transfer->region)
                ->join('transfer_list', 'transfer_prices.transfer', '=', 'transfer_list.id')
                ->join('region_list', 'transfer_list.region', '=', 'region_list.id')
                ->get();
            $list[] = $prices;
        }

        return $list;
    });

    Route::put('/price', function (Request $request) {
        $post_data = $request->validate([
            'id' => 'required|integer',
            'price' => 'required|integer'
        ]);

        TransferPrice::select('transfer_prices.*')
            ->where('id', $post_data['id'])
            ->update(['price' => $post_data['price']]);

        return TransferPrice::select(
            'transfer_prices.id',
            'region_list.name',
            'transfer_prices.seat_quantity',
            'transfer_prices.price'
        )
            ->where('transfer_prices.id', $post_data['id'])
            ->join('transfer_list', 'transfer_prices.transfer', '=', 'transfer_list.id')
            ->join('region_list', 'transfer_list.region', '=', 'region_list.id')
            ->first();
    });

    Route::get('/dashboard-info', function () {
        $orderCount = TransferOrder::all()->count();
        $hotelCount = TransferPoint::all()->count();
        $ticketCount = Ticket::all()->count();
        $vehicleCount = Vehicle::all()->count();
        $regionCount = Transfer::all()->count();

        return [
            'orderCount' => $orderCount,
            'hotelCount' => $hotelCount,
            'ticketCount' => $ticketCount,
            'vehicleCount' => $vehicleCount,
            'regionCount' => $regionCount
        ];
    });

    Route::get('notification', function () {
        $data = [
            'app_id' => 'e0b5074f-8c57-4b9a-a603-f7da6eb6c71f',
            'included_segments' => ['Subscribed Users'],
            'headings' => [
                'en' => 'İsim • Yeni Sipariş'
            ],
            'contents' => [
                'en' => '1660-uD5Qxj-4404 nolu yeni siparişe göz atmak için dokunun.'
            ],
            'data' => [
                'order_id' => '1660-uD5Qxj-4404'
            ]
        ];

        return Http::contentType('application/json')
            ->acceptJson()
            ->withToken('N2RjNTM1ZDMtZmRkZC00MDBkLWE2MWYtZTMzZDdjNjY1ZWFm')
            ->post('https://onesignal.com/api/v1/notifications', $data);
    });
});
