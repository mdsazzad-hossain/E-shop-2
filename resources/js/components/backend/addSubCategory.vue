<template>
  <div v-show="modalHide" class="modal fade bd-example-modal-lg" id="add-sub-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body" style="padding:0px;">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sub Category Details...</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span style="color: #fff;" aria-hidden="true">&times;</span>
              </button>
            </div>
              <div class="card-body row">
                <div class="col-md-12 display-flex">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Name</label>
                    <input
                      v-model="form.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter category name"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Vendor</label>
                    <input
                      v-model="form.vendor"
                      type="text"
                      class="form-control"
                      placeholder="Enter vendor name"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Brand</label>
                    <input
                      v-model="form.brand"
                      type="text"
                      class="form-control"
                      placeholder="Enter brand name"
                    />
                  </div>
                </div>
                <div class="col-md-12 display-flex">
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Metarial</label>
                    <input
                      v-model="form.material"
                      type="text"
                      class="form-control"
                      placeholder="Enter metarial name"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Color</label>
                    <input
                      v-model="form.color"
                      type="text"
                      class="form-control"
                      placeholder="Enter color name"
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Size</label>
                    <input
                      v-model="form.size"
                      type="text"
                      class="form-control"
                      placeholder="Enter size name"
                    />
                  </div>
                </div>
                <div class="col-md-12 display-flex">
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Buy Price</label>
                    <input
                      v-model="form.buy_price"
                      type="number"
                      class="form-control"
                      placeholder="00.00"
                    />
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Sale Price</label>
                    <input
                      v-model="form.sale_price"
                      type="number"
                      class="form-control"
                      placeholder="00.00"
                    />
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Promo Price</label>
                    <input
                      v-model="form.promo_price"
                      type="number"
                      class="form-control"
                      placeholder="00.00"
                    />
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input
                      v-model="form.quantity"
                      type="number"
                      class="form-control"
                      placeholder="00.00"
                    />
                  </div>
                </div>
                <div class="col-md-12 display-flex">
                  <div class="form-group col-md-12" style="width: 100% !important;">
                    <label for="exampleInputPassword1">Description</label>
                    <textarea
                      v-model="form.description"
                      type="text"
                      class="form-control"
                      placeholder="enter sub category details..."
                    ></textarea>
                  </div>
                </div>
                <div class="col-md-12 display-flex">
                  <div class="form-group col-md-3">
                    <label for="exampleInputFile">Photo</label>
                    <div class="input-group">
                      <div class="custom-file file-sub-cat-input-style">
                        <img :src="form.image1" class="img-sub-cat-style" />
                        <!-- <i class="fas fa-file-upload icon-style"></i> -->
                        <input
                          @change="changePhoto1($event)"
                          type="file"
                          class="custom-file-input input-sub-cat-new-style"
                        />
                        <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputFile">Photo</label>
                    <div class="input-group">
                      <div class="custom-file file-sub-cat-input-style">
                        <img :src="form.image2" class="img-sub-cat-style" />
                        <!-- <i class="fas fa-file-upload icon-style"></i> -->
                        <input
                          @change="changePhoto2($event)"
                          type="file"
                          class="custom-file-input input-sub-cat-new-style"
                        />
                        <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputFile">Photo</label>
                    <div class="input-group">
                      <div class="custom-file file-sub-cat-input-style">
                        <img :src="form.image3" class="img-sub-cat-style" />
                        <!-- <i class="fas fa-file-upload icon-style"></i> -->
                        <input
                          @change="changePhoto3($event)"
                          type="file"
                          class="custom-file-input input-sub-cat-new-style"
                        />
                        <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputFile">Photo</label>
                    <div class="input-group">
                      <div class="custom-file file-sub-cat-input-style">
                        <img :src="form.image4" class="img-sub-cat-style" />
                        <!-- <i class="fas fa-file-upload icon-style"></i> -->
                        <input
                          @change="changePhoto4($event)"
                          type="file"
                          class="custom-file-input input-sub-cat-new-style"
                        />
                        <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div col-md-12 style="width:100%">
                  <div class="col-md-12">
                    <div class="form-row align-items-center">
                      <div class="col-auto my-1">
                        <label
                          style="margin-left: 12px;"
                          class="mr-sm-2"
                          for="inlineFormCustomSelect"
                        >Status</label>
                        <select
                          style="width: 90px !important;"
                          v-model="form.status"
                          class="custom-select mr-sm-2"
                          id="inlineFormCustomSelect"
                        >
                          <option value="1" selected>Publish</option>
                          <option value="0">Hide</option>
                        </select>
                      </div>
                    </div>
                    <button
                      @click.prevent="upload()"
                      style="width: 97%;
                            margin-left: 12px;"
                      type="submit"
                      class="btn btn-primary"
                    >Submit</button>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "addSubCategory",
  data() {
    return {
      tokenData: "",
      modalHide: true,
      form: {
        category_id: "",
        name: "",
        vendor: "",
        brand: "",
        color: "",
        material: "",
        size: "",
        quantity: "",
        buy_price: "",
        sale_price: "",
        promo_price: "",
        description: "",
        image1: "",
        image2: "",
        image3: "",
        image4: "",
        status: "",
      },
    };
  },
  mounted() {

  },
  created(){
      this.tokenData = token;
      axios.get('api/get-category',{
          headers: {
            Accept: "Application/json",
            Authorization: "Bearer " + token,
          }
      })
      .then((res)=>{
            res.data.cat.forEach(element => {
              if (element.name == this.$route.params.name) {
                    this.form.category_id = element.id;
                }
            });
        });
  },
  methods: {
    upload() {

        let formData = new FormData();

        formData.append("category_id", this.form.category_id);
        formData.append("name", this.form.name);
        formData.append("vendor", this.form.vendor);
        formData.append("brand", this.form.brand);
        formData.append("color", this.form.color);
        formData.append("material", this.form.material);
        formData.append("size", this.form.size);
        formData.append("quantity", this.form.quantity);
        formData.append("buy_price", this.form.buy_price);
        formData.append("sale_price", this.form.sale_price);
        formData.append("promo_price", this.form.promo_price);
        formData.append("description", this.form.description);
        formData.append("image1", this.form.image1);
        formData.append("image2", this.form.image2);
        formData.append("image3", this.form.image3);
        formData.append("image4", this.form.image4);
        formData.append("status", this.form.status);

        axios.post('api/store',formData,{
            headers: {
                Accept:'Application/json',
                Authorization:'Bearer '+this.tokenData
            }
        })
        .then((response) => {
            axios
            .get("api/get-sub-category",{
              headers: {
                Accept: "Application/json",
                Authorization: "Bearer "+this.tokenData
              }
            })
            .then((res) => {
              this.subCategories = res.data.subCat;
            });
            Toast.fire({
                icon: "success",
                title: "Sub Category Added successfully"
            });
        })
        .catch((err) => {
            Swal.fire({
            icon: "warning",
            title: "fillup all the fields must be!!!",
            });
        });

    },
    ourImage(img) {
      return "/images/" + img;
    },
    changePhoto4(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.form.image4 = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    changePhoto3(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.form.image3 = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    changePhoto2(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.form.image2 = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    changePhoto1(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.form.image1 = event.target.result;
      };
      reader.readAsDataURL(file);
    },
  },
};
</script>

<style>
.file-sub-cat-input-style {
  border: dashed 1.5px blue;
  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
  height: 150px !important;
  max-width: 100% !important;
  margin-left: 0px !important;
}
.input-sub-cat-new-style {
  height: 150px;
  border: dashed 1.5px blue;
  background-image: repeating-linear-gradient(45deg, black, transparent 100px);
  width: 100% !important;
  cursor: pointer;
  margin-left: -156px !important;
}
.icon-style {
  font-size: 50px;
  margin-left: 145px;
  margin-top: 5px;
}
.img-sub-cat-style {
  width: 100% !important;
  height: 148px !important;
}
.display-flex {
  display: inline-flex;
}
</style>
