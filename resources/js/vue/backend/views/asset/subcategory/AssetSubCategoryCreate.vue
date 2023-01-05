<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sub-Category</h5> <small class="text-muted float-end">Create new sub category</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addCategory()">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Select Category</label>
                                <select id="select2Basic"  class="select2 form-select form-select-lg" name="category_id">
                                    <option :key="index" v-for="(category, index) in category_data" :value="category.id">{{ category.name }}</option>
                                </select>
                                <strong v-if="error_mssg" class="text-danger">{{ error_mssg }}</strong>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" v-model="category_name" class="form-control" id="basic-default-fullname" name="name" placeholder="Mouse, keyboard etc.">
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
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            category_name: '',
            error_mssg: '',
            success: '',
            categories: '',
            category_id: ''
        }
    },
    methods: {
        ...mapActions(['create_asset_sub_category', 'fetch_asset_category_all']),
        addCategory: async function() {
            let res = await this.create_asset_sub_category({ category_id: this.category_id, name: this.category_name })
            this.category_id = '';
            this.category_name = '';
            window.s_alert('success',res.data.message);
        }
    },
    computed: {
        ...mapGetters(['get_asset_category_data']),
        category_data: function () {
            return this.get_asset_category_data
        }
    },
    created: async function()  {
        
        await this.fetch_asset_category_all();

        setTimeout(() => {
            this.category_id = this.category_data[0].id
            let that = this;
            $('.select2').select2({});
            $('.select2').on('select2:select', function (e) {
                var data = e.params.data;
                that.category_id = data.id
            });
        }, 500);
    },
    
};
</script>

<style>
</style>
