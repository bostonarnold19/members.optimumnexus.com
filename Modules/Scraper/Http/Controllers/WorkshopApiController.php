<?php

namespace Modules\Scraper\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Scraper\Interfaces\ScraperRepositoryInterface;
use Modules\Scraper\Interfaces\WorkshopEventAttendeeRepositoryInterface;
use Modules\User\Interfaces\UserRepositoryInterface;


class WorkshopApiController extends Controller
{

    protected $scraper_repository;
    protected $user_repository;
    protected $workshop_event_attendee_repository;

    public function __construct(ScraperRepositoryInterface $scraper_repository, UserRepositoryInterface $user_repository, WorkshopEventAttendeeRepositoryInterface $workshop_event_attendee_repository)
    {
        $this->scraper_repository = $scraper_repository;
        $this->user_repository = $user_repository;
        $this->workshop_event_attendee_repository = $workshop_event_attendee_repository;
    }

    // public function index()
    // {
    //     dd('test');
    // }

    public function checkUser(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            //get user id
            $data = [];
            $event_data = [];
            $user = $this->user_repository->where('email', $request->email)->first();
            $data['user_info'] = $user->toArray();
            $subscription_details = $user->subscriptions->where('product_name','scraper')->first();

            if ($subscription_details) {
                $current_date = date('Y-m-d H:i:s');
                if ($subscription_details->expired_at >= $current_date) {
                    $data['subscription_details'] = $subscription_details->toArray();
                    $user_events = $this->scraper_repository->where('user_id',$user->id)->get();
                    foreach ($user_events as $key => $user_event) {
                        $html = '';
                        $counter = 0;
                        $other_data = json_decode($user_event->other_data);
                        $html_data = $other_data[0];
                        $radio_values = $other_data[1];
                        $event_data[$key]['event_id'] = $user_event->id;
                        $event_data[$key]['event_name'] = $user_event->event_name;
                        $event_data[$key]['event_location_date'] = $user_event->event_location_date;
                        $event_data[$key]['tags'] = $other_data[2];
                        foreach ($html_data as $key_2 => $value) {
                            $html .= '<div class="form-group row">';
                              $html .= '<div class="col-12">';
                                $html .= '<p><em>' . preg_replace('/\s\s+/', ' ', $value[2]) . '</em></p>';
                                $html .= '<div class="form-check">';
                                  $html .= '<label class="form-check-label">';
                                    $html .= '<input class="form-check-input" type="radio" value="'.$radio_values[$counter].'" name="time" required>';
                                    $html .= $value[0];
                                  $html .= '</label>';
                                $html .= '</div>';
                                $html .= '<div class="form-check">';
                                  $html .= '<label class="form-check-label">';
                                    $html .= '<input class="form-check-input" type="radio" value="'.$radio_values[$counter+1].'" name="time" required>';
                                    $html .=  $value[1];
                                  $html .= '</label>';
                                $html .= '</div>';
                              $html .= '</div>';
                            $html .= '</div>';
                            $counter+=2;
                        }
                        $event_data[$key]['html'] = $html;
                    }
                    $data['event_data'] = $event_data;
                    return response()->json([
                        'data' => $data,
                    ], 200);
                } else {
                    return response()->json([
                        'error' => 'User subscription is expired.',
                    ], 400);
                }
                
            } else {
                return response()->json([
                    'error' => 'User is not subscribe to the event service',
                ], 400);
            }
            
        } else {
            return response()->json([
                'error' => 'User not found',
            ], 404);
        }
    }

    public function addEventAttendee(Request $request)
    {
        try {
            $status_code    = 500;
            $status         = 'error';
            $message        = 'Internal server error.';
            $user           = $this->user_repository->where('api_token', $request->api_token)->where('email', $request->email)->first();

            if ($user) {

                $subscription_details   = $user->subscriptions->where('product_name','scraper')->first();
                $current_date           = date('Y-m-d H:i:s'); // today
                if ($subscription_details->expired_at >= $current_date) {
                    $data = $request->all();
                    //check if attendee is already have invitation
                    $attendee_event = $this->workshop_event_attendee_repository->where('email', $data['email'])->where('time', $data['time'])->get();
                    if ($attendee_event) {
                        $status         = 'error';
                        $message        = 'You have already register in this event.';
                        $status_code    = 401;
                    } else {

                        $this->workshop_event_attendee_repository->storeEventAttendee($data);
                        $status         = 'data';
                        $message        = 'Registration complete.';
                        $status_code    = 200;
                    }

                }else {
                    $message        = 'User subscription is expired.';
                    $status_code    = 400;
                }

            } else {
                $status_code = 404;
                $message = 'Invalid token/user.';
            }

        } catch (\Exception $e) {
            // $message = $e->getMessage();
            $message = 'Internal server error.';
        }
        return response()->json([
            $status => $message
        ], $status_code);
    }
    
}
