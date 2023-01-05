<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-8 col-md-8 mx-auto">
                
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Quotation</h5> <small class="text-muted float-end">Create new Quotation</small>
                    </div>
                    <div class="card-body">
                        
                        <form @submit.prevent="addQuotation($event.target)">
                            <div class="quote_single">
                                <table border="1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>shop</td>
                                            <td>shop mobile number</td>
                                            <td>product</td>
                                            <td>des</td>
                                            <td>price</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in products" :key="index">
                                            <td v-if="item.parent == null" :rowspan="item.total_child+1">
                                                <span class="mt-3">
                                                    <input type="text" placeholder="shop name" v-model="item.shop_name" class="form-control sm">
                                                </span>
                                                <span v-if="item.parent == null" class="pt-3">
                                                    <span class="text-primary cursor_pointer" @click="QuotationIncrease(item, index)">add</span>
                                                    <span class="text-danger cursor_pointer" v-if="products.length>2" @click="RemoveQuotation(item, index)">remove</span>
                                                </span>
                                            </td>
                                            <td v-if="item.parent == null" :rowspan="item.total_child+1">
                                                <input type="text" placeholder="shop mobile number" v-model="item.mobile_number" class="form-control sm">
                                            </td>
                                            <td v-if="item.parent !== null">
                                                <input type="text" v-model="item.product_name" class="form-control sm">

                                                <span v-if="item.parent !== null" class="pt-3">
                                                    <button type="button" class="btn btn-primary btn-sm" @click="QuotationItemIncrease(item, index)"><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" v-if="products.length>2" @click="RemoveQuotationItem(item, index)"><i class="fa fa-trash"></i></button>
                                                </span>
                                            </td>
                                            <td v-if="item.parent !== null">
                                                <input type="text" v-model="item.product_description" class="form-control sm">
                                            </td>
                                            <td v-if="item.parent !== null">
                                                <input type="text" v-model="item.product_price" class="form-control sm">
                                            </td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            
                            <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">Submit</button>
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
                    title: "",
                    description: "",
                    price: 0
                }
            ],
            products: [
                {
                    parent: null,
                    serial: 1,
                    total_child: 1,
                    shop_name: "",
                    mobile_number: "",
                    product_name: null,
                    product_description: null,
                    product_price: null
                },
                {
                    parent: 1,
                    serial: null,
                    total_child:null,
                    shop_name: null,
                    mobile_number: null,
                    product_name: "",
                    product_description: "",
                    product_price: 0
                },
            ]
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
        
        QuotationItemIncrease: function(item, index) {
            let temp_products = [...this.products];
            let product = temp_products.find(e => e.serial == item.parent)
            product.total_child++

            console.log(item.parent);
            temp_products.splice(index+1, 0, {
                parent: item.parent,
                serial: null,
                total_child: null,
                shop_name: null,
                mobile_number: null,
                product_name: "",
                product_description: "",
                product_price: ""
            });
            this.products = [...temp_products]
            // console.log(this.products);
        },
        RemoveQuotationItem: function(item, index) {
            let temp_products = [...this.products];
            console.log(item, index);
            temp_products.splice(index-1, 1);
            let product = temp_products.find(e => e.serial == item.parent)
            product.total_child--
            this.products = [...temp_products]
        },
        RemoveQuotation: function(item, index) {
            let temp_products = [...this.products];
            console.log(item, temp_products, index);
            // temp_products = temp_products.filter(i => i.parent != item.serial)
            // temp_products = temp_products.filter(i => i.serial != item.serial)
            // this.products = [...temp_products]
            // console.log(item);
            // temp_products.find(index-1, 1);
            // this.products.splice(index, 2);
        },
        QuotationIncrease: async function(item, index) {
            let serial = item.serial+1;
            let parent = {
                parent: null,
                serial: serial,
                total_child: 1,
                shop_name: "",
                mobile_number: "",
                product_name: null,
                product_description: null,
                product_price: null
            };
            let children = {
                parent: serial,
                shop_name: null,
                mobile_number: null,
                product_name: "",
                product_description: "",
                product_price: "",
                serial: null,
            }
            this.products.push({...parent})
            this.products.push({...children})
            console.log(index, serial);
            // console.log(this.products);
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
    computed: function() {

        this.products.length('parent')
    },
    created: async function()  {
        
    },
};
</script>

<style>
</style>
