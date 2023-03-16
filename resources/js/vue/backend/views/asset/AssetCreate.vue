<template>
  <div class="assets">
    <div class="card">
        <div class="card mb-4">
            <h4 class="card-header">Add Asset</h4>
            
            <form @submit.prevent="AddAsset($event.target)" class="card-body" data-select2-id="20">
                <div class="row g-3" v-if="img_url">
                    <div class="col-md-3">
                        <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="img_url" height="100" width="100" alt="User avatar">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Name</h5></label>
                        <input name="name" type="text" id="multicol-username" class="form-control" placeholder="john.doe" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-password-toggle">
                            <label class="form-label" for="multicol-confirm-password"><h5>Location</h5></label>
                            <input name="location" id="multicol-username" type="text" class="form-control" placeholder="Eg: 2nd floor" />
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
                        <select id="select2Basic"  class="category form-select">
                            <option v-for="(category, index) in category_data" :value="category.id" :key="index">{{ category.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Sub Category</h5></label>
                        <select id="select2Basic2"  class="sub_category form-select" >
                            <option value="">select</option>
                            <option v-for="(sub_category, index) in selected_sub_cats" :value="sub_category.id" :key="index">{{ sub_category.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Buy Location</h5></label>
                        <select id="select2Location"  class="buy_location form-select">
                            <option v-for="(location, index) in location_data" :value="location.id" :key="index">{{ location.name }}</option>
                        </select>
                        <div class="col-lg-3 col-md-6">
                            <div class="mt-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">Buying location <i class="ms-2 fa fa-plus"></i></button>
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
                                    <div class="offcanvas-header">
                                        <button type="button" class="btn-close text-reset" id="close_location_canvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body my-auto mx-0 flex-grow-0 border-1">
                                        <h5>Add new buying location</h5>
                                        <form @submit.prevent="addLocation($event.target)">
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Name</label>
                                                <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder="Banani">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Address</label>
                                                <input type="text" name="address" class="form-control" id="basic-default-fullname" placeholder="Startech 2nd floor">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Mobile Number</label>
                                                <input type="text" name="mobile_number" class="form-control" id="basic-default-fullname" placeholder="0175*******">
                                            </div>
                                            <button type="submit" class="btn btn-primary mb-2 d-grid w-100">create</button>
                                            <!-- <button type="submit" class="btn btn-primary waves-effect waves-light"></button> -->
                                        </form>
                                        
                                        <button type="button" class="btn btn-label-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <button type="button" @click="addLocation()" class="mt-2 btn btn-primary waves-effect waves-light">Add buying location<i class="ms-2 fa fa-plus"></i></button> -->
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Buying date</h5></label>
                        <input name="buying_date" type="date" class="form-control" placeholder="YYYY-MM-DD" />
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <!-- <h6>2. Personal Info</h6> -->

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>Price</h5></label>
                        <input name="price" type="number" class="form-control phone-mask" placeholder="1000" aria-label="1000" />
                    </div>
                    <!-- <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>Current value</h5></label>
                        <input name="current_value" type="number" class="form-control" placeholder="800" aria-label="800" />
                    </div> -->

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>Depreciation amount per year</h5></label>
                        <input name="depreciation_amount" type="number" class="form-control phone-mask" placeholder="5%" aria-label="1000" />
                    </div>
                </div>


                <hr class="my-4 mx-n4" />
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="collapsible-address"><h5>Description</h5></label>
                        <textarea name="description" class="form-control" id="collapsible-address" rows="2" placeholder="1456, Mall Road"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>V no</h5></label>
                        <input name="v_no" type="text" class="form-control phone-mask" placeholder="Rg121" aria-label="1000" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-country"><h5>SV no</h5></label>
                        <input name="sv_no" type="text" class="form-control" placeholder="14554" aria-label="800" />
                    </div>
                    <div class="col-md-6">
                        <span v-if="voucher_img_url">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4" :src="voucher_img_url" height="80" width="80" alt="User avatar"><br>
                        </span>
                        <label class="form-label" for="multicol-country"><h5>Voucher scan copy</h5></label>
                        <input @change="voucherImageShow" name="asset_voucher_img" class="form-control" type="file" id="formFile">
                    </div>
                    <!-- <div class="col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Transfered Person</h5></label>
                        <select id="select2User"  class="users form-select">
                            <option v-for="(user, index) in get_user_data" :value="user.id" :key="index">{{ user.first_name }} {{ user.last_name }}</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-phone"><h5>Mobile number of Transfered person</h5></label>
                        <input name="designation_mobile_number" type="text" id="multicol-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-birthdate"><h5>Hand over date</h5></label>
                        <input name="hand_over_date" type="date" class="form-control" placeholder="YYYY-MM-DD" />
                    </div> -->
                </div>

                
                
                <div class="row mt-3">
                    <label class="form-label" for="collapsible-address"><h5>Warrenty/Garrenty</h5></label>
                    <div class="col-6 col-md-6">
                        <div class="form-check form-check-inline">
                            <input @click="hideWarrenty()" name="is_warrenty" class="form-check-input" value="no_warrenty" type="radio" id="collapsible-address-type-home" />
                            <label class="form-check-label" for="collapsible-address-type-home">No Warrenty</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input @click="showWarrenty()" name="is_warrenty" class="form-check-input" value="warrenty" type="radio" id="collapsible-address-type-home" />
                            <label class="form-check-label" for="collapsible-address-type-home">Warrenty</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input @click="showWarrenty()" name="is_warrenty" class="form-check-input" value="garrenty" type="radio" id="collapsible-address-type-office" />
                            <label class="form-check-label" for="collapsible-address-type-office">Garrenty</label>
                        </div>
                    </div>
                    <div v-if="this.warrenty === true" class="col-6 col-md-6">
                        <label class="form-label" for="collapsible-address"><h5>Warrenty/Garrenty Date</h5></label>
                        <input name="warrenty_date" type="date" class="form-control" placeholder="YYYY-MM-DD" />
                    </div>
                    <div class="col-6 col-md-6">
                        <label class="form-label" for="multicol-username"><h5>Cs Quotation</h5></label>
                        <select id="select2User"  class="quotation form-select">
                            <option value="">Select Quotation</option>
                            <option v-for="(item, index) in get_quotations" :value="item.id" :key="index">{{ item.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <label class="form-check-label mt-3"><h5>Asset Status</h5></label>
                    <div class="col mt-2">
                        <div class="form-check form-check-inline">
                            <input @click="toggleStatus()" name="is_lost" class="form-check-input"  type="radio" value="lost" id="collapsible-address-type-home" />
                            <label class="form-check-label" for="collapsible-address-type-home">Lost</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input @click="toggleStatus()" name="is_lost" class="form-check-input" type="radio" value="not_lost" id="collapsible-address-type-office" checked="" />
                            <label class="form-check-label" for="collapsible-address-type-office"> Not lost </label>
                        </div>
                    </div>

                    <div v-if="this.lost !== false" class="lost-wrapper">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label" for="collapsible-address"><h5>Lost Reason</h5></label>
                                <textarea name="lost_reason" class="form-control" id="collapsible-address" rows="2" placeholder="1456, Mall Road"></textarea>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="collapsible-address"><h5>Lost Date</h5></label>
                                <input name="lost_date" type="date" class="form-control" placeholder="YYYY-MM-DD" />
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="row mt-3">
                    
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
                                            <input type="text" v-model="input.description" class="form-control invoice-item-price mb-3" placeholder="inspiration 3000" />
                                        <div></div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <p class="mb-2 repeater-title">Action</p>
                                        <button type="button" @click="addSpecification(index)" class="btn btn-primary waves-effect waves-light" data-repeater-create=""><i class="fa fa-plus"></i></button>
                                        <button v-if="asset_specifications.length>1" type="button" @click="removeSpecification(index)" class="btn btn-danger waves-effect waves-light" data-repeater-create=""><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
                    <router-link :to="{name:'assetIndex'}">
                        <button type="reset" class="btn btn-label-secondary waves-effect">back</button>
                    </router-link>
                </div>
            </form>
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
            selected_sub_cats: '',
            buy_location: '',
            user: '',
            asset_specifications: [
                {
                    title: "",
                    description: ""
                }
            ],
            img_url: null,
            voucher_img_url: null,
            asset_img: null,
            asset_voucher_img: null,
            lost: false,
            warrenty: false,
            quotation: ''            
        }
    },
    methods: {
        // Getting the actions
        ...mapActions([
            'fetch_asset_category_all', 
            'fetch_asset_sub_category_all', 
            'create_asset', 
            'fetch_asset_location_all',
            'fetch_quotation_all',
            'add_location_quick'
        ]),
        imageShow(e) {
            this.asset_img = e.target.files[0];
            this.img_url = URL.createObjectURL(this.asset_img);
        },
        voucherImageShow(e) {
            this.asset_voucher_img = e.target.files[0];
            this.voucher_img_url = URL.createObjectURL(this.asset_voucher_img);
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

        // Adding asset with store
        AddAsset: async function(event) {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            let formData = new FormData(event);
            formData.append('category_id', this.category_id);
            formData.append('sub_category_id', this.sub_category_id);
            formData.append('designation_id', this.user);
            formData.append('buy_location_id', this.buy_location);
            formData.append('asset_image', this.asset_img);
            formData.append('asset_voucher_img', this.asset_voucher_img);
            formData.append('cs_quotation_id', this.quotation);
            formData.append('asset_specification', JSON.stringify(this.asset_specifications))

            let data = {
                formData: formData,
                config: config
            }

            let res = await this.create_asset(data)
            window.s_alert('success',res.data.message);
            event.reset();
        },
        addLocation: async function(event) {
            let formData = new FormData(event);
            let res = await this.add_location_quick(formData)
            event.reset()
            let ofcanvas_el = document.getElementById("offcanvasEnd"); 
            let offcanvas = new bootstrap.Offcanvas(ofcanvas_el, {backdrop: true})
            offcanvas.hide()
            window.s_alert('success',res.data.message);
        },
        // add specification
        addSpecification() {
            this.asset_specifications.push({
                title: "",
                description: ""
            })
        },

        // remove specification
        removeSpecification(index) {
            this.asset_specifications.splice(index, 1)
        },

        // Getting the dependent sub category
        getSubCategory: async function(id) {
            await axios.get('/asset/getSubCategory?category_id='+id)
            .then((res) => {
                this.selected_sub_cats = res.data;
                console.log(res.data);
            })
        }
    },
    created: async function()  {
    
        // fetching the categories and sub categories
        await this.fetch_asset_category_all();
        await this.fetch_asset_location_all();
        // await this.fetch_user_all();
        await this.fetch_quotation_all();
    },
    watch : {
        get_asset_category_data:function(val) {
            if(val.length>0) {
                this.category_id = val[0].id
            }
            this.getSubCategory(val[0].id);
            const that = this;
            setTimeout(() => {
                $('.category').off().select2({});
                $('.category').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.category_id = data.id
                    that.getSubCategory(data.id)
                });
            }, 500);
        },
        get_asset_location_data:function(val) {
            
            if(val.length>0) {
                this.buy_location = val[0].id
            }
            const that = this;
            setTimeout(() => {
                $('.buy_location').off().select2({});
                $('.buy_location').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.buy_location = data.id
                });
            }, 500);
        },
        // get_user_data: function (val) {
        //     if(val.length>0) {
            
        //         this.user = val[0].id
        //     }
        //     const that = this;
        //     setTimeout(() => {
        //         $('.users').off().select2({});
        //         $('.users').on('select2:select', function (e) {
        //             var data = e.params.data;
        //             that.user = data.id
        //         });
        //     }, 500);
        // },
        get_quotations: function (val) {
            // if(val.length>0) {
            //     this.quotation = val[0].id
            // }
            const that = this;
            setTimeout(() => {
                $('.quotation').off().select2({});
                $('.quotation').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.quotation = data.id
                });
            }, 500);
        },
        selected_sub_cats:function(val) {
            const that = this;
            setTimeout(() => {
                $('.sub_category').off().select2({});
                $('.sub_category').on('select2:select', function (e) {
                    var data = e.params.data;
                    that.sub_category_id = data.id
                });
            }, 500);
        }
    },
    computed: {
        // mapping the getters
        ...mapGetters([
            'get_asset_category_data', 
            'get_asset_sub_category_data', 
            'get_asset_location_data',
            // 'get_user_data',
            'get_quotations'
        ]),

        // returning the category data with new var from store
        category_data: function () {
            return this.get_asset_category_data
        },
        location_data: function () {
            return this.get_asset_location_data
        }
        // sub_category: function () {
        //   return this.get_asset_sub_category_data
        // },
    },

}
    
</script>

<style>

</style>
