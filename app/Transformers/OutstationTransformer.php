<?php

namespace App\Transformers;

use App\Models\Outstation;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class OutstationTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Outstation $outstation)
    {
        return [
            'id' => $outstation->id,
            'title' => $outstation->title,
            'description' => $outstation->description,
            'is_approved' => $outstation->is_approved ? true : false,
            'approval_status' => $outstation->status->name,
            'start_date' => $outstation->start_date,
            'due_date' => $outstation->due_date,
            'photo' => env('MEDIA_URL') . Storage::url($outstation->photo),
        ];
    }
}
