<template>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card" id="print_body">
                    <div class="card-body">
                        <div class="m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4" style="float: left;">
                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#7367F0"
                                        ></path>
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                                    </svg>

                                    <span class="app-brand-text fw-bold fs-4">
                                        {{ get_quotation_single.name }}
                                    </span>
                                </div>
                                <p class="mb-2">{{ get_quotation_single.address}}</p>
                                <p class="mb-0">{{ get_quotation_single.mobile_number }}</p>
                            </div>
                            <div style="float: right;">
                                <h4 class="fw-semibold mb-2">INVOICE #{{ get_quotation_single.code }}</h4>
                                <div class="mb-2 pt-1">
                                    <span>Date Issues:</span>
                                    <span v-if="get_quotation_single.date" class="fw-semibold">{{ get_quotation_single.date[1] }}</span>
                                </div>
                                <!-- <div class="pt-1">
                                    <span>Date Due:</span>
                                    <span class="fw-semibold">May 25, 2021</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="p-sm-3 p-0">
                            <div class="mb-xl-0 mb-md-4 mb-sm-0 mb-4" style="float: left;">
                                <h6 class="mb-3">Invoice To:</h6>
                                <!-- <p class="mb-1">Thomas shelby</p> -->
                                <p class="mb-1">TechPark It limited</p>
                                <p class="mb-1">Lane Number 1, Mirpur 6, Dhaka 1216</p>
                                <p class="mb-1">01781-442288</p>
                                <p class="mb-0">contact@techpartit.org</p>
                            </div>
                            <div class="" style="float: right;">
                                <!-- <h6 class="mb-4">Bill To:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-4">Total Due:</td>
                                            <td><strong>$12,110.55</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4 mx-auto">
                                <h5 class="mb-2">Name: <span class="lead">{{ get_quotation_single.name }}</span></h5>
                                
                                <h5 class="mb-2">Description:</h5>
                                <p>{{ get_quotation_single.description }}</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="table-responsive border-top">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in get_quotation_single.quotation_items" :key="index">
                                    <td class="text-nowrap">{{ item.title }}</td>
                                    <td class="text-nowrap">{{ item.description }}</td>
                                    <td>{{ item.price }}</td>
                                    <td>1</td>
                                    <td>{{ item.price }}</td>
                                </tr>
                                <!-- <tr>
                                    <td colspan="3" class="align-top px-4 py-4">
                                        <span class="ms-3">Thanks for your business</span>
                                    </td>
                                    <td class="text-end pe-3 py-4">
                                        <p class="mb-2 pt-3">Subtotal:</p>
                                        <p class="mb-0 pb-3">Total:</p>
                                    </td>
                                    <td class="ps-2 py-4">
                                        <p class="fw-semibold mb-2 pt-3">{{ total }}</p>
                                        <p class="fw-semibold mb-0 pb-3">{{ total }}</p>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-semibold">Note:</span>
                                <span>This Quotation is made by {{ get_quotation_single.location }} for TechPark IT Limited.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect" @click="print()" href="javascript:void(0)">
                            Print
                        </a>
                        <router-link :to="{ name:'quotationEdit' , params: { id: get_quotation_single.id } }">
                            <a href="javascript:void(0)" class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">
                                Edit Cs Quotation
                            </a>
                        </router-link>
                    </div>
                </div>
                <div class="card quote_img" v-if="get_quotation_single.image">
                    <div class="card-header">
                        Quotation Scan Copy
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <a :href="quote_image()" target="_blank">
                                    <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="quote_image()" height="100" width="100" alt="User avatar">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            id: '',
            total: 0
        }
    },
    
    methods: {
        Total: function() {
            this.get_quotation_single.quotation_items.forEach(item => {
                this.total += parseInt(item.price);
            });
        },
        ...mapActions(['fetch_quotation_single']),
        print: function() {
            window.print();
        },
        quote_image() {
            let path = "uploads/images/";
            return path+this.get_quotation_single.image;
        }
    },
    created: async function() {
        this.id = this.$route.params.id
        
        await this.fetch_quotation_single(this.id);
        this.Total();
    },
    computed: {
        ...mapGetters(['get_quotation_single']),
    }
}
</script>