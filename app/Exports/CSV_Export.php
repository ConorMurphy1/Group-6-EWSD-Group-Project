<?php

namespace App\Exports;

use App\Models\Idea;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CSV_Export implements FromCollection, WithHeadings
{
    protected $event_id;

    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Idea::getAllIdea($this->event_id));
    }

    public function headings():array{
        return[
            'title',
            'description',
            'user_id',
            'department_id',
            'event_id',
            'is_anonymous',
            'document',
            'views',
            'created_at',
            'updated_at',
            'deleted_at'

        ];
    }
}
