<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 col-md-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Audits</h5> <small class="text-muted float-end">Create new Audit</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addlocation($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="title" class="form-control" id="basic-default-fullname" placeholder="Yearly Audit">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Description</label>
                                <textarea class="form-control" name="description" id="" cols="10" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Start Date</label>
                                <input type="datetime-local" name="start_date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">End Date</label>
                                <input type="datetime-local" name="end_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="multicol-username"><h5>Transfered Person</h5></label>
                                <select id="select2User"  class="users form-select">
                                    <option v-for="(user, index) in get_user_data" :value="user.id" :key="index">{{ user.first_name }} {{ user.last_name }}</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary waves-effect waves-light">create</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Invoice repeater -->
        </div>
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            location_name: '',
            error_mssg: '',
            success: '',
            user: ''
        }
    },
    watch: {
        get_user_data: function (val) {
            // console.log(val);
            this.user = val[0].id
            const that = this;
            setTimeout(() => {
                $('.users').off().select2({});
                $('.users').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.user = data.id
                });
            }, 500);
        },
    },
    methods: {
        ...mapActions(['create_audit', 'fetch_users_admin']),
        addlocation: async function(event) {
            let formData = new FormData(event);
            formData.append('assign_to', this.user);
            let res = await this.create_audit(formData)
            event.reset()
            window.s_alert('success',res.data.message);
        }
    },
    created: async function()  {
        await this.fetch_users_admin();
    },
    computed: {
        error: function(){
            return this.error;
        },
        ...mapGetters(['get_user_data']),
    }
};
</script>

<style>
</style>
