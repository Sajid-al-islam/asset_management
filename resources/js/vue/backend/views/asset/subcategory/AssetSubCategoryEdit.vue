<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Category</h5> <small class="text-muted float-end">Edit the category</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="addCategory($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Select Category</label>
                                <select id="select2Basic" name="category_id" class="select2 form-select form-select-lg" >
                                    <option :key="index" v-for="(category, index) in category_data" :value="category.id">{{ category.name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input name="name" type="text" :value="sub_category.name" class="form-control" id="basic-default-fullname" placeholder="John Doe">
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
        ...mapActions(['create_asset_category','fetch_asset_sub_category_single', 'fetch_asset_category_all']),
        addCategory(event) {
            let formData = new FormData(event);
            formData.append('id', this.id);
            axios.post('/sub_category/update', formData).then((response) => {
                if(response.status === 200) {
                    window.s_alert('success', response.data.message);
                    this.$router.replace({ name: 'assetSubCategory' })
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
        await this.fetch_asset_category_all();
        await this.fetch_asset_sub_category_single(this.id);

        setTimeout(() => {
            let that = this;
            $('.select2').select2({})
                .on('select2:select', function (e) {
                    var data = e.params.data;
                    that.category_id = data.id
                }).val(that.sub_category.category_id).trigger('change');
            that.category_id = that.sub_category.category_id;
        }, 500);
    },
    computed: {
        ...mapGetters(['get_asset_sub_category_single_data', 'get_asset_category_data']),
        sub_category: function () {
          return this.get_asset_sub_category_single_data
        },
        category_data: function () {
            return this.get_asset_category_data
        } 
        
    }
};
</script>

<style>
</style>
