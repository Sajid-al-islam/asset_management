<template>
    <section class="p-5">
        <div class="row">
            <!-- Invoice repeater -->
            <h4 class="justify-content-start">
                Audit Details
            </h4>
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                                <div class="mb-xl-0 mb-4">
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
                                            {{ get_audit_single.title }}
                                        </span>
                                    </div>
                                    <h5 class="justify-content-start">
                                        Total Assets: {{ get_audit_single.audit_complete.total_asset }} 
                                        </h5>
                                        <h5 class="justify-content-start">
                                        Audited Assets: {{ get_audit_single.audit_complete.audited_asset }} 
                                    </h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button @click="filterAudited()" type="button" class="btn btn-outline-primary waves-effect">Audited assets</button>
                                        <button @click="filterNotAudited()" type="button" class="btn btn-outline-primary waves-effect">Not audited assets</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="divider">
                            <div class="divider-text"><h3>Assets:</h3></div>
                        </div>
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>price</th>
                                        <th>V no</th>
                                        <th>SV no</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody v-if="showAudited === false">
                                    <tr v-for="(sub, index) in get_audit_assets.data" :key="index">
                                        <td class="sorting_1"><a href="#">#{{ index+1 }}</a></td>
                                        <td class="sorting_1">
                                            <a href="javascript:void(0)"><p class="fw-bold">{{ sub.name }}</p></a>
                                            <!-- <span class="badge bg-label-primary px-3 py-2"><p class="m-0 p-0 fw-semibold text-primary"><strong>{{ sub.name }}</strong></p></span> -->
                                        </td>
                                        <td class="text-nowrap">{{ sub.price }}</td>
                                        <td class="text-nowrap">{{ sub.v_no }}</td>
                                        <td class="text-nowrap">{{ sub.sv_no }}</td>
                                        <td class="text-nowrap">{{ sub.date[2] }}</td>
                                        <td>
                                            <span v-if="sub.status == 1" class="badge bg-label-success me-1">Available</span>
                                            <span v-else class="badge bg-label-danger me-1">Not Available</span>
                                        </td>
                                        <td v-if="showAction">
                                            <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                                                <li>
                                                    <a class="btn btn-sm btn-outline-success" @click="show_asset_Modal(sub.id, status=1)" href="javascript:void(0);"><i class="fa-solid fa-check me-1"></i> Ok</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-sm btn-outline-danger" @click="show_asset_Modal(sub.id, status=0)" href="javascript:void(0);"><i class="fa-solid fa-close me-1"></i> Not ok</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-if="showAudited === true">
                                    <!-- <p>{{ get_audit_assets.audit_assets[0].assets }}</p> -->
                                    <tr v-for="(sub, index) in get_audit_assets.audit_assets" :key="index">
                                        <td class="sorting_1"><a href="#">#{{ index+1 }}</a></td>
                                        <td class="sorting_1">
                                            <a href="javascript:void(0)"><p class="fw-bold">{{ sub.assets.name }}</p></a>
                                            <!-- <span class="badge bg-label-primary px-3 py-2"><p class="m-0 p-0 fw-semibold text-primary"><strong>{{ sub.name }}</strong></p></span> -->
                                        </td>
                                        <td class="text-nowrap">{{ sub.assets.price }}</td>
                                        <td class="text-nowrap">{{ sub.assets.v_no }}</td>
                                        <td class="text-nowrap">{{ sub.assets.sv_no }}</td>
                                        <td class="text-nowrap">{{ sub.assets.date[2] }}</td>
                                        <td>
                                            <span v-if="sub.assets.status == 1" class="badge bg-label-success me-1">Available</span>
                                            <span v-else class="badge bg-label-danger me-1">Not Available</span>
                                        </td>
                                        <td class="text-nowrap">{{ sub.comment }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body mx-3">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-semibold">Note:</span>
                                    <span>Change the categories from category pages</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice -->
            </div>

            <!-- /Invoice repeater -->
        </div>
        
        <!-- Modal -->
        <div class="modal fade" :class="{show: showModal, 'd-block':showModal}" id="basicModal" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Asset audit comment</h5>
                        <button @click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="submitAudit()">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Comment</label>
                                    <textarea type="text" v-model="audit_asset.comment" id="nameBasic" class="form-control" placeholder="Enter audit comment" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="closeModal()" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {
            id: '',
            showModal: false,
            showAudited: false,
            audit_asset: {
                audit_id: '',
                asset_id: '',
                status: '',
                comment: '',
            },
            showAction: true
        }
    },
    methods: {
        ...mapActions([
            'fetch_audit_single',
            'fetch_audited_assets',
            'fetch_not_audited_assets',
            'update_audit_asset_status'
        ]),
        show_asset_Modal(asset_id, status) {
            this.audit_asset.asset_id = asset_id;
            this.audit_asset.status = status;
            this.audit_asset.audit_id = this.id;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        submitAudit: async function() {
            let res = await this.update_audit_asset_status(this.audit_asset)
            this.closeModal();
            this.audit_asset.asset_id = null;
            this.audit_asset.status = null;
            this.audit_asset.comment = null;
            window.s_alert('success',res.data.message);
        },
        async filterAudited() {
            this.showAction = false;
            this.showAudited = true;
            let param1 = {
                id: this.id,
                page: 1,
            }
            await this.fetch_audited_assets(param1);
        },
        async filterNotAudited() {
            this.showAction = true;
            this.showAudited = false;
            let param2 = {
                id: this.id,
                page: 1,
            }
            await this.fetch_not_audited_assets(param2);
        }
    },
    
    created: async function() {
        this.id = this.$route.params.id
        
        let param2 = {
            id: this.id,
            page: 1,
        }

        await this.fetch_audit_single(this.id);
        await this.fetch_not_audited_assets(param2);
        // await this.fetch_audited_assets(param1);

    },

    watch: {
        
    },

    computed: {
        ...mapGetters([
            'get_audit_single',
            'get_audit_assets'
        ]),
        
    }
};
</script>

<style>
</style>
