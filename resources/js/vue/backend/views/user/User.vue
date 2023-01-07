<template>
  <div class="assetCategories">
  <div class="card">
      <div class="card-header d-flex flex-wrap g-2">
        <h5 class="justify-content-start">
          User List
        </h5>
        <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3" style="width:280px;">
            <div class="dt-buttons">
              <router-link :to="{name:'userCreate'}">
                <button class="dt-button btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                    <span><i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">Create User</span></span>
                </button>
              </router-link>
            </div>
        </div>
      </div>
      <div class="card-body table-responsive text-nowrap">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roles</th>
                      <th>Created at</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  <tr v-for="(user, index) in get_user_data.data" :key="index">
                      <td class="sorting_1"><a href=""><strong>#{{ index+1 }}</strong></a></td>
                      <td>
                        <a href="#" class="text-body text-truncate">
                          <span class="fw-semibold">{{ user.first_name }} {{ user.last_name }}</span>
                        </a>
                      </td>
                      <td>
                        <a href="#" class="text-body text-truncate">
                          <span class="fw-semibold">{{ user.email }}</span>
                        </a>
                      </td>
                      <td>
                        <a href="#" class="text-body text-truncate">
                          <span class="fw-semibold" v-if="user.roles">
                            <ul class="list-group list-group-timeline">
                                <li v-for="(role, index) in user.roles" :key="index" class="list-group-item list-group-timeline-primary">{{ role.name }}</li>
                            </ul>
                          </span>
                        </a>
                      </td>
                      <td>
                          {{ user.date[2] }}
                      </td>
                      
                      <td>
                          <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                            <li>
                                <router-link :to="{ name:'assetLocationEdit' , params: { id: user.id } }">
                                  <a class="btn btn-sm btn-outline-info" href="javascript:void(0);"><i class="fa-solid fa-pencil me-1"></i> Edit</a>
                                </router-link>
                            </li>
                            
                            <li>
                                <a class="btn btn-sm btn-outline-danger" href="javascript:void(0);" @click.prevent="remove(user)"><i class="fa-solid fa-trash-can me-1"></i> Delete</a>
                            </li>
                          </ul>
                              
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="card-footer pt-4">
          <pagination :data="get_user_data" :limit="10" :size="'small'" :show-disabled="true" :align="'center'" @pagination-change-page="fetch_user_paginate">
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
    ...mapActions(['fetch_user_paginate']),
    ...mapMutations([]),
    remove: async function(user) {
      
      await window.c_alert() &&
      axios.post('/user/delete', {
        id: user.id
        }).then((response) => {
            window.s_alert('success', response.data.message);
            // this.mssg = response.data.message
            this.fetch_user_paginate();
        })
        .catch((e) => {
            console.log(e);
        });
    }
  },
  computed: {
    ...mapGetters(['get_user_data'])
  },
  created: async function()  {
    await this.fetch_user_paginate();
    // console.log(this.categories);
  },
}
</script>

<style>

</style>
