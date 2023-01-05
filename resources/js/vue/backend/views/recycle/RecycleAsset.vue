<template>
  <div class="assetCategories">
  <div class="card">
      <div class="card-header d-flex flex-wrap g-2">
        <h5 class="justify-content-start">
          Asset Recycle bin
        </h5>
        <!-- <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3" style="width:280px;">
            <div class="dt-buttons">
              <router-link :to="{name:'assetLocationCreate'}">
                <button class="dt-button btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                    <span><i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">Create Location</span></span>
                </button>
              </router-link>
            </div>
        </div> -->
      </div>
      <!-- <div v-if="mssg" class="alert alert-danger alert-dismissible" role="alert">
          {{ mssg }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          </button>
      </div> -->
      <div class="card-body table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>price</th>
                        <th>current value</th>
                        <th>V no</th>
                        <th>SV no</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr v-for="(asset, index) in get_recycle_data.data" :key="index">
                        <td><strong style="color: #7367f0;">#{{ index+1 }}</strong></td>
                        <td>
                            <span class="fw-semibold">{{ asset.name }}</span>
                        </td>
                        <td>{{ asset.price }}</td>
                        <td>{{ asset.current_value }}</td>
                        <td>{{ asset.v_no }}</td>
                        <td>{{ asset.sv_no }}</td>
                        <td>
                            <span v-if="asset.is_lost == 0" class="badge bg-label-success me-1">Available</span>
                            <span v-else class="badge bg-label-danger me-1">Lost</span>
                        </td>
                        <td>
                            <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                                <li>
                                    <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);" @click.prevent="restore(asset)"><i class="fa-solid fa-rotate me-1"></i> Restore</a>
                                </li>
                                <li>
                                    <a class="btn btn-sm btn-outline-danger" href="javascript:void(0);" @click.prevent="remove(asset)"><i class="fa-solid fa-trash-can me-1"></i>Permenant Delete</a>
                                </li>
                            </ul>
                                
                        </td>
                    </tr>
                </tbody>
            </table>
      </div>
      <div class="card-footer pt-4">
          <pagination :data="get_recycle_data" :limit="10" :size="'small'" :show-disabled="true" :align="'center'" @pagination-change-page="fetch_recyle_all">
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
    ...mapActions(['fetch_recyle_all']),
    ...mapMutations([]),
    restore: async function(asset) {
      
      await window.c_alert() &&
      axios.post('/recycle/restore', {
        id: asset.id
        }).then((response) => {
            window.s_alert('success', response.data.message);
            this.fetch_recyle_all();
        })
        .catch((e) => {
            console.log(e);
        });
    },
    remove: async function(asset) {
      
      await window.c_alert() &&
      axios.post('/recycle/delete', {
        id: asset.id
        }).then((response) => {
            window.s_alert('success', response.data.message);
            this.fetch_recyle_all();
        })
        .catch((e) => {
            console.log(e);
        });
    }
  },
  computed: {
    ...mapGetters(['get_recycle_data'])
  },
  created: async function()  {
    await this.fetch_recyle_all();
    // console.log(this.categories);
  },
}
</script>

<style>

</style>
