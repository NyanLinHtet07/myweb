<template>
   <BreezeAuthenticatedLayout pageTitle="Tag Page">
            <div class=" flex justify-end">
                <button class=" m-3 px-3 py-2 rounded-lg bg-gray-500/60 shadow-md drop-shadow-lg hover:shadow-none hover:drop-shadow-md" @click="openForm()" v-if="! visible"> Open </button>
                <button class=" m-3 px-3 py-2 rounded-lg bg-sky-800/60 shadow-md drop-shadow-lg hover:shadow-none hover:drop-shadow-md" @click="closeForm()" v-if="visible"> Close </button>
            </div>
            <div class=" px-3 py-2 min-w-full mt-3" v-if="visible">
                <form @submit.prevent="submit" class=" bg-gray-200 p-2 rounded">
                    <div class=" text-center">
                        <input type="text" v-model="form.name" placeholder="Input Tag" class=" w-3/4 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200">
                             <div v-if="form.errors.name">{{ form.errors.name }}</div>
                        <input type="file" @input="form.icon=$event.target.files[0]">
                         <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                        </progress>
                       
                    </div>
                    <div class="text-right">
                         <button class=" px-3 py-2 bg-green-500 rounded-md shadow-md" type="submit"> Submit</button>
                    </div>
                   
                </form>
            </div>

            <div class=" mt-5 mx-2  rounded-md" v-if=" ! visible">
                  <table class="table-auto text-center w-full "> 
            <thead class=" bg-gray-700/50 text-gray-100">
                <tr class="p-3 text-base">
                <th class="w-1/6 ..."> No </th>
             
                 <th class="w-1/6"> Icon</th>
                <th class="w-1/4 ..."> Name </th>
               
               
                <th class="w-1/6 ..."> Edit </th>
                <th class="w-1/6 ..."> Delete </th>
                </tr>
            </thead>
            <tbody class=" bg-white">
               <tr v-for="(t,index) in tag " :key="t.id">
                   <td class="py-2"> {{index + 1}}</td>
                   <td class="py-2"> <img :src='"/upload/tag/" + t.icon' alt="" class=" w-16 rounded-sm"></td>
                 
                   <td class="py-2"> {{ t.name}}</td>
   
                   <td class="py-2"> <button @click="editMenu(t)" class=" text-sky-700 hover:text-sky-500 transition-colors delay-300 font-bold text-sm" >
                    <!-- <i class="far fa-edit"></i> --> <edit-icon></edit-icon>
                     </button></td>

                   <td class="py-2"> <button @click="deleteTag(t.id)" class="text-red-700 hover:text-red-500 transition-colors delay-300 font-bold text-sm">
                    <delete-icon></delete-icon>
                    </button></td>
               </tr>

             

               
            </tbody>
            </table>
            

            
             <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form  @submit.prevent='updateMenu(form)'>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.name">
                                   
                                  </div>
                            </div>
                          </div>
                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                           
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button  type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                Update
                              </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                              
                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Cancel
                              </button>
                            </span>
                          </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>

            </div>

   </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AdminDashBoard.vue';
//import {Inertia} from '@inertiajs/inertia'
import axios from 'axios'
import {useForm} from '@inertiajs/inertia-vue3'
import DeleteIcon from 'vue-material-design-icons/DeleteOutline.vue'
import EditIcon from 'vue-material-design-icons/BookEditOutline.vue'
export default {

    props:{
        tag: Array,
    },
   
   data() {
       return {
         visible: false,
         editMode:false,
         isOpen : false,

         form : useForm ({
            name : null,
            icon: null,
        }) 

       }
   },



    // setup() {
     

    //     function 

    //     return {form , submit}
        
    // },

   components:{
       BreezeAuthenticatedLayout,
       DeleteIcon, EditIcon
   },

   methods: {

     OpenModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false;
            this.reset()
            this.editMode = false;

        },

        submit() {
            this.form.post('/admin/tag')
            this.reset();
            window.alert('Successfully Uploaded')
            //this.closeForm()
        },

     reset(){
        this.form = useForm({
            name: null,
            icon:null,
        })
     }, 
      openForm(){
        this.visible = true
      },

      closeForm(){
        this.visible = false
      },

      editMenu(t){
        this.form = Object.assign({}, t);
        this.editMode = true;
        this.OpenModal();

      },

      updateMenu(menu){
        menu._method = 'PUT';

        this.$inertia.put(`/admin/tag/`+menu.id , menu);
        this.reset();
        this.closeModal();
      },
     
      deleteTag(id){
        if(! confirm("Are You Sure To Delete")) return;
         axios.delete(`/api/tag/${id}`);
      }
   },
   
}
</script>