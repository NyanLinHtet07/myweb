

<template>
   <BreezeAuthenticatedLayout pageTitle="Blog Page">




    <div class="px-3 py-2 min-w-full min-h-screen">
            
             <form @submit.prevent="submit">
            
                <div>
                     <input type="text" v-model="form.title" class=" w-3/4 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200" placeholder="Title"/>
                </div>

                <div>
                      <textarea name="" id="" cols="30" rows="10" v-model="form.text" placeholder="text" class=" w-3/4 h-24 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200" ></textarea>
                     
                </div>
                <div>
                     <select name="" id="" v-model="multiTag" class=" px-3 py-2 rounded" multiple>
                         <option selected> Select Tag </option>
                        <option v-for="tag in tags" :key="tag.id" :value="tag.id"> {{tag.name}}</option>
                    </select>
                    
                </div>
                <div> 
                     <input type="file" @input="form.image = $event.target.files[0]" />
                      <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                     </progress>
                </div>
              
               
              
               
               
                <button class="px-3 oy-2 rounded bg-lime-800" type="submit"> Submit</button>
            </form>
    </div>
      
      <div class="mt-5 py-3 px-4">
            <table class=" table-auto text-center w-full">
                <thead class=" bg-gray-700/50 text-gray-100">
                    <tr class=" text-base p-3">
                        <th>No </th>
                        <th> Title</th>
                        <th> Img</th>
                        <th> Content </th>
                        <th> Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="bg-white"> 
                    <tr v-for="p in blogs" :key="p.id">
                        <td class=" py-2">{{p.id}}</td>
                        <td class="py-2">{{p.title}}</td>
                        <td class=" py-2"> <img :src='"/upload/blog/"+p.image' alt=""></td>
                        <td class="py-2">{{p.text}}</td>
                        <td class=" bg-green-500 hover:bg-green-800 text-gray-200 font-bold text-sm py-2 px-2 rounded" @click="editBlog(p)"> Edit </td>
                         <td class=" bg-red-500 hover:bg-red-800 text-gray-200 font-bold text-sm py-2 px-2 rounded" @click="deleteBlog(p.id)"> Delete </td>
                    </tr>

                </tbody>
           </table>
      </div>

        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                          <form  @submit.prevent='updateBlog(form)'>
                          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                  <div class="mb-4">
                                      <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                                      <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter Title" v-model="form.title">
                                   
                                  </div>

                                   <div>
                                    <textarea name="" id="" cols="30" rows="10" v-model="form.text" placeholder="text" class=" w-3/4 h-24 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200" ></textarea>
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
           
       
   </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AdminDashBoard.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';

export default {

    props:{
        blogs: Array,
        tags : Array,
    },

    data(){
        return{
            visible: false,
            show: false,
            editMode:false,
            isOpen : false,
            multiTag:[],

               form : useForm ({
                    title : null,
                    image: null,
                    text: null,
                    tag_id:null,
                }) 
        }
    },

    // setup() {
    //     const form = useForm ({
    //         title: null,
    //         image: null,
    //         text: null,
    //     })

    //     function submit() {
    //         form.post('/admin/blog')
    //     }
    //         return {form, submit}
        
    // },
    // setup() {
      

    //     function submit() {
    //         form.post('/admin/blog')
    //     }
    //     return {form , submit}
    // },
   
   components:{
       BreezeAuthenticatedLayout,
     
   },
   methods:{
         OpenModal(){
            this.isOpen = true;
        },

        closeModal(){
            this.isOpen = false;
            this.reset()
            this.editMode = false;

        },

        reset(){
                form = useForm ({
                title: null,
                image: null,
                text: null,
                tag_id: null,
            })
        },
        getTag(){
            return this.form.tag_id = JSON.stringify(this.multiTag);
        },

       submit() {
            let f = this.form.post('/admin/blog')
            this.reset();
            console.log(f)
            window.alert('Successfully Uploaded')
            //this.closeForm()
        },
    
    checkShow(){
        this.show = true
    },
 
    checkClose(){
        this.show = false
    },

    editBlog(t){
        this.form = Object.assign({}, t);
        this.editMode = true;
        this.OpenModal();

      },

      updateBlog(form){
        // form._method = 'PUT';
        axios.patch(`/admin/blog/`+form.id , form);
        this.reset();
        this.closeModal();
      },

    deleteBlog(id){
        if(! confirm('Are You Sure To Delete'));
        this.$inertia.delete(`/admin/blog/${id}`)
    }
   },

  

   created() {
    this.getTag();
   },


}
</script>