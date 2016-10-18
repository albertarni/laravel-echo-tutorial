<template>
                <div class="panel panel-default">
                <div class="panel-heading">
                    Online users
                </div>

                <div class="panel-body">
                    <ul class="media-list">
                        <li class="media" v-for="user in onlineUsers">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object" v-bind:src="user.profile_picture" style="width:32px; height:32px; border-radius:50%">
                                </a>
                            </div>
                            <div class="media-body media-middle">
                                <h5 class="media-heading">{{user.name}}</h5>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.post('/get-online-users').then(resp => {
                    this.onlineUsers = resp.data;
            });
                
            console.log('OnlineUsers.vue component ready.')
        },        
        data() {
            return {
                onlineUsers: []
            }
        },
        methods: {
            alma() {
                console.log('alma')
            }
        }
    }
</script>
