<template>
<div>
    <div class="modal fade" id="client-modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Fill in the form below</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" v-model="client.first_name" class="form-control" id="first_name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" v-model="client.last_name" class="form-control" id="last_name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" v-model="client.email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <br>
                            <button v-on:click.prevent="submitClientInfo" class="btn btn-primary btn-lg form-control">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['email'],
    data () {
        return {
            client: {
                owner_email: '',
                first_name: '',
                last_name: '',
                email: '',
            },
            url: {
                routeCheckUser: window.location.origin + '/api/user/user-check',
                routeRegisterClient: window.location.origin + '/api/client/register',
            },
        }
    },
    watch: {
        'email': function() {
            var that = this;
            if (that.email !== '') {
                that.checkEmail();
            }
        }
    },
    methods: {
        checkEmail: function() {
            var that = this;
            var data = {
                email: that.email,
            }
            axios.post(that.url.routeCheckUser, data).then(function(response){
                var result = response.data;
                if (result.user) {
                    $("#client-modal").modal('show');
                    that.client.owner_email = result.user.email;
                }
            });
        },
        submitClientInfo: function () {
            var that = this;
            var data = that.client
            axios.post(that.url.routeRegisterClient, data).then(function(response){
                var result = response.data;
                $('#client-modal').modal('hide');
                that.client = {
                    owner_email: '',
                    first_name: '',
                    last_name: '',
                    email: '',
                }
            });
        }
    }
}
</script>
