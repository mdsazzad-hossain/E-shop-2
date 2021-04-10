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
                <p class="all-cat-p-style">
                  Total Category
                  <span class="badge badge-warning total-cat-span">{{
                    getCategories.cat
                  }}</span>
                </p>
              </a>
            </div>
            <div class="add-cat-btn">
              <a
                href="#"
                class="btn btn-primary"
                @click.prevent="showAddCategoryForm()"
                style="width: 50px; height: 50px"
              >
                <i
                  class="fas fa-plus"
                  style="margin-top: 5px; font-size: 25px"
                ></i>
                <p class="add-cat-p-style">Add New Category</p>
              </a>
            </div>
            <div class="add-cat-btn">
              <router-link
                to="/sub-categories"
                class="btn btn-primary"
                @click.prevent="showAddSubCategoryForm()"
                style="width: 50px; height: 50px"
              >
                <i
                  class="fas fa-plus"
                  style="margin-top: 5px; font-size: 25px"
                ></i>
                <p class="add-sub-cat-p-style">Add New Sub Category</p>
              </router-link>
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
    <hr />
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div
              v-show="loading"
              style="
                margin-bottom: 15px;
                border: 1px dashed #767676;
                width: 100%;
                background-color: #ddd;
                height: 96%;
              "
            >
              <h1 style="text-align: center; margin-top: 50%; opacity: 0.3">
                Loading...
              </h1>
            </div>
            <div v-show="!loading" class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Category Details...</h3>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span style="color: #fff" aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" @submit.prevent="upload()">
                <div class="card-body">
                  <div class="form-group">
                    <input
                      v-model="form.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter category name"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>
                  <div class="form-group">
                    <textarea
                      v-model="form.description"
                      type="text"
                      class="form-control"
                      placeholder="enter category details..."
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Category Cover Photo</label>
                    <div class="input-group">
                      <div class="custom-file file-input-height">
                        <img :src="form.image" class="img-style" />
                        <input
                          @change="changePhoto($event)"
                          type="file"
                          class="custom-file-input input-new-height"
                        />
                      </div>
                    </div>
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
          <div class="col-8">
            <div class="card">
              <div class="card-header">
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
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Description</th>
                      <th>Cover Photo</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-show="showInput" style="background-color: #ddd">
                      <td>
                        <div class="form-group">
                          <input
                            v-model="form.name"
                            type="text"
                            class="form-control"
                            placeholder="Enter category name"
                          />
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <textarea
                            v-model="form.description"
                            type="text"
                            class="form-control"
                            placeholder="enter category details..."
                          ></textarea>
                        </div>
                      </td>
                      <td style="width:20%;">
                        <div class="input-group">
                          <div class="custom-file file-input-style">
                            <img
                              :src="editMode ? updateImage() : form.image"
                              class="img-style"
                            />
                            <!-- <i class="fas fa-file-upload icon-style"></i> -->
                            <input
                              @change="changePhoto($event)"
                              type="file"
                              class="custom-file-input input-new-style"
                            />
                            <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                          </div>
                        </div>
                      </td>
                      <td style="width:20%;">
                        <div class="form-row align-items-center">
                          <div class="col-auto my-1" style="width: 100%">
                            <select
                              style="width: 100% !important"
                              v-model="form.status"
                              class="custom-select mr-sm-2"
                            >
                              <option value="1" selected>Publish</option>
                              <option value="0">Hide</option>
                            </select>
                          </div>
                        </div>
                      </td>
                      <td style="width: 16.7%">
                        <button
                          type="button"
                          @click.prevent="update()"
                          class="btn btn-success"
                        >
                          Submit
                        </button>
                      </td>
                    </tr>
                    <tr v-for="cat in filterd" :key="cat.id">
                      <td v-if="form.id !== cat.id && cat.hide == 1">
                        {{ cat.name | shortLength(20, "...") }}
                      </td>
                      <td v-if="form.id !== cat.id && cat.hide == 1">
                        {{ cat.description | shortLength(40, "...") }}
                      </td>
                      <td v-if="form.id !== cat.id && cat.hide == 1" class="img-td">
                        <img
                          style="height: 65px; width: 100%"
                          :src="ourImage(cat.image)"
                          alt="#"
                        />
                      </td>
                      <td v-if="form.id !== cat.id && cat.hide == 1">
                        <a
                          v-if="cat.status == 0"
                          @click.prevent="publish(cat)"
                          href="#"
                          style="font-weight: 700; color: #fff"
                          class="badge badge-warning"
                          >Publish</a
                        >
                        <a
                          v-if="cat.status == 1"
                          @click.prevent="hideCat(cat)"
                          href="#"
                          class="badge badge-success"
                          style="font-weight: 700; color: #fff"
                        >
                          <i class="fa fa-check" style="margin-right: 5px"></i
                          >Published
                        </a>
                        <a
                          @mouseover.prevent="countId(cat)"
                          href="#"
                          class="badge badge-primary"
                          style="font-weight: 700; color: #fff"
                        >
                          <i v-show="!showCount" class="fa fa-plus" style="margin-right: 5px"></i>
                          <span badge badge-warning>{{ count }}</span>
                          Sub-Category
                        </a>
                      </td>
                      <td style="width: 16.7%" v-if="form.id !== cat.id && cat.hide == 1">
                        <a
                          @click.prevent="edit(cat)"
                          href="#"
                          class="btn btn-primary"
                        >
                          <i class="fa fa-edit"></i>
                        </a>
                        <a
                          @click.prevent="remove(cat)"
                          href="#"
                          class="btn btn-danger"
                        >
                          <i class="fa fa-trash"></i>
                        </a>
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
  name: "category",
  data() {
    return {
      showInput: false,
      loading: true,
      showCount:false,
      search: "",
      getSubCatId:"",
      count:"",
      categories: [],
      editMode: false,
      btnVisible: false,
      form: new Form({
        id: "",
        role_id: "",
        name: "",
        description: "",
        image: "",
        status: "",
      }),
    };
  },
  mounted() {},
  created() {
    axios
      .get("api/getCategory", {
        headers: {
          Accept: "Application/json",
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        this.categories = response.data.categories;
      });

    this.$store.dispatch("getCategoryAction");
  },
  computed: {
    getCategories() {
      return this.$store.getters.getCategory;
    },
    filterd() {
      return this.categories.filter((cat) =>
        cat.name.toLowerCase().startsWith(this.search.toLowerCase())
      );
    },
  },

  methods: {
    countId(cat) {

      if (this.getSubCatId = cat.id) {
        axios
          .get("api/get-count-sub-cat/" + cat.id, {
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
    showAddCategoryForm() {
      this.loading = false;
    },
    upload() {
      this.form
        .post("api/addCategory", {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
          axios
            .get("api/getCategory", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((response) => {
              this.categories = response.data.categories;
            });
          Toast.fire({
            icon: "success",
            title: "Category added Successfull.",
          });
          this.form.reset();
        });
    },
    edit(cat) {
      this.form.fill(cat);
      if (this.form.id == cat.id) {
        this.editMode = true;
        this.showInput = true;
      } else {
        this.editMode = false;
        this.showInput = false;
      }
    },
    publish(cat) {
      this.form.fill(cat);
      this.form
        .post("api/publish-category/" + this.form.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
          this.form.reset();
          axios
            .get("api/getCategory", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((response) => {
              this.categories = response.data.categories;
            });
          Toast.fire({
            icon: "success",
            title: "Category Published Successfull.",
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "warning",
            title: "wrong info",
          });
        });
    },
    hideCat(cat) {
      this.form.fill(cat);
      this.form
        .post("api/hide-category/" + this.form.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
          this.form.reset();
          axios
            .get("api/getCategory", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((response) => {
              this.categories = response.data.categories;
            });
          Toast.fire({
            icon: "success",
            title: "Category Inactive Successfull.",
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "warning",
            title: "wrong info",
          });
        });
    },
    update() {
      this.form
        .post("api/update-category/" + this.form.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
          this.form.reset();
          axios
            .get("api/getCategory", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((response) => {
              this.categories = response.data.categories;
            });
          Toast.fire({
            icon: "success",
            title: "Category Updated Successfull.",
          });
          this.showInput = false;
          this.modalHide = false;

        })
        .catch((err) => {
          Swal.fire({
            icon: "warning",
            title: "wrong info",
          });
        });
    },
    remove(cat) {
      this.form.fill(cat);
      this.form
        .post("api/delete/" + this.form.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {

          axios
            .get("api/getCategory", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((response) => {
              this.categories = response.data.categories;
            });
          Toast.fire({
            icon: "success",
            title: "Category Deleted Successfull.",
          });
        })
        .catch((err) => {
          Swal.fire({
            icon: "warning",
            title: "wrong info",
          });
        });
        this.form.reset();
    },
    ourImage(img) {
      return "/images/" + img;
    },
    changePhoto(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.form.image = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    updateImage() {
      var img = this.form.image;
      if (img.length > 100) {
        return this.form.image;
      } else {
        return "/images/" + this.form.image;
      }
    },
  },
};
</script>

<style scoped>
.img-td {
  width: 20% !important;
}
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
  margin-left: 10px;
  margin-top: -40px;
  font-weight: 700;
  width: 123px !important;
}
.add-sub-cat-p-style {
  color: #000;
  margin-left: 24px;
  margin-top: -40px;
  font-weight: 700;
  width: 123px !important;
}
.total-cat-span {
  float: left;
  margin-left: 19px;
  color: #000;
}
.input-new-style {
  margin-left: -100%;
  height: 60px !important;
  border: dashed 1.5px blue;
  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
  width: 100% !important;
  cursor: pointer;
}
.img-style {
  width: 100% !important;
  height: 100% !important;
}
.file-input-style {
  border: dashed 1.5px blue;
  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
  height: 60px !important;
  max-width: 100% !important;
  margin-left: 0px !important;
}
.file-input-height {
  border: dashed 1.5px blue;
  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
  height: 100px;
  max-width: 100% !important;
  margin-left: 0px !important;
}
.input-new-height {
  margin-left: -100%;
  height: 100px;
  border: dashed 1.5px blue;
  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
  width: 100% !important;
  cursor: pointer;
}
/* .icon-style{
    font-size: 50px;
    margin-left: 145px;
    margin-top:5px;
} */
</style>
