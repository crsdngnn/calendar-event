<?php

namespace App\Http\Controllers;

use App\Day;
use App\Event;

use App\Http\Requests\EventRequest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\Rest\RestRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class EventController extends Controller
{

    /**
     * @var RestRepository
     */
    private $rest;
    /**
     * @var Day
     */
    private $day;
    /**
     * @var EventDetail
     */
    private $eventDetail;

    /**
     * EventController constructor.
     * @param Event $model
     * @param Day $day
     */
    public function __construct(Event $model, Day $day) {
        $this->rest = new RestRepository($model);
        $this->day = $day;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $response = $this->rest->with(['hasManyEventDetails'])->latest()->first();
        return $this->response(
            "Event Successfully Fetched.",
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $request->all();
        return DB::transaction(function() use ($data) {
            $response = $this->rest->getModel()->create($data);
            $response->hasManyEventDetails()->createMany($data['has_many_event_details']);
            return $this->response(
                "Event Successfully Saved.",
                $response,
                Response::HTTP_OK
            );
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function getDays()
    {
        $response = $this->day->all();

        return $this->response(
            "Days Successfully Fetched.",
            $response,
            Response::HTTP_OK
        );
    }
}
