<template>
  <div class="assetCategories">
  <div class="card">
      <div class="card-header d-flex flex-wrap g-2">
        <h5 class="justify-content-start">
          Asset Audits
        </h5>
        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3" style="width:280px;">
            <div class="dt-buttons">
              <router-link :to="{name:'auditCreate'}">
                <button class="dt-button btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                    <span><i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">Create audit</span></span>
                </button>
              </router-link>
            </div>
        </div>
      </div>
      <div v-if="mssg" class="alert alert-danger alert-dismissible" role="alert">
          {{ mssg }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
      </div>
      <div class="card-body table-responsive text-nowrap">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Assign to</th>
                      <th>Start date</th>
                      <th>End date</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  <tr v-for="(audit, index) in get_audits.data" :key="index">
                      <td class="sorting_1"><a href=""><strong>#{{ index+1 }}</strong></a></td>
                      <td>
                        <a href="#" class="text-body text-truncate">
                          <span class="fw-semibold">{{ audit.title }}</span>
                        </a>
                      </td>
                      <td>
                        <a href="#" class="text-body text-truncate">
                          <span v-if="audit.user" class="fw-semibold">{{ audit.user.first_name }} {{ audit.user.last_name }}</span>
                        </a>
                      </td>
                      <td>
                          {{ audit.start_date }}
                      </td>
                      <td>
                          {{ audit.end_date }}
                      </td>
                      <td>
                        <span v-if="audit.audit_complete.status == 'complete'" class="badge bg-label-success me-1">Completed</span>
                        <span v-else class="badge bg-label-danger me-1">Not Completed</span>
                      </td>
                      <td>
                          <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                            <li>
                                <router-link :to="{ name:'auditDetails' , params: { id: audit.id } }">
                                  <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);"><i class="fa-solid fa-list me-1"></i> Audit Now</a>
                                </router-link>
                            </li>
                            
                            <li>
                                <router-link :to="{ name:'auditEdit' , params: { id: audit.id } }">
                                  <a class="btn btn-sm btn-outline-info" href="javascript:void(0);"><i class="fa-solid fa-pencil me-1"></i> Edit</a>
                                </router-link>
                            </li>
                            
                            <li>
                                <a class="btn btn-sm btn-outline-danger" href="javascript:void(0);" @click.prevent="remove(audit)"><i class="fa-solid fa-trash-can me-1"></i> Delete</a>
                            </li>
                          </ul>
                              
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="card-footer pt-4">
          <pagination :data="get_audits" :limit="10" :size="'small'" :show-disabled="true" :align="'center'" @pagination-change-page="fetch_audit_paginate">
              <span slot="prev-nav"><i class="fa fa-angle-left"></i> Previous</span>
              <span slot="next-nav">Next <i class="fa fa-angle-right"></i></span>
          </pagination>
      </div>
  </div>

  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
export default {
   data() {
      return {
        categories: '',
        mssg: ''
      }
    },
  methods: {
    ...mapActions(['fetch_audit_paginate']),
    ...mapMutations([]),
    remove: async function(audit) {
      
      await window.c_alert() &&
      axios.post('/audit/destroy', {
        id: audit.id
        }).then((response) => {
            window.s_alert('success', response.data.message);
            // this.mssg = response.data.message
            this.fetch_audit_paginate();
        })
        .catch((e) => {
            console.log(e);
        });
    }
  },
  computed: {
    ...mapGetters(['get_audits'])
  },
  created: async function()  {
    await this.fetch_audit_paginate();
    
  },
}
</script>

<style>

</style>
