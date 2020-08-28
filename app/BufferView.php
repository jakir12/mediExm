<?php

namespace Bulkly;

use Illuminate\Database\Eloquent\Model;

class BufferView extends Model {
    
    use Notifiable;
    use Billable;
    protected $table = "buffer_postings";
    
}
