<template>
  <div>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6" style="display: inline-flex">
            <div class="all-cat-btn">
              <a
                href="#"
                class="btn btn-primary"
                style="
                  width: 50px;
                  height: 50px;
                  background-color: #000 !important;
                "
              >
                <i
                  class="fa fa-star-of-life"
                  style="margin-top: 5px; font-size: 25px"
                ></i>
                <p class="all-cat-p-style">Total Menu</p>
                <span class="badge badge-warning total-cat-span"
                  >{{ getMenus.countMenu }}/{{ getMenus.countSubMenu }}</span
                >
              </a>
            </div>
            <div class="add-cat-btn">
              <a
                @click.prevent="visibleForm()"
                href="#"
                class="btn btn-primary"
                style="width: 50px; height: 50px"
              >
                <i
                  class="fas fa-plus"
                  style="margin-top: 5px; font-size: 25px"
                ></i>
                <p class="add-cat-p-style">Add New Menu</p>
              </a>
            </div>
            <div class="add-cat-btn">
              <a
                @click.prevent="visibleSubForm()"
                href="#"
                class="btn btn-primary"
                style="width: 50px; height: 50px"
              >
                <i
                  class="fas fa-plus"
                  style="margin-top: 5px; font-size: 25px"
                ></i>
                <p class="add-cat-p-style">Add New Sub Menu</p>
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
        <hr />
      </div>
    </section>
    <!-- modal section start -->
    <div class="modal fade" id="edit-menu-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" style="padding: 0px">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Menu</h3>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span style="color: #fff" aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" @submit.prevent="updateMenu()">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input
                      v-model="form.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter category name"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                        >Publish</label
                      >
                      <select
                        style="width: 90px !important"
                        v-model="form.status"
                        class="custom-select mr-sm-2"
                      >
                        <option value="1" selected>Publish</option>
                        <option value="0">Hide</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button
                  style="width: 100%"
                  type="submit"
                  class="btn btn-primary"
                >
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div ref="editModal" v-show="editSubMenuForm" class="modal fade" id="edit-sub-menu-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" style="padding: 0px">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Sub-Menu</h3>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span style="color: #fff" aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" @submit.prevent="updateSubMenu()">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input
                      v-model="subMenuForm.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter category name"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="subMenuForm" field="name"></has-error>
                  </div>
                  <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                        >Publish</label
                      >
                      <select
                        style="width: 90px !important"
                        v-model="subMenuForm.status"
                        class="custom-select mr-sm-2"
                      >
                        <option value="1" selected>Publish</option>
                        <option value="0">Hide</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button
                  style="width: 100%"
                  type="submit"
                  class="btn btn-primary"

                >
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-show="subMenuList" class="modal fade" id="sub-menu-list-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body" style="padding: 0px">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sub-Menu</h3>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span style="color: #fff" aria-hidden="true">&times;</span>
                </button>
              </div>
              <div
                class="card-body"
                style="margin-left: -15px; margin-right: -15px"
              >
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Child Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody v-for="men in getMenus.menu" :key="men.id">
                    <tr v-for="subMenu in men.get_child_menu" :key="subMenu.id">
                      <td v-if="subMenu.menu_id == subMenuForm.id">
                        {{ subMenu.name }}
                      </td>
                      <td v-if="subMenu.menu_id == subMenuForm.id">
                        <button
                          v-if="subMenu.status == 0"
                          @click.prevent="activeSubMenu(subMenu)"
                          class="btn btn-warning"
                        >
                          <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </button>
                        <button
                          v-if="subMenu.status == 1"
                          @click.prevent="inactiveSubMenu(subMenu)"
                          class="btn btn-success"
                        >
                          <i class="fa fa-check" aria-hidden="true"></i>
                        </button>
                      </td>
                      <td v-if="subMenu.menu_id == subMenuForm.id">
                        <button
                          data-toggle="modal"
                          data-target="#edit-sub-menu-modal"
                          @click.prevent="editSubMenu(subMenu)"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <button
                          @click.prevent="removeSubMenu(subMenu)"
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
    </div>
    <!-- modal section end -->
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
              <h1 style="text-align: center; margin-top: 50%; opacity: 0.3">
                Loading...
              </h1>
            </div>
            <div v-show="showForm" class="card card-primary col-4">
              <div class="card-header" style="margin-top: 15px">
                <h3 v-show="actionUpload" class="card-title">Add New Menu</h3>
                <h3 v-show="addSubMenuForm" class="card-title">
                  Add New Sub Menu
                </h3>
              </div>
              <form
                role="form"
                @submit.prevent="actionUpload ? upload() : store()"
              >
                <div class="card-body">
                  <div
                    v-show="addSubMenuForm"
                    class="form-row align-items-center"
                  >
                    <label for="exampleInputEmail1">Select Menu</label>
                    <select
                      v-model="subMenuForm.menu_id"
                      class="custom-select mr-sm-2"
                    >
                      <option
                        v-for="menu in allmenu"
                        :key="menu.id"
                        :value="menu.id"
                      >
                        {{ menu.name }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input
                      v-show="actionUpload"
                      v-model="form.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter menu name"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <input
                      v-show="addSubMenuForm"
                      v-model="subMenuForm.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter sub menu name"
                    />
                    <has-error
                      v-show="actionUpload"
                      :form="form"
                      field="name"
                    ></has-error>
                  </div>
                  <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                      <select
                        v-show="actionUpload"
                        style="width: 90px !important"
                        v-model="form.status"
                        class="custom-select mr-sm-2"
                      >
                        <option value="1" selected>Publish</option>
                        <option value="0">Hide</option>
                      </select>
                      <select
                        v-show="addSubMenuForm"
                        style="width: 90px !important"
                        v-model="subMenuForm.status"
                        class="custom-select mr-sm-2"
                      >
                        <option value="1" selected>Publish</option>
                        <option value="0">Hide</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button
                  style="width: 100%; margin-bottom: 15px"
                  type="submit"
                  class="btn btn-primary"
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
                  style="width: 50% !important; float: right"
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
                      <th>Menu Name</th>
                      <th>Child Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="men in getMenus.menu" :key="men.id">
                      <td v-if="men.hide == 1">{{ men.name }}</td>
                      <td v-if="men.hide == 1" @mouseover.prevent="countId(men)">
                        <button
                          @click.prevent="editSubMenu(men)"
                          class="btn btn-primary"
                          data-toggle="modal"
                          data-target="#sub-menu-list-modal"
                        >
                          <span
                            v-if="men.id == id"
                            v-show="showCount"
                            class="badge badge-warning"
                          >
                            {{ count }}
                          </span>
                          SubMenu
                        </button>
                      </td>
                      <td v-if="men.hide == 1">
                        <button
                          v-if="men.status == 0"
                          @click.prevent="publishMenu(men)"
                          class="btn btn-warning"
                        >
                          <i class="fa fa-eye-slash" aria-hidden="true"></i>
                        </button>
                        <button
                          v-if="men.status == 1"
                          @click.prevent="hideMenu(men)"
                          class="btn btn-success"
                        >
                          <i class="fa fa-check" aria-hidden="true"></i>
                        </button>
                      </td>
                      <td v-if="men.hide == 1">
                        <button
                          data-toggle="modal"
                          data-target="#edit-menu-modal"
                          @click.prevent="editMenu(men)"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                        <button
                          @click.prevent="removeMenu(men)"
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
  name: "menus",
  data() {
    return {
      loading: true,
      subMenuList:false,
      editSubMenuForm:false,
      showForm: false,
      addMenuForm: false,
      addSubMenuForm: false,
      actionUpload: false,
      showCount: false,
      allmenu: "",
      search: "",
      count: "",
      id: "",
      form: new Form({
        id: "",
        name: "",
        status: "1",
      }),
      subMenuForm: new Form({
        id:"",
        menu_id: "",
        name: "",
        status: "1",
      }),
      subMenuId: new Form({
        id:"",
      }),
    };
  },
  mounted() {},
  created() {
    axios
      .get("api/get-menu", {
        headers: {
          Accept: "Application/json",
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        this.allmenu = response.data.menu;
      });
    this.$store.dispatch("getMenuAction");
  },
  computed: {
    getMenus() {
      return this.$store.getters.getMenu;
    },
    // filterd(){
    //     return this.categories.filter(cat =>
    //     cat.name.toLowerCase().startsWith(this.search.toLowerCase()))
    // }
  },

  methods: {
    updateSubMenu(){
        this.subMenuForm
        .post("api/update-sub-menu/" + this.subMenuForm.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.editSubMenuForm = false;
          this.subMenuList = true;
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "SubMenu Updated Successfull.",
          });
        });
    },
    updateMenu() {
      this.form
        .post("api/update-menu/" + this.form.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "Menu Updated Successfull.",
          });
        });
    },
    publishMenu(data) {
      this.form.id = data.id;
      this.form
        .post("api/publish-menu/" + this.form.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "Menu Published Successfull.",
          });
        });
    },
    hideMenu(data) {
      this.form.id = data.id;
      this.form
        .post("api/hide-menu/" + this.form.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "Menu Hide Successfull.",
          });
        });
    },
    editMenu(data) {
      this.form.fill(data);
    },
    removeMenu(data) {
      this.form.id = data.id;
      this.form
        .post("api/remove-menu/" + this.form.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "Menu Deleted Successfull.",
          });
        });
    },
    activeSubMenu(data) {
      this.subMenuId.id = data.id;
      this.subMenuId
        .post("api/publish-sub-menu/" + this.subMenuId.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "SubMenu active Successfull.",
          });
        });
    },
    inactiveSubMenu(data) {
      this.subMenuId.id = data.id;
      this.subMenuId
        .post("api/hide-sub-menu/" + this.subMenuId.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "SubMenu inactive Successfull.",
          });
        });
    },
    editSubMenu(data) {
      if (this.subMenuList == false) {
          this.subMenuList = true;
          this.editSubMenuForm = false;
          this.subMenuForm.fill(data);
      }else if(this.subMenuList == true){
          this.subMenuForm.fill(data);
          this.subMenuList = false;
          this.editSubMenuForm = true;
      }

    },
    removeSubMenu(data) {
      this.subMenuId.id = data.id;
      this.subMenuId
        .post("api/remove-sub-menu/" + this.subMenuId.id, {
          headers: {
            Accept: "Application/Json",
            Authorization: "Bearer " + token,
          },
        })
        .then(() => {
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "SubMenu Deleted Successfull.",
          });
        });
    },
    countId(men) {
      if ((this.id = men.id)) {
        axios
          .get("api/get-count-sub-menu/" + men.id, {
            headers: {
              Accept: "Application/json",
              Authorization: "Bearer " + token,
            },
          })
          .then((response) => {
            this.count = response.data.data;
            if (this.count != 0) {
              this.showCount = true;
            } else {
              this.showCount = false;
            }
          });
      }
    },
    visibleForm() {
      this.loading = false;
      this.showForm = true;
      this.actionUpload = true;
      this.addSubMenuForm = false;
    },
    visibleSubForm() {
      this.loading = false;
      this.showForm = true;
      this.addSubMenuForm = true;
      this.actionUpload = false;
    },
    upload() {
      this.form
        .post("api/menu-store", {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
          this.form.reset();
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "Menu Created Successfull.",
          });
        });
    },
    store() {
      this.subMenuForm
        .post("api/child-menu-store", {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
          this.subMenuForm.reset();
          this.$store.dispatch("getMenuAction");
          Toast.fire({
            icon: "success",
            title: "SubMenu Created Successfull.",
          });
        });
    },
  },
};
</script>

<style scoped>
.search-cat-style {
  position: absolute;
  background-color: whitesmoke;
  margin-top: 1px;
  margin-left: 94% !important;
}
.all-cat-btn {
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
.add-cat-btn {
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
.all-cat-p-style {
  color: #000;
  margin-left: 27px;
  margin-top: -40px;
  font-weight: 700;
  width: 121px;
}
.add-cat-p-style {
  color: #000;
  margin-left: 30px !important;
  margin-top: -40px;
  font-weight: 700;
  width: 123px !important;
}
.total-cat-span {
  float: left;
  margin-left: 53px !important;
  color: #000;
  margin-top: -12px !important;
}
</style>
