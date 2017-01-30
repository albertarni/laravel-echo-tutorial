<template>
    <div class="col-md-5 chat-panel" v-show="showChat">
        <div class="row">
            <div class="col-md-7">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title pull-left">Panel title</h4>
                        <div class="btn-toolbar pull-right" role="toolbar" aria-label="...">
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <a href="#" class="btn btn-default">
                                    <i class="glyphicon glyphicon glyphicon-cog"></i>
                                </a>
                            </div>
                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <a href="#" class="btn btn-default">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <ul class="media-list">
                            <li class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object" src="/uploads/avatars/1476713202.png" style="width:32px; height:32px; border-radius:50%">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <strong class="primary-font">Albert Arnold</strong>
                                        <small class="pull-right text-muted">
                                            <span class="glyphicon glyphicon-time" style="margin-right: 5px"></span>12 mins ago
                                        </small>
                                    </div>

                                    <p>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </p>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left"></div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <small class="pull-right text-muted">
                                            <span class="glyphicon glyphicon-time" style="margin-right: 5px"></span>12 mins ago
                                        </small>
                                    </div>

                                    <p class="pull-right">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Message...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Send</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {               
            this.$http.get('/get-messages').then(resp => {
                    
            });

            console.log('Chat.vue component ready.')
        },        
        data() {
            return {
                showChat: true,
                messages: [],
            }
        },
        methods: {
           
        }
    }
</script>

<style scoped>
    .chat-panel {
        position: absolute; 
        bottom: 0;
        right: 0;
    } 
</style>
