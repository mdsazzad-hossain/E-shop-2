<template>
  <div>
      <div class="card card-primary">
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
                <div class="card-body">
                  <div class="form-group">
                    <input
                      v-model="dataArray.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter category name"
                    />
                  </div>
                  <div class="form-group">
                    <textarea
                      v-model="dataArray.msg"
                      type="text"
                      class="form-control"
                      placeholder="enter category details..."
                    ></textarea>
                  </div>
                  <div class="form-group">
                    <input
                      v-model="data.name"
                      type="text"
                      class="form-control"
                      placeholder="Enter category name"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      v-model="dataArray.email"
                      type="text"
                      class="form-control"
                      placeholder="Enter email"
                    />
                  </div>
                  <div class="form-group">
                    <textarea
                      v-model="data.msg"
                      type="text"
                      class="form-control"
                      placeholder="enter category details..."
                    ></textarea>
                  </div>
                </div>
                <button
                 @click.prevent="pushData()"
                  style="width: 100%"
                  type="submit"
                  class="btn btn-primary"
                >
                  Submit
                </button>
            </div>
            <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Menu Name</th>
                      <th>Child Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="men in data.details" :key="men">
                      <td>{{ men.name }}</td>
                      <td>{{ men.email }}</td>
                      <td>{{ men.msg }}</td>
                      <td><button @click.prevent="store()" class="btn btn-success">save</button></td>
                    </tr>
                  </tbody>
                </table>
  </div>
</template>

<script>
export default {
    data(){
        return{
            dataArray:{
                name:"",
                email:"",
                msg:""
            },
            data:{
                name:"",
                msg:"",
                details:[]
            }
        }
    },
    methods:{
        pushData(){
            this.data.details.push(this.dataArray);
            this.dataArray={
                name:"",
                email:"",
                msg:""
            }
        },
        store(){
            axios.post('api/store',this.data,{
                headers: {
                    Accept: "Application/Json",
                    Authorization: "Bearer " + token
                }
            })
            .then(()=>{
                console.log('ok');
            })
        }

    }
}
</script>

<style>

</style>
