<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Location</h5> <small class="text-muted float-end">Create new Location</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addlocation($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="Banani">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Address</label>
                                <input type="text" name="address" class="form-control" id="basic-default-fullname" placeholder="Startech 2nd floor">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Mobile Number</label>
                                <input type="text" name="mobile_number" class="form-control" id="basic-default-fullname" placeholder="0175*******">
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
import { mapActions } from "vuex";
export default {
    data() {
        return {
            location_name: '',
            error_mssg: '',
            success: ''
        }
    },
    methods: {
        ...mapActions(['create_asset_location']),
        addlocation: async function(event) {
            let formData = new FormData(event);
            let res = await this.create_asset_location(formData)
            event.reset()
            window.s_alert('success',res.data.message);
        }
    },
    created() {

    },
    computed: {
        error: function(){
            return this.error;
        },
        
    }
};
</script>

<style>
</style>
