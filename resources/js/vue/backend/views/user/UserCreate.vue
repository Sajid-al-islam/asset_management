<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">User</h5> <small class="text-muted float-end">Create new User</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addUser($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="basic-default-fullname" placeholder="mr">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="basic-default-fullname" placeholder="user">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Email</label>
                                <input type="email" name="email" class="form-control" id="basic-default-fullname" placeholder="user@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Password</label>
                                <input type="password" name="password" class="form-control" id="basic-default-fullname" placeholder="*****">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control" id="basic-default-fullname" placeholder="0175*******">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Designation</label>
                                <input type="text" name="designation" class="form-control" id="basic-default-fullname" placeholder="Graphics Desginer">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="multicol-username"><h5>Roles</h5></label>
                                <select id="select2Basic"  class="roles form-select">
                                    <option v-for="(role, index) in get_user_roles" :value="role.id" :key="index">{{ role.name }}</option>
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
            role_id: null
        }
    },
    watch: {
        get_user_roles:function(val) {
            const that = this;
            setTimeout(() => {
                $('.roles').off().select2({});
                $('.roles').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.role_id = data.id
                });
            }, 500);
        },
    },
    methods: {
        ...mapActions(['create_user', 'fetch_user_roles']),
        addUser: async function(event) {
            let formData = new FormData(event);
            formData.append('role_id', this.role_id);
            let res = await this.create_user(formData)
            event.reset()
            window.s_alert('success',res.data.message);
        }
    },
    created: async function()  {
        await this.fetch_user_roles();
    },
    computed: {
        ...mapGetters([
            'get_user_roles'
        ]),
    }
};
</script>

<style>
</style>
