<?php

namespace App\Jobs;

use App\role_user;
use App\User;
use App\XP;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DisableUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The User Model.
     *
     * @var \App\User
     */
    protected $User;

    /**
     * Create a new job instance.
     *
     * @param $User
     */
    public function __construct($User)
    {
        $this->User = $User;
    }

    /**
     * Execute the job.
     *
     * @param $User
     * @return void
     */
    public function handle()
    {
        //If caught, User doesn't exist in Discord Server, so lets remove them
        //Destroy all existing roles for this User
        role_user::where('user_id', $this->User->id)->delete();

        //Delete the Users' XP
        XP::where('uid', $this->User->id)->delete();

        //$User = User::find($this->User)->firstOrFail();
        //Disable the User account, meaning it won't be fetched in User results
        $this->User->enabled = 0;

        //Delete the User's profile information
        $this->User->discriminator = 0000;
        $this->User->locale = NULL;
        $this->User->avatar = NULL;
        $this->User->about = NULL;

        $this->User->save();
    }
}
