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
                        
                        <form @submit.prevent="addQuotation($event.target)">
                            <div class="quote_single table-responsive">
                                <table border="1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>shop</td>
                                            <td>shop mobile number</td>
                                            <td style="width: 150px;">product</td>
                                            <td style="width: 150px;">description</td>
                                            <td style="width: 150px;">price</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in products" :key="index">
                                            <td> {{ item.shop_name }} {{ index }}</td>
                                            <td>{{ item.mobile_number }}</td>
                                            <td colspan="3" class="p-0">
                                                <table border="1px" class="table table-bordered">
                                                    <tbody>
                                                        <tr v-for="(child, index2) in item.childrens" :key="index2">
                                                            <td style="width: 150px;">{{ child.product_name }}</td>
                                                            <td style="width: 150px;">{{ child.product_description }}</td>
                                                            <td style="width: 150px;">{{ child.product_price }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><button type="button" @click="addShop()">Add Quotation</button></td>
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
                    total_child: 2,
                    shop_name: "Startech",
                    mobile_number: "01789456",
                    product_name: null,
                    product_description: null,
                    product_price: null,
                    childrens: [
                        {
                            parent: null,
                            serial: null,
                            total_child: null,
                            shop_name: null,
                            mobile_number: null,
                            product_name: "Computer",
                            product_description: "desktop computer",
                            product_price: 1245,
                        },
                        {
                            parent: null,
                            serial: null,
                            total_child: null,
                            shop_name: null,
                            mobile_number: null,
                            product_name: "Mobile",
                            product_description: "smart phone",
                            product_price: 1245,
                        }
                    ]
                },
                {
                    parent: null,
                    serial: 2,
                    total_child: 1,
                    shop_name: "Ryans",
                    mobile_number: "01345788",
                    product_name: null,
                    product_description: null,
                    product_price: null,
                    childrens: [
                        {
                            parent: null,
                            serial: null,
                            total_child: null,
                            shop_name: null,
                            mobile_number: null,
                            product_name: "Network pc",
                            product_description: "Network desktop computer",
                            product_price: 1245,
                        },
                        
                    ]
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
