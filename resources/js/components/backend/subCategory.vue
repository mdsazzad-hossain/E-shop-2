<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6" style="display: inline-flex">
            <div class="all-sub-cat-btn">
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
                <p class="all-sub-cat-p-style">
                  Total Sub Category
                  <span class="badge badge-warning total-sub-cat-span">{{ getSubCategories.total }}</span>
                </p>
              </a>
            </div>
            <div class="add-sub-cat-btn">
              <a
                href="#"
                class="btn btn-primary"
                @click.prevent="showAddSubCategoryForm()"
                style="width: 50px; height: 50px"
              >
                <i
                  class="fas fa-plus"
                  style="margin-top: 5px; font-size: 25px"
                ></i>
                <p class="add-sub-cat-p-style">Add New Sub Category</p>
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
    <hr />
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div v-show="loading" class="col-4" style="float: left;height: 96%;">
              <div
                style="
                  margin-bottom: 15px;
                  border: 1px dashed #767676;
                  width: 100%;
                  background-color: #ddd;
                  height: 100%;
                "
              >
                <h1 style="text-align: center; margin-top: 50%; opacity: 0.3">
                  Loading...
                </h1>
              </div>
            </div>
            <div v-show="!loading" class="col-4" style="float: left;height: 96%;">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">New Sub Category</h3>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form role="form" @submit.prevent="storeSubCat()">
                  <div class="card-body">
                    <div class="form-group">
                        <select
                          style="width: 100% !important"
                          v-model="form.category_id"
                          class="custom-select mr-sm-2"
                         >
                            <option v-for="cat in getCategories.categories" :key="cat.id" :value="cat.id" selected>
                              {{ cat.name }}
                            </option>
                        </select>
                    </div>
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
                          <!-- <i class="fas fa-file-upload icon-style"></i> -->
                          <input
                            @change="changePhoto($event)"
                            type="file"
                            class="custom-file-input input-new-height"
                            id="exampleInputFile"
                          />
                          <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
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
                          id="inlineFormCustomSelect"
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
            <div class="col-8" style="float: right">
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
                        <th>Parent</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Banar</th>
                        <th>Status</th>
                        <th style="width: 11% !important">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-show="editMode">
                        <td>
                            <div class="form-group">
                                <select
                                 @mouseover.prevent="addStyle1()" @mouseout.prevent="outStyle1()"
                              :style="newWidth1 ? {width: '100px',transition: '.3s'}: {width:'',transition: '.3s'}"
                                style="width: 100% !important"
                                v-model="form.category_id"
                                class="custom-select mr-sm-2"
                                >
                                    <option v-for="cat in getCategories.categories" :key="cat.id" :value="cat.id" selected>
                                        {{ cat.name }}
                                    </option>
                                </select>
                            </div>
                        </td>
                        <td>
                          <div class="form-group">
                            <input
                              @mouseover.prevent="addStyle()" @mouseout.prevent="outStyle()"
                              :style="newWidth ? {width: '100px',transition: '.3s'}: {width:'',transition: '.3s'}"
                              v-model="form.name"
                              type="text"
                              class="form-control"
                              placeholder="Enter category name"
                              :class="{ 'is-invalid': form.errors.has('name') }"
                            />
                            <has-error :form="form" field="name"></has-error>
                          </div>
                        </td>
                        <td style="width:25%;">
                          <div class="form-group">
                            <textarea
                              v-model="form.description"
                              type="text"
                              class="form-control"
                              placeholder="enter category details..."
                            ></textarea>
                          </div>
                        </td>
                        <td style="width:25%;">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="custom-file file-input-style">
                                <img
                                    :src="editMode ? updateImage() : form.image"
                                    class="img-style"
                                />
                                <input
                                  @change="changePhoto($event)"
                                  type="file"
                                  class="custom-file-input input-new-style"
                                  id="exampleInputFile"
                                />
                              </div>
                            </div>
                          </div>
                        </td>
                        <td style="width:10%;">
                          <div class="form-row align-items-center">
                            <div class="col-auto my-1">
                              <select
                                style="width: 90px !important"
                                v-model="form.status"
                                class="custom-select mr-sm-2"
                                id="inlineFormCustomSelect"
                              >
                                <option value="1" selected>Publish</option>
                                <option value="0">Hide</option>
                              </select>
                            </div>
                          </div>
                        </td>
                        <td style="width:17.3%;">
                          <button
                            @click.prevent="updateSubCat()"
                            style="width: 100%"
                            type="submit"
                            class="btn btn-primary"
                          >
                            Submit
                          </button>
                        </td>
                      </tr>
                      <tr v-for="sub in filterd" :key="sub.id">
                        <td v-if="form.id != sub.id && sub.hide == 1 ">{{ sub.get_category.name }}</td>
                        <td v-if="form.id != sub.id && sub.hide == 1 ">{{ sub.name }}</td>
                        <td v-if="form.id != sub.id && sub.hide == 1 " style="width:25%;">{{ sub.description }}</td>
                        <td v-if="form.id != sub.id && sub.hide == 1 " style="width:25%;">
                            <img
                                style="height: 65px; width: 100%"
                                :src="ourImage(sub.image)"
                                alt="#"
                            />
                        </td>
                        <td v-if="form.id != sub.id && sub.hide == 1 " style="width:10%;">
                          <a
                            href="#"
                            v-if="sub.status == 0"
                            class="badge badge-warning"
                            @click.prevent="publishSubCat(sub)"
                          >
                            Inactive
                          </a>
                          <a
                            @click.prevent="hideSubCat(sub)"
                            href="#"
                            v-if="sub.status == 1"
                            class="badge badge-success"
                          >
                            Active
                          </a>
                        </td>
                        <td v-if="form.id != sub.id && sub.hide == 1 " style="width:18%;">
                          <a
                            @click.prevent="editSubCat(sub)"
                            href="#"
                            class="btn btn-primary"
                          >
                            <i class="fa fa-edit"></i>
                          </a>
                          <a
                            @click.prevent="removeSubCat(sub)"
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
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "subCategory",
  data() {
    return {
      newWidth:false,
      newWidth1:false,
      tokenData: "",
      loading: true,
      search: "",
      modalHide: false,
      editMode: false,
      btnVisible: false,
      subCategories: [],
      form: new Form({
        id: "",
        role_id: "",
        category_id: "",
        name: "",
        description: "",
        image: "",
        status: "",
      }),
    };
  },
  mounted() {
    this.$store.dispatch("getCategoryAction");
    this.$store.dispatch("getSubCategoryAction");
    this.tokenData = token;
  },
  created() {
    // axios
    //   .get("api/get-category", {
    //     headers: {
    //       Accept: "Application/json",
    //       Authorization: "Bearer " + token,
    //     },
    //   })
    //   .then((res) => {
    //     res.data.cat.forEach((element) => {
    //       if (element.name == this.$route.params.name) {
    //         this.category_id = element.id;
    //       }
    //     });
    //   });

    axios
      .get("api/get-sub-category", {
        headers: {
          Accept: "Application/json",
          Authorization: "Bearer " + token,
        },
      })
      .then((res) => {
        this.subCategories = res.data.subCat;
      });
  },
  computed: {
    getCategories() {
      return this.$store.getters.getCategory;
    },
    getSubCategories() {
      return this.$store.getters.getSubCategory;
    },
    filterd() {
      return this.subCategories.filter((sub) =>
        sub.name.toLowerCase().startsWith(this.search.toLowerCase())
      );
    },
  },

  methods: {
    addStyle(){
        this.newWidth = true;
    },
    outStyle(){
        this.newWidth = false;
    },
    addStyle1(){
        this.newWidth1 = true;
    },
    outStyle1(){
        this.newWidth1 = false;
    },
    editSubCat(sub){
        this.form.fill(sub);
        if (this.form.id == sub.id) {
            this.editMode = true;

        }else{
            this.editMode = false;

        }

    },
    updateSubCat(){
        this.form.post('api/update-sub-cat/'+this.form.id,{
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " +token
          }
        })
        .then(()=>{
            Toast.fire({
                icon: "success",
                title: "Sub Category Updated Successfull.",
            });
        })
    },
    storeSubCat(){
        this.form.post('api/store-sub-cat',{
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " +token
          }
        })
        .then(()=>{
            Toast.fire({
            icon: "success",
            title: "Sub Category Added Successfull.",
            });
        })
    },
    showAddSubCategoryForm() {
      this.loading = false;
    },
    removeSubCat(sub) {
      this.form.fill(sub);

      this.deleteForm
        .post("api/delete-sub-category/" + this.deleteForm.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + this.tokenData,
          },
        })
        .then((res) => {
          axios
            .get("api/get-sub-category", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + this.tokenData,
              },
            })
            .then((res) => {
              this.subCategories = res.data.subCat;
            });
          Toast.fire({
            icon: "success",
            title: "Sub Category Deleted Successfull.",
          });
        });
        this.form.reset();
    },
    publishSubCat(sub) {
      this.testForm.fill(sub);
      this.testForm
        .post("api/publish/" + this.testForm.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((response) => {
            this.form.reset();
          axios
            .get("api/get-sub-category", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((res) => {
              this.subCategories = res.data.subCat;
            });
          Toast.fire({
            icon: "success",
            title: "Sub Category Publish Successfull.",
          });
        });
    },
    hideSubCat(sub) {
      this.testForm.fill(sub);
      this.testForm
        .post("api/hide-sub-category/" + this.testForm.id, {
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          },
        })
        .then((res) => {
            this.form.reset();
          axios
            .get("api/get-sub-category", {
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer " + token,
              },
            })
            .then((res) => {
              this.subCategories = res.data.subCat;
            });
          Toast.fire({
            icon: "success",
            title: "Sub Category Hide Successfull.",
          });
        });
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
  }
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
.all-sub-cat-btn {
  padding-top: 5px;
  padding-left: 5px;
  padding-bottom: 5px;
  padding-right: 30%;
  margin-right: 5%;
  background-color: azure;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 1px 1px 1px 0px #7676;
  height: 60px;
}
.add-sub-cat-btn {
  padding-top: 5px;
  padding-left: 5px;
  padding-bottom: 5px;
  padding-right: 30%;
  margin-right: 5%;
  background-color: azure;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 1px 1px 1px 0px #7676;
  height: 60px;
}
.all-sub-cat-p-style {
  color: #000;
  margin-left: 27px;
  margin-top: -40px;
  font-weight: 700;
  width: 150px;
}
.add-sub-cat-p-style {
  color: #000;
  margin-left: 10px;
  margin-top: -40px;
  font-weight: 700;
  width: 150px !important;
}
.total-sub-cat-span {
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
</style>
