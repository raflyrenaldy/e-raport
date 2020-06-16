<?php
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('newUser', function(){
    return true;
});
Broadcast::channel('userRemoved', function(){
    return true;
});

Broadcast::channel('newAppointment-{id}', function($id){
    return true;
});

Broadcast::channel('updateAppointment-{id}', function($id){
    return true;
});

Broadcast::channel('updateAppointment-{id}-{id2}', function($id){
    return true;
});

Broadcast::channel('newAppointment', function($id){
    return true;
});

Broadcast::channel('updateAppointment', function($id){
    return true;
});

Broadcast::channel('newCustomer-{id}', function($id){
    return true;
});

Broadcast::channel('newCustomer', function($id){
    return true;
});
