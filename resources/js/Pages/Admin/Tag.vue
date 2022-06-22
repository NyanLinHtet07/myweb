<template>
   <BreezeAuthenticatedLayout pageTitle="Tag Page">
            <div class=" flex justify-end">
                <button class=" m-3 px-3 py-2 rounded bg-gray-500/60" @click="openForm()" v-if="! visible"> Open Form </button>
                <button class=" m-3 px-3 py-2 rounded bg-sky-800/60" @click="closeForm()" v-if="visible"> Close Form </button>
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

            <div class=" mt-5 py-3 px-4 bg-slate-200 rounded-md" v-if=" ! visible">
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
   
                   <td class="py-2"> <button @click="editMenu(t)" class=" bg-green-500 hover:bg-green-800 text-gray-200 font-bold text-sm py-2 px-2 rounded" >
                    <!-- <i class="far fa-edit"></i> --> Edit
                     </button></td>

                   <td class="py-2"> <button @click="deleteTag(t.id)" class="text-red-700 hover:text-red-500 transition-colors delay-300 font-bold text-sm">
                    <delete-icon></delete-icon>
                    </button></td>
               </tr>

             

               
            </tbody>
            </table>
            </div>

   </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AdminDashBoard.vue';
//import {Inertia} from '@inertiajs/inertia'
import {useForm} from '@inertiajs/inertia-vue3'
import DeleteIcon from 'vue-material-design-icons/DeleteOutline.vue'
export default {

    props:{
        tag: Array,
    },
   
   data() {
       return {
         visible: false,

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
       DeleteIcon
   },

   methods: {

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
     
      deleteTag(id){
        if(! confirm("Are You Sure To Delete")) return;
        this.$inertia.delete(`/admin/tag/${id}`);
      }
   },
   
}
</script>