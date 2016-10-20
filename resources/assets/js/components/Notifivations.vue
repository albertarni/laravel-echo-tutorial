<template>
    <li class="dropdown dropdown-notifications">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <transition
                enter-active-class="animated tada"
                leave-active-class="animated tada">
                <i v-show="showNotifiction" class="glyphicon glyphicon-bell notification-icon"><span class="badge">{{ animatedNumber }}</span></i>
            </transition>
        </a>

        <ul class="dropdown-menu dropdown-menu-left">
            <li class="notification">
                <div class="media" v-for="notification in notofications">
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
    </li>           
</template>

<script>
    export default {
        mounted() {
            console.log('Notifivations.vue component ready.')
            
            this.listenChanel();
            this.$http.post('/get-notifications').then(resp => {
                    this.notofications = resp.data;
            });
        },        
        data() {
            return {
                showNotifiction: true,
                number: 0,
                animatedNumber: 0,
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

                    this.number += 1;
                    this.toggleNotification();
                });                                               
            }
        },
        watch: {
            number: function (newValue, oldValue) {
                var vm = this
                function animate(time) {
                    requestAnimationFrame(animate)
                    TWEEN.update(time)
                }
                new TWEEN.Tween({tweeningNumber: oldValue})
                        .easing(TWEEN.Easing.Quadratic.Out)
                        .to({tweeningNumber: newValue}, 500)
                        .onUpdate(function () {
                            vm.animatedNumber = this.tweeningNumber.toFixed(0)
                        })
                        .start()
                animate()
            }
        },
    }
</script>
