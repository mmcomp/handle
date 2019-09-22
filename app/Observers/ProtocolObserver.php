<?php

namespace App\Observers;

use App\Protocol;
use App\ProtocolChange;
use Illuminate\Support\Facades\Auth;

class ProtocolObserver
{
    /**
     * Handle the protocol "created" event.
     *
     * @param  \App\Protocol  $protocol
     * @return void
     */
    public function created(Protocol $protocol)
    {
        //
    }

    /**
     * Handle the protocol "updated" event.
     *
     * @param  \App\Protocol  $protocol
     * @return void
     */
    public function updated(Protocol $protocol)
    {
        $changes = [];
        $user = Auth::getUser();
        $dirty = $protocol->getDirty();
        foreach ($dirty as $field => $newdata){
            if($field!='updated_at') {
                $olddata = $protocol->getOriginal($field);
                if(\strpos(strtolower($field), 'date')!==false) {
                    $tmp = explode(' ', $olddata);
                    $olddata = $tmp[0];
                }
                if ($olddata != $newdata)
                {
                    dump($user->name . ' did Changed `' . $field . '` from "' . $olddata . '" to "' . $newdata . '"');
                    $changes[] = [
                        "users_id"=>$user->id,
                        "field_name"=>$field,
                        "from_value"=>$olddata,
                        "to_value"=>$newdata,
                        "protocols_id"=>$protocol->id,
                        "created_at"=>new \DateTime,
                    ];
                }
            }
        }
        if(count($changes)>0) {
            ProtocolChange::insert($changes);
        }
    }

    /**
     * Handle the protocol "deleted" event.
     *
     * @param  \App\Protocol  $protocol
     * @return void
     */
    public function deleted(Protocol $protocol)
    {
        //
    }

    /**
     * Handle the protocol "restored" event.
     *
     * @param  \App\Protocol  $protocol
     * @return void
     */
    public function restored(Protocol $protocol)
    {
        //
    }

    /**
     * Handle the protocol "force deleted" event.
     *
     * @param  \App\Protocol  $protocol
     * @return void
     */
    public function forceDeleted(Protocol $protocol)
    {
        //
    }
}
