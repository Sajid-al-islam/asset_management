<template>
    <section class="p-lg-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-md-8 mx-auto">
                

                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Quotation</h5> <small class="text-muted float-end">Create new Quotation</small>
                    </div>
                    <div class="card-body">
                        <div class="row g-3" v-if="img_url">
                            <div class="col-md-3">
                                <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="img_url" height="100" width="100" alt="User avatar">
                            </div>
                        </div>
                        <form @submit.prevent="addQuotation($event.target)">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Name</label>
                                <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="Computer quotation">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Description</label>
                                <textarea class="form-control" name="description" id="" cols="10" rows="3"></textarea>
                            </div>
                            <!-- <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Quote Location</label>
                                <input type="text" name="location" class="form-control" id="basic-default-fullname" placeholder="startech">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Quote mobile number</label>
                                <input type="text" name="mobile_number" class="form-control" id="basic-default-fullname" placeholder="015848544">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Location address</label>
                                <input type="text" name="address" class="form-control" id="basic-default-fullname" placeholder="Multiplan Center, Shop-934, 943, Level-09">
                            </div> -->

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Quotation scan copy</label>
                                <input type="file" @change="imageShow" name="image" class="form-control" id="basic-default-fullname">
                            </div>
                            
                            <div class="row mt-3">
                                <div class="mb-3" data-repeater-list="group-a">
                                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                        <label class="form-label" for="collapsible-address"><h5>Items</h5></label>
                                        <div class="d-flex border rounded position-relative pe-0 mt-2" v-for="(input,index) in quote_items" :key="index">
                                            <div class="row w-100 p-3">
                                                <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">shop Name</p>
                                                    <input type="text" v-model="input.shop_name" class="form-control invoice-item-price mb-3" placeholder="startech" />
                                                </div>
                                                <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Title</p>
                                                    <input type="text" v-model="input.title" class="form-control invoice-item-price mb-3" placeholder="model" />
                                                </div>
                                                <div class="col-md-5 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Description</p>
                                                    <input type="text" v-model="input.description" class="form-control invoice-item-price mb-3" placeholder="inspiration 3000" />
                                                </div>
                                                <div class="col-md-5 col-12 mb-md-0 mb-3">
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
                                        <div class="row w-100 p-3">
                                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                
                                            </div>
                                            <div class="col-md-4 col-12 mb-md-0 mb-3">
                                                
                                            </div>
                                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                <h5 class="float-right">Total: {{ Total }}</h5>
                                            </div>
                                            <div class="col-md-2 col-6">
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
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
            user: '',
            img_url: '',
            quote_img: '',
            total: '',
            quote_items: [
                {
                    shop_name: "",
                    title: "",
                    description: "",
                    price: 0
                }
            ],
        }
    },
    computed: {

        Total: function() {
            let total = 0;

            this.quote_items.forEach(item => {
                total += parseInt(item.price);
            });
            return parseInt(total);
        },
    },
    methods: {
        ...mapActions(['create_quotation']),
        imageShow(e) {
            this.quote_img = e.target.files[0];
            this.img_url = URL.createObjectURL(this.quote_img);
        },
        addQuotation: async function(event) {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData(event);
            formData.append('quote_items', JSON.stringify(this.quote_items))
            formData.append('image', this.quote_img);

            let data = {
                formData: formData,
                config: config
            }

            let res = await this.create_quotation(data);
            event.reset();
            window.s_alert('success',res.data.message);
        },
        // add specification
        addSpecification() {
            this.quote_items.push({
                shop_name: "",
                title: "",
                description: "",
                price: 0
            })
        },

        // remove specification
        removeSpecification(index) {
            this.quote_items.splice(index, 1)
        },
    },
    created: async function()  {
        
    },
};
</script>

<style>
</style>
