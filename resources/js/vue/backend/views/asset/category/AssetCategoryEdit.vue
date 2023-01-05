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
                        <form @submit.prevent="addCategory()">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" v-model="category.name" class="form-control" id="basic-default-fullname" placeholder="John Doe">
                                <strong class="text-danger">{{ error }}</strong>
                                <strong class="text-success">{{ success }}</strong>
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
import { mapActions } from "vuex";
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
        ...mapActions(['create_asset_category']),
        addCategory: async function() {
            await axios.post('/category/update', {
            id: this.id,
            name: this.category.name
            }).then((response) => {
                if(response.status === 200) {
                    window.s_alert('success',response.data.message);
                    // this.$router.replace({ name: 'assetCategory' })
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
        getSingleCategory() {
            axios.get('/category/single?id='+this.id).then((response) => {
                
                this.category = response.data.category;
            })
            .catch((e) => {
                console.log(e);
            });
        }
    },
    created() {
        this.id = this.$route.params.id
        this.getSingleCategory();
    },
};
</script>

<style>
</style>
