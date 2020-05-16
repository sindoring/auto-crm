<?php

namespace App\Observers;

use App\Employees;
use App\GoodsCategories;
use App\Roles;
use App\ServiceCategories;
use App\User;
use App\Workshops;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->makeOwnerAndWorkshop($user);   
    }

    private function makeOwnerAndWorkshop(User $user){

        $workshop = new Workshops([
            'userID'=>$user->userID
        ]);
        $workshop->save();

        $role = new Roles([
            'workshopID'=>$workshop->workshopID,
            'name'=> Roles::owner
        ]);
        $role->save();
        
        $employee = new Employees([
            'userID'=>$user->userID,
            'workshopID'=>$workshop->workshopID,
            'roleID'=> $role->roleID
        ]);
        $employee->save();

        $emptyServiceCategory = new ServiceCategories([
            'workshopID'=>$workshop->workshopID,
            'name'=> ServiceCategories::emptyCategory
        ]);
        $emptyServiceCategory->save();

        $emptyGoodsCategory = new GoodsCategories([
            'workshopID'=> $workshop->workshopID,
            'name'=> GoodsCategories::emptyCategory
        ]);
        $emptyGoodsCategory->save();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
