<?php

return [
    'task' => [
        // class of your domain object
        'class' => \Modules\Task\app\Models\Task::class,

        // name of the graph (default is "default")
        'graph' => 'task',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        // list of all possible states
        'states' => [
            \Modules\Task\app\Models\ConstNames::NOT_STARTED,
            \Modules\Task\app\Models\ConstNames::IN_PROGRESS,
            \Modules\Task\app\Models\ConstNames::COMPLETED,
        ],

        // list of all possible transitions
        'transitions' => [
            \Modules\Task\app\Models\ConstNames::START => [
                'from' => [\Modules\Task\app\Models\ConstNames::NOT_STARTED],
                'to' => \Modules\Task\app\Models\ConstNames::IN_PROGRESS,
            ],
            \Modules\Task\app\Models\ConstNames::COMPLETE => [
                'from' =>  [\Modules\Task\app\Models\ConstNames::IN_PROGRESS],
                'to' => \Modules\Task\app\Models\ConstNames::COMPLETED,
            ]
        ],

        'callbacks' => [
            'after' => [
                'history' => [
                    'do' => 'StateHistoryManager@storeHistory'
                ]
            ]
        ]
    ]
];
