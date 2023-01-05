<template>
  <div class="assets">
    <div class="card">
        <div class="card mb-4">
            <h4 class="card-header">Edit Asset</h4>
            <form @submit.prevent="EditAsset($event.target)" enctype="multipart/form-data" class="card-body" data-select2-id="20">
                <div class="row g-3">
                    <div class="row g-3" v-if="asset.image">
                        <div class="col-md-3" v-if="asset_img">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="asset_img" height="100" width="100" alt="User avatar">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Name</h5></label>
                        <input name="name" type="text" :value="asset.name" id="multicol-username" class="form-control" placeholder="john.doe" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-confirm-password"><h5>Location</h5></label>
                            <div class="input-group input-group-merge">
                                <input name="location" :value="asset.location" type="text" class="form-control" placeholder="Eg: 2nd floor" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="formFile" class="form-label"><h5>Asset Image</h5></label>
                            <input @change="imageShow" name="asset_image" class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Category</h5></label>
                        <select id="select2Basic" v-if="category_data && category_data.length" class="category form-select">
                            <option v-for="(category, index) in category_data" :value="category.id" :key="index">{{ category.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Sub Category</h5></label>
                        <select id="select2Basic2" v-if="sub_category && sub_category.length" class="sub_category form-select" >
                            <option v-for="(sub_category, index) in sub_category" :value="sub_category.id" :key="index">{{ sub_category.name }}</option>
                        </select>
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <!-- <h6>2. Personal Info</h6> -->
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>Price</h5></label>
                        <input name="price" type="number" :value="asset.price" class="form-control phone-mask" placeholder="1000" aria-label="1000" />
                    </div>
                    <div class="col-md-6" v-if="asset.depreciated_price">
                        <label class="form-label" for="multicol-country"><h5>Current value</h5></label>
                        <input name="current_value" type="number" :value="asset.depreciated_price" disabled class="form-control"  placeholder="800" aria-label="800" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>Depreciation amount per year</h5></label>
                        <input name="depreciation_amount" type="number" :value="asset.depreciation_amount" class="form-control phone-mask" placeholder="5%" aria-label="1000" />
                    </div>
                </div>

                <hr class="my-4 mx-n4" />

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="collapsible-address"><h5>Description</h5></label>
                        <textarea name="description" v-model="asset.description" class="form-control" id="collapsible-address" rows="2" placeholder="1456, Mall Road"></textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>V no</h5></label>
                        <input name="v_no" type="text" :value="asset.v_no" class="form-control phone-mask" placeholder="Rg121" aria-label="1000" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>SV no</h5></label>
                        <input name="sv_no" type="text" :value="asset.sv_no" class="form-control" placeholder="14554" aria-label="800" />
                    </div>
                    <div class="col-md-6">
                        <span v-if="asset_voucher_img">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="asset_voucher_img" height="80" width="80" alt="User avatar"><br>
                        </span>
                        <label class="form-label" for="multicol-country"><h5>Voucher scan copy</h5></label>
                        <input @change="voucherImageShow" name="asset_voucher_img" class="form-control" type="file" id="voucher_img">
                    </div>
                    <div class="col-md-6">
                        <span v-if="asset_acceptance_img">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="asset_acceptance_img" height="80" width="80" alt="User avatar"><br>
                        </span>
                        <label class="form-label" for="multicol-country"><h5>Asset acceptance voucher</h5></label>
                        <input @change="acceptanceImageShow" name="acceptance_img" class="form-control" type="file" id="accept_voucher">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Transfered Person</h5></label>
                        <select id="select2User"  class="users form-select">
                            <option v-for="(user, index) in get_user_data" :value="user.id" :key="index">{{ user.first_name }} {{ user.last_name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-phone"><h5>Mobile number of Transfered person</h5></label>
                        <input name="designation_mobile_number" :value="asset.designation_mobile_number" type="text" id="multicol-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-birthdate"><h5>Hand over date</h5></label>
                        <input v-if="asset.hand_over" name="hand_over_date" type="date" :value="asset.hand_over[1]" class="form-control" placeholder="YYYY-MM-DD" />
                    </div>
                </div>

                <div class="row mt-3">
                    <label class="form-label" for="collapsible-address"><h5>Warrenty/Garrenty</h5></label>
                    <div class="col-6 col-md-6">
                        <div class="form-check form-check-inline">
                            <input v-if="asset.is_warrenty == 'no_warrenty'" checked @click="hideWarrenty()" name="is_warrenty" class="form-check-input" value="no_warrenty" type="radio" id="collapsible-address-type-home" />
                            <input v-else @click="hideWarrenty()" name="is_warrenty" class="form-check-input" value="no_warrenty" type="radio" id="collapsible-address-type-home" />
                            <label class="form-check-label" for="collapsible-address-type-home">No Warrenty</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input v-if="asset.is_warrenty == 'warrenty'" checked @click="showWarrenty()" name="is_warrenty" class="form-check-input" value="warrenty" type="radio" id="collapsible-address-type-home" />
                            <input v-else @click="showWarrenty()" name="is_warrenty" class="form-check-input" value="warrenty" type="radio" id="collapsible-address-type-home" />
                            <label class="form-check-label" for="collapsible-address-type-home">Warrenty</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input v-if="asset.is_warrenty == 'garrenty'" checked @click="showWarrenty()" name="is_warrenty" class="form-check-input" value="garrenty" type="radio" id="collapsible-address-type-office" />
                            <input v-else @click="showWarrenty()" name="is_warrenty" class="form-check-input" value="garrenty" type="radio" id="collapsible-address-type-office" />
                            <label class="form-check-label" for="collapsible-address-type-office">Garrenty</label>
                        </div>
                    </div>
                    <div v-if="this.warrenty === true" class="col-6 col-md-6">
                        <label class="form-label" for="collapsible-address"><h5>Warrenty/Garrenty Date</h5></label>
                        <input name="warrenty_date" :value="asset.warrenty_date_fromated[0]" type="date" class="form-control" placeholder="YYYY-MM-DD" />
                    </div>
                    <div class="col-6 col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Cs Quotation</h5></label>
                        <select id="select2Quotation"  class="quotation form-select">
                            <option v-for="(item, index) in get_quotations" :value="item.id" :key="index">{{ item.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <label class="form-check-label mt-3"><h5>Asset Status</h5></label>
                    <div class="col mt-2">
                        <div class="form-check form-check-inline">
                            <input v-if="asset.is_lost == 1" checked @click="toggleStatus()" name="is_lost" class="form-check-input"  type="radio" value="lost" id="collapsible-address-type-home" />
                            <input v-else @click="toggleStatus()" name="is_lost" class="form-check-input"  type="radio" value="lost" id="collapsible-address-type-home" />
                            <label class="form-check-label" for="collapsible-address-type-home">Lost</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input v-if="asset.is_lost == 0" checked @click="toggleStatus()" name="is_lost" class="form-check-input" type="radio" value="not_lost" id="collapsible-address-type-office"/>
                            <input v-else @click="toggleStatus()" name="is_lost" class="form-check-input" type="radio" value="not_lost" id="collapsible-address-type-office"/>
                            <label class="form-check-label" for="collapsible-address-type-office"> Not lost </label>
                        </div>
                    </div>

                    <div v-if="this.lost !== false" class="lost-wrapper">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="collapsible-address"><h5>Lost Reason</h5></label>
                                <textarea name="lost_reason" v-if="asset.asset_lost" v-model="asset.asset_lost.lost_reason" class="form-control" id="collapsible-address" rows="2" placeholder="1456, Mall Road"></textarea>
                                <textarea name="lost_reason" v-else class="form-control" id="collapsible-address" rows="2" placeholder="1456, Mall Road"></textarea>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="collapsible-address"><h5>Lost Date</h5></label>
                                <input name="lost_date" v-if="asset.asset_lost" :value="asset.asset_lost.lost_date_fromated[0]" type="date" class="form-control" placeholder="YYYY-MM-DD" />
                                <input name="lost_date" v-else type="date" class="form-control" placeholder="YYYY-MM-DD" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3" data-repeater-list="group-a">
                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                        <label class="form-label" for="collapsible-address"><h5>Specification</h5></label>
                        <div class="d-flex border rounded position-relative pe-0 mt-2" v-for="(input,index) in asset_specifications" :key="index">
                            <div class="row w-100 p-3">
                                <div class="col-md-5 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Title</p>
                                    <input type="text" v-model="input.title" class="form-control invoice-item-price mb-3" placeholder="model" />
                                </div>
                                <div class="col-md-5 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Description</p>
                                        <input type="text" v-model="input.value" class="form-control invoice-item-price mb-3" placeholder="inspiration 3000" />
                                    <div></div>
                                </div>
                                <div class="col-md-2 col-6">
                                    <p class="mb-2 repeater-title">Action</p>
                                    <button type="button" @click.prevent="addSpecification(index)" class="btn btn-primary waves-effect waves-light" data-repeater-create=""><i class="fa fa-plus"></i></button>
                                    <button v-if="asset_specifications.length>1" type="button" @click="removeSpecification(index)" class="btn btn-danger waves-effect waves-light" data-repeater-create=""><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Update</button>
                    <router-link :to="{name:'assetIndex'}">
                        <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                    </router-link>
                </div>
            </form>
            <!-- <p>{{ asset.name }}</p> -->
        </div>
    </div>
</div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
    data() {
        return {
            assets: '',
            category_id: '',
            sub_category_id: '',
            user: '',
            buy_location: '',
            id: '',
            asset_specifications: [
                {
                    title: "",
                    value: ""
                }
            ],
            img_url: null,
            voucher_img_url: null,
            acceptance_img_url: null,
            asset_img: null,
            asset_voucher_img: null,
            asset_acceptance_img: null,
            lost: false,
            warrenty: false,
            quotation: '' 
        }
    },

    created: async function()  {
        this.id = this.$route.params.id
        
        await this.fetch_asset_single(this.id);
        await this.fetch_user_all();
        await this.fetch_asset_category_all();
        await this.fetch_asset_sub_category_all();
        await this.fetch_asset_location_all();
        await this.fetch_quotation_all();
        if(this.asset.is_lost == 1) {
            this.lost = true;
        }
        
        if(this.asset.is_warrenty == 'warrenty' || this.asset.is_warrenty == 'garrenty') {
            this.warrenty = true;
        }

        if(this.get_asset_single_data.image) {
            let path = "/";
            this.asset_img = path+this.get_asset_single_data.image;
        }
        if(this.get_asset_single_data.asset_voucher_img) {
            let path = "/";
            this.asset_voucher_img = path+this.get_asset_single_data.asset_voucher_img;
        }
        if(this.get_asset_single_data.acceptance_img) {
            let path = "/";
            this.asset_acceptance_img = path+this.get_asset_single_data.acceptance_img;
            // console.log(this.asset_acceptance_img);
        }
        

    },

    watch : {
        get_asset_single_data:function(val) {
            this.asset_specifications = val.asset_specification
            const that = this;
            $('.users').on('select2:select', function (e) {
                var data = e.params.data;
                that.asset.designation_id = data.id
            }).val(that.asset.designation_id).trigger('change');
        },
        get_asset_category_data: function (val) {
            const that = this;
            setTimeout(() => {
                that.category_id = that.get_asset_category_data[0].id
                $('.category').select2({});
                $('.category').on('category:select', function (e) {
                    var data = e.params.data;
                    that.category_id = data.id
                }).val(that.asset.category_id).trigger('change');
            }, 500);
        },
        get_quotations: function (val) {
            const that = this;
            setTimeout(() => {
                this.quotation = val[0].id
                $('.quotation').off().select2({});
                $('.quotation').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.quotation = data.id
                }).val(that.asset.cs_quotation_id).trigger('change');
            }, 500);
        },
        get_asset_sub_category_data: function(val) {
            const that = this;
            setTimeout(() => {
                that.sub_category_id = that.get_asset_sub_category_data[0].id

                $('.sub_category').select2({});
                $('.sub_category').on('sub_category:select', function (e) {
                    var data = e.params.data;
                    that.sub_category_id = data.id
                }).val(that.asset.sub_category_id).trigger('change');
            }, 500);
        },
        get_user_data: function (val) {
            const that = this;
            console.log(val);
            setTimeout(() => {
                that.user = that.get_user_data[0].id
                $('.users').off().select2({});
            }, 1000);
        },

    },

    methods: {
        ...mapActions([
            'fetch_asset_category_all', 
            'fetch_asset_sub_category_all', 
            'edit_asset', 
            'fetch_asset_single',
            'fetch_asset_location_all',
            'fetch_user_all',
            'fetch_quotation_all'
        ]),
        imageShow: function(e) {
            this.img_url = URL.createObjectURL(e.target.files[0]);
            this.asset_img = this.img_url;
        },
        voucherImageShow: function(e) {
            this.voucher_img_url = URL.createObjectURL(e.target.files[0]);
            this.asset_voucher_img = this.voucher_img_url;
        },
        acceptanceImageShow: function(e) {
            this.acceptance_img_url = URL.createObjectURL(e.target.files[0]);
            this.asset_acceptance_img = this.acceptance_img_url;
        },
        ...mapMutations([]),
        toggleStatus() {
            this.lost = !this.lost;
        },
        hideWarrenty() {
            this.warrenty = false;
        },
        showWarrenty() {
            this.warrenty = true;
        },
        EditAsset: async function(event) {
            // const config = {
            //     headers: { 'content-type': 'multipart/form-data' }
            // }

            let formData = new FormData(event);
            formData.append('id', this.id);
            formData.append('category_id', this.category_id);
            formData.append('sub_category_id', this.sub_category_id);
            formData.append('designation_id', this.user);
            // formData.append('asset_image', this.asset_img);
            // formData.append('asset_voucher_img', this.asset_voucher_img);
            // formData.append('asset_acceptance_img', this.asset_acceptance_img);
            formData.append('cs_quotation_id', this.quotation);
            formData.append('asset_specification', JSON.stringify(this.asset_specifications))

            let data = {
                formData: formData,
                config: null
            }

            let res = await this.edit_asset(data)
            
            window.s_alert('success',res.data.message);
        },
        
        // add specification
        addSpecification() {
            this.asset_specifications.push({
                title: "",
                value: ""
            })
        },

        // remove specification
        removeSpecification(index) {
            this.asset_specifications.splice(index, 1)
        },
    },
    
    computed: {
        ...mapGetters([
            'get_asset_category_data',
            'get_asset_sub_category_data', 
            'get_asset_single_data',
            'get_user_data',
            'get_asset_location_data',
            'get_quotations'
        ]),
        category_data: function () {
            // console.log(this.get_asset_category_data.data);
            return this.get_asset_category_data
        },
        asset: function () {
            return this.get_asset_single_data
        },
        sub_category: function () {

            console.log(this.get_asset_sub_category_data);
            return this.get_asset_sub_category_data
        },
    },

}
    
</script>

<style>

</style>
