<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Category</h5> <small class="text-muted float-end">Create new category</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addCategory()">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="name" v-model="category_name" class="form-control" id="basic-default-fullname" placeholder="John Doe">
                                <strong v-if="error_mssg" class="text-danger">{{ error_mssg }}</strong>
                                
                                <strong class="text-success">{{ success }}</strong>
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
            category_name: '',
            error_mssg: '',
            success: ''
        }
    },
    methods: {
        ...mapActions(['create_asset_category']),
        addCategory: async function() {
            let res = await this.create_asset_category({ name: this.category_name })
            this.category_name = '';
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
