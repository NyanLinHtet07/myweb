

<template>
   <BreezeAuthenticatedLayout pageTitle="Blog Page">




    <div class="px-3 py-2 min-w-full min-h-screen">
            
             <form @submit.prevent="submit">
            <!-- <form @submit.prevent="submit"> -->
                <div>
                     <input type="text" v-model="form.title" class=" w-3/4 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200" placeholder="Title"/>
                      <div v-if="form.errors.title">{{ form.errors.title }}</div>
                </div>

                <div>
                      <textarea name="" id="" cols="30" rows="10" v-model="form.text" placeholder="text" class=" w-3/4 h-24 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200" ></textarea>
                      <div v-if="form.errors.text">{{ form.errors.text }}</div>
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
                <div>{{multiTag}}</div>
               
              
               
               
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
                        <td class=" bg-green-500 hover:bg-green-800 text-gray-200 font-bold text-sm py-2 px-2 rounded"> Edit </td>
                         <td class=" bg-red-500 hover:bg-red-800 text-gray-200 font-bold text-sm py-2 px-2 rounded" @click="deleteBlog(p.id)"> Delete </td>
                    </tr>

                </tbody>
           </table>
      </div>
           
       
   </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AdminDashBoard.vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {

    props:{
        blogs: Array,
        tags : Array,
    },

    data(){
        return{
            visible: false,
            show: false,
            multiTag:[],

               form : useForm ({
                    title : null,
                    image: null,
                    text: null,
                    tag_id: [],
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

        getTag(){
            this.form.tag_id = this.multiTag;
        },

       submit() {
            this.form.post('/admin/blog')
            this.reset();
            window.alert('Successfully Uploaded')
            //this.closeForm()
        },
    
    checkShow(){
        this.show = true
    },

    checkClose(){
        this.show = false
    },
    deleteBlog(id){
        if(! confirm('Are You Sure To Delete'));
        this.$inertia.delete(`/admin/blog/${id}`)
    }
   },

   mounted() {
    this.getTag();
   },


}
</script>