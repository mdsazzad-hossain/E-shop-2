import Axios from "axios"

export default{
    state:{
        menuState:[],
        roleState:[],
        categoryState:[],
        subCategoryState:[]
    },

    getters:{
        getMenu(state){
            return state.menuState
        },
        getRole(state){
            return state.roleState
        },
        getCategory(state){
            return state.categoryState
        },
        getSubCategory(state){
            return state.subCategoryState
        }
    },

    mutations:{
        menuMutation(state,payload){
            return state.menuState = payload
        },
        roleMutation(state,payload){
            return state.roleState = payload
        },
        categoryMutation(state,payload){
            return state.categoryState = payload
        },
        subCategoryMutation(state,payload){
            return state.subCategoryState = payload
        }
    },

    actions:{
        getMenuAction(context){
            Axios.get('api/get-menu',{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+token
                }
            })
            .then((response)=>{
                context.commit('menuMutation',response.data);
            })
        },
        getRoleAction(context){
            Axios.get('api/get-role',{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+token
                }
            })
            .then((response)=>{
                context.commit('roleMutation',response.data.roles);
            })
        },
        getCategoryAction(context){
            Axios.get('api/get-category',{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+token
                }
            })
            .then((response)=>{
                context.commit('categoryMutation',response.data);
            })
        },
        getSubCategoryAction(context){
            Axios.get('api/get-sub-category',{
                headers: {
                    Accept:'Application/json',
                    Authorization:'Bearer '+token
                }
            })
            .then((response)=>{
                context.commit('subCategoryMutation',response.data);
            });
        }
    }
}
