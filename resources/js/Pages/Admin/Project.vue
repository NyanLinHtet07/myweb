<template>
   <BreezeAuthenticatedLayout>
        
    <div class="px-3 py-2 min-w-full min-h-screen">
            <h3 class=" text-center"> Blog</h3>
             <form @submit.prevent="submit">
            <!-- <form @submit.prevent="submit"> -->
                <input type="text" v-model="form.title" class=" w-3/4 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200">
                <input type="text" v-model="form.url" class=" w-3/4 p-3 m-2 rounded border-2 border-gray-500 ring-2 ring-slate-200">
                <textarea name="" id="" cols="30" rows="10" v-model="form.description"></textarea>
                <input type="file" @input="form.image = $event.target.files[0]" />
                <select name="" id="" v-model="form.tag_id">
                    <option v-for="tag in tags" :key="tag.id" :value="tag.id"> {{tag.name}}</option>
                </select>
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
                        <th> Url </th>
                        <th> Description </th>
                        <th> Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="bg-white"> 
                    <tr v-for="p in projects" :key="p.id">
                        <td class=" py-2">{{p.id}}</td>
                        <td class="py-2">{{p.title}}</td>
                        <td class=" py-2"> <img :src='"/upload/blog/"+p.image' alt=""></td>
                        <td class="py-2"> {{p.url}}</td>
                        <td class="py-2">{{p.description}}</td>
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
import { useForm} from '@inertiajs/inertia-vue3'

export default {
   
   props:['tags', 'projects'],

   data() {
    return {
      
    }
   },

   setup() {
        const form = useForm({
            title:null,
            image:null,
            url:null,
            description:null,
            tag_id:null,
        })

        function submit(){
            form.post('/admin/project')
        }

        return { form, submit}
   },

   components:{
       BreezeAuthenticatedLayout,
    
   },

   methods: {
   },
}
</script> 