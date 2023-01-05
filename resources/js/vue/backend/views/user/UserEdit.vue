<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Location</h5> <small class="text-muted float-end">Edit the location</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addCategory($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input name="name" type="text" :value="location.name" class="form-control" id="basic-default-fullname" placeholder="John Doe">
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">update</button>
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
            category: '',
            error: '',
            success: '',
            id: ''
        }
    },
    methods: {
        ...mapActions(['fetch_asset_location_single']),
        addCategory(event) {
            let formData = new FormData(event);
            formData.append('id', this.id);
            axios.post('/location/update', formData).then((response) => {
                if(response.status === 200) {
                    window.s_alert('success', response.data.message);
                    this.$router.replace({ name: 'assetLocation' })
                }
            })
            .catch((e) => {
                if(e.response.status === 422) {
                    this.error = e.response.data.message;
                }
                if(e.response.status === 401) {
                    console.log(e.response.data);
                    this.error = e.response.data.message;
                }
            });
        },
        
    },
    created: async function() {
        this.id = this.$route.params.id
        // await this.fetch_asset_category_all();
        await this.fetch_asset_location_single(this.id);
    },
    computed: {
        ...mapGetters(['get_asset_location_single_data', 'get_asset_category_data']),
        location: function () {
          return this.get_asset_location_single_data
        },
        
    }
};
</script>

<style>
</style>
