<?php

namespace Modules\Scraper\Repositories;

use Modules\Core\Repositories\AbstractEloquentRepository;
use Modules\Scraper\Interfaces\WorkshopEventAttendeeRepositoryInterface;

class WorkshopEventAttendeeRepository extends AbstractEloquentRepository implements WorkshopEventAttendeeRepositoryInterface
{
    public function storeEventAttendee(array $data)
    {
        $event_attendee_data = array(
            'event_id'      => $data['event_id'],
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'time'          => $data['time'],
            'phone'         => $data['phone'],
            'address1'      => $data['address1'],
            'address2'      => @$data['address2'],
            'city'          => $data['city'],
            'zip'           => @$data['zip'],
            'email'         => $data['email'],
            'state'         => @$data['state'],
            'country'       => @$data['country'],
            'tags'          => $data['tags']
        );
        $this->save($event_attendee_data);
        return;
    }
}
