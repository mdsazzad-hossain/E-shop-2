<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6" style="display:inline-flex;">
            <div class="all-cat-btn">
                <a href="#" class="btn btn-primary"
                style="width: 50px;height: 50px;background-color: #000 !important;">
                    <i class="fa fa-star-of-life" style="margin-top: 5px;font-size: 25px;"></i>
                    <p class="all-cat-p-style">Total Role
                    </p>
                    <span class="badge badge-warning total-cat-span">{{getRoles.length}}</span>

                </a>
            </div>
            <div class="add-cat-btn">
                <a href="#" class="btn btn-primary"
                @click.prevent="showRoleForm()"
                style="width: 50px;height: 50px;">
                    <i class="fas fa-plus" style="margin-top: 5px;font-size: 25px;"></i>
                    <p class="add-cat-p-style">Add New Role</p>
                </a>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <hr>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12" style="display: inline-flex">
            <div
              v-show="loading"
              class="col-4"
              style="
                margin-bottom: 15px;
                border: 1px dashed #767676;
                width: 100%;
                background-color: #ddd;
              "
            >
              <h1 style="text-align: center; margin-top: 35%; opacity: 0.3">
                Loading...
              </h1>
            </div>
            <div v-show="showForm" class="card card-primary col-4">
              <div v-show="!editMode" class="card-header" style="margin-top: 15px;">
                <h3 class="card-title">
                  Add New Role
                </h3>
              </div>
              <div v-show="editMode" class="card-header" style="margin-top: 15px;color: #fff;
                background-color: #28a745;
                border-color: #28a745;">
                <h3 v-show="editMode" class="card-title">Update Role</h3>
              </div>
              <form
                role="form"
                @submit.prevent="editMode ? update() : addRole()"
              >
                <div class="card-body">
                    <div class="search-bar-section">
                  <div
                    class="form-group"
                    style="width: 179% !important;float: left;margin-top: 5px;margin-left: 15px;"
                   >
                    <input
                      v-model="form.name"
                      @keyup.prevent="searchData()"
                      type="search"
                      placeholder="Search"
                      aria-label="Search"
                      class="form-control"
                    />
                    <div class="input-group-append search-style">
                      <button
                        @click.prevent="searchData()"
                        style="padding-top: 7px;padding-bottom: 3px;"
                        type="submit"
                        class="btn btn-navbar"
                      >
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                  <div class="search-bar-dropdown" v-show="getSesrchValue">
                    <ul class="search-bar-dropdown-ul">
                      <li v-for="val in searchValue" :key="val.id" class="search-bar-dropdown-ul-li">
                        <p style="margin-bottom: 2px !important;cursor:pointer;" @click.prevent="getVal(val)">{{ val.name }}</p>
                      </li>
                    </ul>
                  </div>
                </div>

                    <div class="col-auto my-1" style="float: left;width: 100%;">
                    <label style="margin-top: 5px;" class="mr-sm-2" for="inlineFormCustomSelect">Role</label>
                    <select
                        v-model="form.role"
                        style="width: 100%;"
                        class="custom-select mr-sm-2"
                        id="inlineFormCustomSelect"
                    >
                        <option>Admin</option>
                        <option>Editor</option>
                    </select>
                    </div>
                </div>
                <button
                  v-show="!editMode"
                  style="width: 100%; margin-bottom: 15px"
                  type="submit"
                  class="btn btn-primary"
                >
                  Submit
                </button>
                <button
                  v-show="editMode"
                  style="width: 100%; margin-bottom: 15px"
                  type="submit"
                  class="btn btn-success"
                >
                  Submit
                </button>
              </form>
            </div>
            <div class="card col-7 offset-1">
              <div
                class="card-header"
                style="margin-left: -15px; margin-right: -15px"
              >
                <div
                  class="input-group input-group-sm"
                  style="width: 100% !important; float: left"
                >
                  <input
                    style="position: relative"
                    type="search"
                    v-model="search"
                    placeholder="Search"
                    aria-label="Search"
                    class="form-control form-control-navbar"
                  />
                  <div class="input-group-append search-cat-style">
                    <button
                      type="submit"
                      class="btn btn-navbar"
                      style="padding-top: 4px; padding-bottom: 3px"
                    >
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div
                class="card-body"
                style="margin-left: -15px; margin-right: -15px"
              >
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="role in getRoles" :key="role.id">
                      <td>{{ role.name }}</td>
                      <td>
                          <button v-if="role.role == 'Admin'" class="badge badge-danger">{{ role.role }}</button>
                          <button v-if="role.role == 'Editor'" class="badge badge-warning">{{ role.role }}</button>
                      </td>
                      <td>
                        <button
                          @click.prevent="editRole(role)"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <button
                          @click.prevent="removeRole(role)"
                          class="btn btn-danger"
                        >
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      searchValue: "",
      loading:true,
      editMode:false,
      showForm:false,
      getSesrchValue: false,
      tokenData:"",
      form: new Form({
          id:"",
        user_id:"",
        name: "",
        role: "Admin",
      }),
    };
  },
  mounted(){
      this.tokenData = token;
      this.$store.dispatch("getRoleAction");
  },
  computed:{
      getRoles(){
          return this.$store.getters.getRole;
      }
  },
  methods: {
    editRole(role){
        this.loading = false;
        this.showForm = true;
        this.editMode = true;
        this.form.fill(role);
    },
    showRoleForm(){
        this.loading = false;
        this.showForm = true;
        this.editMode = false;
    },
    removeRole(role){
        this.form.post('api/remove-role/'+this.form.id,{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+this.tokenData
                }
            })
        .then(()=>{
            this.$store.dispatch("getRoleAction");
            Toast.fire({
                icon:"success",
                title:"Role Deleted Successfull."
            })
        })
    },
    update(){
        this.form.post('api/update-role/'+this.form.id,{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+this.tokenData
                }
            })
        .then(()=>{
            this.$store.dispatch("getRoleAction");
            Toast.fire({
                icon:"success",
                title:"Role Updated Successfull."
            })
        })
    },
    addRole() {
        this.form.post('api/addRole',{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+this.tokenData
                }
            }
        )
        .then((response)=>{
            this.$store.dispatch("getRoleAction");
            Toast.fire({
                    icon: "success",
                    title: "Role Created Successfull."
                });
        })
        .catch(()=>{
            Swal.fire({
                'icon': "warning",
                'title': "wrong creidentials!"

            });
        })
    },
    getVal(val){
        this.form.name = val.name;
        this.getSesrchValue = false;
    },
    searchData: _.debounce(function () {
      if (this.form.name !== "") {
        axios.get("api/roles?q=" + this.form.name,{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+this.tokenData
                }
            })
        .then((response) => {
          this.searchValue = response.data.users;
          this.getSesrchValue = true;
        //   console.log(response.data.users);
        });
      } else {
        this.getSesrchValue = false;
        this.form.name = "";
      }
    }, 300),
  },
};
</script>

<style scoped>

.search-style {
    position: absolute !important;
    background-color: whitesmoke !important;
    margin-top: 1px !important;
    margin-left: 60% !important;
}
.form-control {
  position: relative !important;
}
.form-group {
  width: 50% !important;
  float: left;
  margin-top: 5px;
  margin-bottom: 0px !important;
  display: flex;
}
.search-bar-section {
  display: block;
  float: left;
  width: 50%;
}
.search-bar-dropdown {
    display: inline-block;
    width: 179%;
    background-color: #ddd;
    margin-left: 15px;
    border-radius: 5px;
}
.search-bar-dropdown-ul {
  margin-left: -25px;
}
.search-bar-dropdown-ul-li {
  list-style: none;
  margin-bottom: 0px;
  border-bottom: 1px solid #d1d1d1;
  color: #fff;
  font-size: 15px;
  font-weight: 700;
  text-transform: capitalize;
}
.all-cat-btn{
    padding-top: 5px;
    padding-left: 5px;
    padding-bottom: 5px;
    padding-right: 25%;
    margin-right: 5%;
    background-color: azure;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 1px 1px 1px 0px #7676;
    height: 60px;
}
.add-cat-btn{
    padding-top: 5px;
    padding-left: 5px;
    padding-bottom: 5px;
    padding-right: 25%;
    margin-right: 5%;
    background-color: azure;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 1px 1px 1px 0px #7676;
    height: 60px;
}
.all-cat-p-style{
    color: #000;
    margin-left: 19px;
    margin-top: -40px;
    font-weight: 700;
    width: 121px;
}
.add-cat-p-style{
    color: #000;
    margin-left: 30px;
    margin-top: -40px;
    font-weight: 700;
    width: 123px !important;
}
.total-cat-span{
    float: left;
    margin-left: 50px;
    color: #000;
    margin-top: -12px;
}
</style>
