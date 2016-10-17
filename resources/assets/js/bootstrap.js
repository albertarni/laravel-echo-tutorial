
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo"

 window.Echo = new Echo({
     broadcaster: 'pusher',
     key: '81daa45ac781c738c567',
     cluster: 'eu',
     encrypted: true
 });
 
window.Echo.private('chat-room.1')
    .listen('ChatMessageWasReceived', (e) => {
//         $.notify({
//            title: "Massage from <strong>" + e.user.name +":</strong> ",
//            message: e.chatMessage
//        });
        
        $.notify({
            icon: e.user.profile_picture,
            title: e.user.name,
            message: e.chatMessage
        },{
            type: 'minimalist',
            delay: 5000,
            icon_type: 'image',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<img data-notify="icon" class="img-circle pull-left">' +
                '<span data-notify="title">{1}</span>' +
                '<span data-notify="message">{2}</span>' +
                '</div>'
        });
    });
    
function showNotification(user,mess) {
    var notification = new Notification(user.name, {
        dir: "auto",
        lang: "",
        body: mess.message,
        tag: "sometag",
        });
    };
    



