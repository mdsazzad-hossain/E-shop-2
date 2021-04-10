<template>
  <div v-show="modalHide" class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body" style="padding:0px;">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">New Category Details...</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span style="color: #fff;" aria-hidden="true">&times;</span>
              </button>
            </div>
            <form role="form" @submit.prevent="upload()">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input v-model="form.name" type="text" class="form-control" placeholder="Enter category name"
                  :class="{ 'is-invalid': form.errors.has('name') }"/>
                  <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
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
                    <div class="custom-file file-input-style">
                      <img :src="form.image" class="img-style" />
                      <!-- <i class="fas fa-file-upload icon-style"></i> -->
                      <input @change="changePhoto($event)" type="file" class="custom-file-input input-new-style" id="exampleInputFile" />
                      <!-- <label style="display:none;" class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                    </div>
                  </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-auto my-1">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Publish</label>
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
              </div>
              <button style="width:100%" type="submit" class="btn btn-primary">Submit</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "addCategory",
  data(){
      return{
          tokenData:"",
          modalHide:true,
          form: new Form({
            name       :"",
            description:"",
            image      :"",
            status     :"1"
          })

      }
  },
  mounted(){
      this.tokenData = token;
  },
  methods:{
      upload(){
          this.form.post('api/addCategory',{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+this.tokenData
                }
            })
          .then((response)=>{
              this.$store.dispatch("getCategoryAction");
              Toast.fire({
                    icon: "success",
                    title: "Category added Successfull."
                });
               this.modalHide = false;
               this.form.reset();
          })
      },
    ourImage(img) {
      return "/images/" + img;
    },
    changePhoto(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.form.image = event.target.result;
      };
      reader.readAsDataURL(file);

    }
  }
};
</script>

<style>
.file-input-style{
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    height: 180px !important;
    max-width: 75% !important;
    margin-left: 50px !important;
}
.input-new-style{
    margin-left: -100%;
    height: 180px;
    border: dashed 1.5px blue;
    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
    width: 100% !important;
    cursor: pointer;
}
.icon-style{
    font-size: 50px;
    margin-left: 145px;
    margin-top:5px;
}
.img-style{
    width: 100% !important;
    height: 180px !important;
}
</style>
