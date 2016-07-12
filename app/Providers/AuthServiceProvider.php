<?php
namespace Curso\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Curso\Entities\Ticket;
use Curso\Policies\TicketPolicy;

class AuthServiceProvider extends ServiceProvider{
  /**
   * The Policy mapping for the applications
   *
   * @var array
   */

  protected $policies = [
    //'Curso\Model' => 'Curso\Policies\ModelPolicy',
    Ticket::Class => TicketPolicy::class,
  ];

  /**
   * Register any application authentication / authorization services.
   *
   * @param \Illuminate\Contracts\Auth\Access\Gate $gate
   * @return void
   */
  public function boot(GateContract $gate)
  {

    $gate->before(function($user){
      if($user->isAdmin()){
        return true;
      }
    });

    $this->registerPolicies($gate);

    //
  }
}