<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 col-md-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Quotations</h5> <small class="text-muted float-end">Update the quotation</small>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="updateQuotation($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="name" :value="get_quotation_single.name" class="form-control" id="basic-default-fullname" placeholder="Yearly Audit">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Description</label>
                                <textarea class="form-control" :value="get_quotation_single.description" name="description" id="" cols="10" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Location</label>
                                <input type="text" name="location" :value="get_quotation_single.location" class="form-control" id="basic-default-fullname" placeholder="startech">
                            </div>
                            
                            <div class="row mt-3">
                                <div class="mb-3" data-repeater-list="group-a">
                                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                        <label class="form-label" for="collapsible-address"><h5>Items</h5></label>
                                        <div class="d-flex border rounded position-relative pe-0 mt-2" v-for="(input,index) in quote_items" :key="index">
                                            <div class="row w-100 p-3">
                                                <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Title</p>
                                                    <input type="text" v-model="input.title" class="form-control invoice-item-price mb-3" placeholder="model" />
                                                </div>
                                                <div class="col-md-4 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Description</p>
                                                    <input type="text" v-model="input.description" class="form-control invoice-item-price mb-3" placeholder="inspiration 3000" />
                                                </div>
                                                <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Price</p>
                                                    <input type="text" v-model="input.price" class="form-control invoice-item-price mb-3" placeholder="5000" />
                                                </div>
                                                <div class="col-md-2 col-6">
                                                    <p class="mb-2 repeater-title">Action</p>
                                                    <div class="d-flex">
                                                        <button type="button" @click="addSpecification(index)" class="btn btn-primary waves-effect waves-light mr-1"><i class="fa fa-plus"></i></button>
                                                        <button v-if="quote_items.length>1" type="button" @click="removeSpecification(index)" class="btn btn-danger waves-effect waves-light"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
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
            user: '',
            id: '',
            quote_items: [
                {
                    title: "",
                    description: "",
                    price: ""
                }
            ],
        }
    },

    watch: {
        get_quotation_single:function(val) {
            this.quote_items = val.quotation_items
            // const that = this;
            // $('.users').on('select2:select', function (e) {
            //     var data = e.params.data;
            //     that.asset.designation_id = data.id
            // }).val(that.asset.designation_id).trigger('change');
        },
    },
    
    methods: {
        ...mapActions(['update_quotation', 'fetch_quotation_single']),
        updateQuotation: async function(event) {
            let formData = new FormData(event);
            formData.append('id', this.id)
            formData.append('quote_items', JSON.stringify(this.quote_items))
            let res = await this.update_quotation(formData)
            window.s_alert('success',res.data.message);
        },
        // add specification
        addSpecification() {
            this.quote_items.push({
                title: "",
                description: "",
                price: ""
            })
        },

        // remove specification
        removeSpecification(index) {
            this.quote_items.splice(index, 1)
        },
    },
    created: async function()  {
        this.id = this.$route.params.id
        
        await this.fetch_quotation_single(this.id);
    },
    computed: {
        ...mapGetters(['get_quotation_single']),
    }
};
</script>

<style>
</style>
