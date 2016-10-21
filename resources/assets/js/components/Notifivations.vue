<template>
<li class="dropdown dropdown-notifications">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <transition
            enter-active-class="animated tada"
            leave-active-class="animated tada">
            <i v-show="showNotifiction" class="glyphicon glyphicon-bell notification-icon"><span class="badge">{{ animatedUnreadNotificationCount }}</span></i>
        </transition>
    </a>

    <div class="dropdown-container">

        <div class="dropdown-toolbar">
            <div class="dropdown-toolbar-actions">
                <a href="#">Mark all as read</a>
            </div>
            <h3 class="dropdown-toolbar-title">Notifications ({{unreadNotificationCont}})</h3>
        </div><!-- /dropdown-toolbar -->

        <ul class="dropdown-menu">
            <li class="notification" v-for="notification in notofications" v-on:click="markAsRead(notification)" v-bind:class="{active: !notification.is_readed}">
                <div class="media">
                    <div class="media-left media-middle">
                        <div class="media-object">
                            <img class="img-circle" style="width: 32px; height: 32px;" src="">
                        </div>
                    </div>
                    <div class="media-body">
                        <strong class="notification-title"><a href="#">{{notification.data.from}}</a> <!-- resolved <a href="#">T-14 - Awesome stuff</a> --> </strong>

                        <p class="notification-desc">{{notification.data.message}}</p>

                        <div class="notification-meta">
                            <small class="timestamp">{{notification.created_at}}</small>
                        </div>

                    </div>
                </div>
            </li>
        </ul>

        <div class="dropdown-footer text-center">
            <a href="#">View All</a>
        </div><!-- /dropdown-footer -->

    </div><!-- /dropdown-container -->
</li>         
</template>

<script>
    export default {
        mounted() {
            console.log('Notifivations.vue component ready.')
            
            this.listenChanel();
            this.$http.post('/get-notifications').then(resp => {
                    this.notofications = resp.data.notifications;
                    this.unreadNotificationCont = resp.data.unread_notidications_count;
            });

        },        
        data() {
            return {
                showNotifiction: true,
                unreadNotificationCont: 0,
                animatedUnreadNotificationCount: 0,
                notofications: []
            }
        },
        props: ['userId'],
        methods: {
            toggleNotification: function () {
                this.showNotifiction = false;
                var vm = this
                setTimeout(function () {
                    vm.showNotifiction = true;
                }, 500);
            },
            listenChanel: function () {
                window.Echo.private('App.User.' + this.userId)
                    .notification((notification) => {
                        console.log(notification);
 
                        $.notify({
                            icon: '',
                            title: notification.from,
                            message: notification.message
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

                    this.unreadNotificationCont += 1;
                    this.toggleNotification();

                    this.notofications.unshift({  
                        id: notification.id,
                        type: notification.type,
                        notifiable_id:2,
                        notifiable_type:"App\\User",
                        data:{  
                           from: notification.from,
                           message: notification.message
                        },
                        read_at:null,
                        created_at:"2016-10-21 12:41:37",
                        updated_at:"2016-10-21 12:41:37",
                        is_readed:false
                    });
                });                                               
            },
            markAsRead: function(notification) {
                this.$http.post('/read-notification/' + notification.id).then(resp => {
                    notification.is_readed = true;
                    this.unreadNotificationCont = resp.data.unread_notidications_count;
                });
            }
        },
        watch: {
            unreadNotificationCont: function (newValue, oldValue) {
                var vm = this
                function animate(time) {
                    requestAnimationFrame(animate)
                    TWEEN.update(time)
                }
                new TWEEN.Tween({tweeningNumber: oldValue})
                        .easing(TWEEN.Easing.Quadratic.Out)
                        .to({tweeningNumber: newValue}, 500)
                        .onUpdate(function () {
                            vm.animatedUnreadNotificationCount = this.tweeningNumber.toFixed(0)
                        })
                        .start()
                animate()
            }
        }
    }
</script>
