<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <h4 class="justify-content-start">
                Asset Details
            </h4>
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                    <div class="card invoice-preview-card" id="print_body">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                                
                                <div class="mb-xl-0 mb-4">
                                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                        <span class="fw-bold fs-4 ms-0">
                                            Asset Name: {{ asset.name }}
                                        </span>
                                    </div>
                                    <p class="mb-2"><span><b>Asset Code: </b></span>{{ asset.code }}</p>
                                    <p class="mb-2"><span><b>V no: </b></span>{{ asset.v_no }}</p>
                                    <p class="mb-2"><span><b>SV no: </b></span>{{ asset.sv_no }}</p>
                                    <p class="mb-2"><span><b>Category: </b></span>{{ asset.category.name }}</p>
                                    <p class="mb-2"><span><b>Sub Category: </b></span>{{ asset.sub_category.name }}</p>
                                    
                                    <p class="mb-2"><span><b>Location: </b></span>{{ asset.location }}</p>
                                    <!-- <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p> -->
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="my-0" /> -->
                        <div class="divider">
                            <div class="divider-text">
                                <h4>User Details:</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="pt-1">
                                    <span><b>Name of user: </b></span>
                                    <span class="fw-semibold" v-if="asset.user">{{ asset.user.first_name }} {{ asset.user.last_name }}</span>
                                </div>
                                <div class="mb-2 pt-1">
                                    <span><b>Hand Over date:</b></span>
                                    <span v-if="asset.hand_over" class="fw-semibold">{{ asset.hand_over[1] }}</span>
                                </div>
                                <div class="pt-1">
                                    <span><b>Mobile no: </b></span>
                                    <span class="fw-semibold" v-if="asset.user">{{ asset.designation_mobile_number }}</span>
                                </div>
                                <div class="pt-1">
                                    <span><b>Current status: </b></span>
                                    <span v-if="asset.is_lost == 0" class="badge bg-label-success me-1">Available</span>
                                    <span v-else class="badge bg-label-danger me-1">Lost</span>
                                </div>
                                <!-- <div class="col-xl-12 col-md-12 col-sm-12 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4 mx-auto">
                                    <h4 class="mb-3">Description:</h4>
                                    <p>{{ asset.description }}</p>
                                </div> -->
                                
                                    <ul>
                                        <!-- <li class="d-flex gap-2">
                                            <h5 class="mb-0">
                                                    <span class="badge bg-label-primary p-2 rounded">
                                                        <i class="fa-solid fa-list-check"></i>
                                                    </span>
                                                Category: 
                                            </h5>
                                            <p v-if="asset.category" class="mb-0">{{ asset.category.name }}</p>
                                            
                                        </li>
                                        <li class="d-flex gap-2 my-2" v-if="asset.sub_category">
                                            <h5 class="mb-0">
                                                <span class="badge bg-label-primary p-2 rounded">
                                                    <i class="fa-solid fa-list-check"></i>
                                                </span>
                                            Sub Category: 
                                            </h5>
                                            <p class="mb-0">{{ asset.sub_category.name }}</p>
                                        </li> -->
                                        <!-- <li class="d-flex align-items-center gap-2 my-2" v-if="asset.sub_category">
                                            <h5 class="mb-0">
                                                <span class="badge bg-label-primary p-2 rounded">
                                                    <i class="fa-solid fa-list-check"></i>
                                                </span>
                                                Current status:  
                                            </h5>
                                            <span v-if="asset.is_lost == 0" class="badge bg-label-success me-1">Available</span>
                                            <span v-else class="badge bg-label-danger me-1">Lost</span>
                                        </li> -->
                                        
                                        <span v-if="asset.asset_lost">
                                            <li class="d-flex align-items-center gap-2 my-2">
                                                <h5 v-if="asset.sub_category" class="mb-0">
                                                    <span class="badge bg-label-primary p-2 rounded">
                                                        <i class="fa-solid fa-list-check"></i>
                                                    </span>
                                                    Lost Date:  
                                                </h5>
                                                <p class="mb-0">{{ asset.asset_lost.lost_date }}</p>
                                            </li>
                                            <li class="d-flex align-items-center gap-2 my-2">
                                                <h5 v-if="asset.sub_category" class="mb-0">
                                                    <span class="badge bg-label-primary p-2 rounded">
                                                        <i class="fa-solid fa-list-check"></i>
                                                    </span>
                                                    Lost Description:  
                                                </h5>
                                                <p class="mb-0">{{ asset.asset_lost.lost_reason }}</p>
                                            </li>
                                        </span>
                                        
                                    </ul>
                                        
                                    

                                    
                                
                                <!-- <div class="col-xl-6 col-md-6 col-sm-7 col-6">
                                    <h5 class="mt-2">Category:</h5>
                                    <button type="button" class="btn btn-outline-primary waves-effect">{{ asset.category.name }}</button>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-7 col-6">
                                    <h5 class="mt-2">Sub Category:</h5>
                                    <button type="button" class="btn btn-outline-primary waves-effect">{{ asset.sub_category.name }}</button>
                                </div> -->
                            </div>
                        </div>
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Current Value</th>
                                        <th>Depreciation amount</th>
                                        <th>Buying location</th>
                                        <th>Buying location contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">{{ asset.name }}</td>
                                        <td class="fw-bold">{{ asset.price }}</td>
                                        <td><span v-if="asset.depreciated_price">{{ asset.depreciated_price }}</span></td>
                                        <td><span>{{ asset.depreciation_amount }}</span></td>
                                        <td><span v-if="asset.buy_location">{{ asset.buy_location.name }}, {{ asset.buy_location.address }}</span></td>
                                        <td><span v-if="asset.buy_location">{{ asset.buy_location.mobile_number }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <!-- <div  class="col-xl-12 col-md-12 col-sm-12 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4 mx-auto">
                            <div class="d-flex justify-content-around
                                flex-wrap mt-3 pt-3 pb-4 border-top">
                                <div class="d-flex align-items-start me-4 mt-3 gap-2">
                                    <div>
                                        <h5 class="mb-2">Lost Reasson: </h5>
                                        <p>{{ asset.asset_lost.lost_reason }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mt-3 gap-2">
                                    <div v-if="asset.sub_category">
                                        <h5 class="mb-2">Lost Date: </h5>
                                        <p>{{ asset.asset_lost.lost_date }}</p>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="spec mt-5 mb-5" v-if="asset.asset_specification && asset.asset_specification.length>0">
                            <div class="divider"><div class="divider-text"><h4>Specifications:</h4></div></div>
                            <div class="table-responsive border-top">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Desciption</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(asset_spec, index) in asset.asset_specification" :key="index">
                                            <td class="fw-bold">{{ index+1 }}</td>
                                            <td class="fw-bold">{{ asset_spec.title }}</td>
                                            <td>{{ asset_spec.value }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0 signature_div">
                            <div class="mt-5 signature_single_form">
                                <p class="signature_asset">Receiver Signature</p>
                            </div>

                            <div class="mt-5 signature_single_form">
                                <p class="signature_asset">Director Signature</p>
                            </div>

                            <div class="mt-5 signature_single_form">
                                <p class="signature_asset">Assistant Director Signature</p>
                            </div>
                        </div>
                        
                        <div class="row price_change_history" v-if="asset.price_history">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Price change history</h5>
                                    <div class="card-body pb-0">
                                        <ul class="timeline mb-0">
                                            <li v-for="(price, index) in asset.price_history" :key="index" class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-3">
                                                        <h5 class="mb-0">Price: {{ price.price }}</h5>
                                                        
                                                        <span style="font-size: 17px;">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                            {{ price.date[4] }}
                                                        </span>
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="card-body mx-3 mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-semibold">Note:</span>
                                    <span>Asset details can be edited in assset page</span>
                                </div>
                            </div>
                        </div> -->
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
                            <router-link :to="{ name:'assetEdit' , params: { id: asset.id } }">
                                <a href="javascript:void(0)" class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">
                                    Edit Asset
                                </a>
                            </router-link>
                        </div>
                    </div>
                    <div class="card quote_img" v-if="asset.image">
                        <div class="card-header">
                            Asset Image
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a :href="asset_image()" target="_blank">
                                        <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="asset_image()" height="100" width="100" alt="User avatar">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card quote_img" v-if="asset.asset_voucher_img">
                        <div class="card-header">
                            Asset Voucher
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a :href="asset_voucher_img()" target="_blank">
                                        <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="asset_voucher_img()" height="100" width="100" alt="User avatar">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Actions -->
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
            id: '',
            printing: false,
        }
    },
    methods: {
        ...mapActions(['fetch_asset_single']),
        asset_image() {
            let path = "/";
            return path+this.get_asset_single_data.image;
        },
        asset_voucher_img() {
            let path = "/";
            return path+this.get_asset_single_data.asset_voucher_img;
        },
        print: function() {
            window.print();
        },
     },
    
    created: async function() {
        this.id = this.$route.params.id
        
        await this.fetch_asset_single(this.id);
    },

    computed: {
        ...mapGetters(['get_asset_single_data']),
        
        asset: function () {
    
          return this.get_asset_single_data
        }
        
    }
};
</script>

<style>
.signature_asset {
    border-top:1px solid rgb(199, 199, 199);
}

</style>
