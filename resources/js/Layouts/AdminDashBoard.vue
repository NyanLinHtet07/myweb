<script setup>
import { ref } from 'vue';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
         <div>
        <div class="h-screen flex">
            <div class=" bg-slate-100 w-1/5 border-r transition delay-300" v-if="visible">
                <h3 class=" p-2 mt-3 text-center font-bold text-gray-800"> My Wall </h3>

                <div class=" mt-3 px-2 mx-2 bg-white rounded">
                    <h3 class=" px-3 flex justify-start font-semibold text-lg"> {{ $page.props.auth.user.name }} </h3>
                    <small class=" px-3 text-gray-700"> {{ $page.props.auth.user.email}}</small>
                </div>

                <nav class=" mt-3">

                    <Link :href="route('dashboard')" class=" flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                         <span> Home </span> 
                    </Link>

                     <Link :href="route('tag.index')" class=" flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                         <span> Tag </span> 
                    </Link>

                     <Link :href="route('blog.index')" class=" flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                         <span> Blog </span> 
                    </Link>

                     <Link :href="route('project.index')" class=" flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                         <span> Projects </span> 
                    </Link>



                     <Link :href="route('logout')" method="post" class="flex justify-between bg-gray-200 transition duration-700 hover:bg-gray-300 px-3 py-1 mx-3 my-2 rounded-md shadow-sm">
                        <span> LogOut </span>
                    </Link>
                </nav>
            </div>

            <div class=" flex-1 w-4/5 bg-white border-gray-200">
                    <div class=" bg-slate-200 w-full flex justify-between px-2 py-3">
                        <div>
                             <button class=" py-3 px-2 rounded" @click="close()"  v-if=" visible"> Close</button>
                             <button class=" py-3 px-2 rounded" @click="open()" v-if="! visible">Open</button>
                        </div>
                        <div>
                            <h2 class=" text-gray-700 font-bold mt-3 mr-3 text-xl"> {{pageTitle}} </h2>
                        </div>
                       
                       
                    </div>
                     <main>
                        <slot />
                    </main>
            </div>

        </div>
    </div>
</template>

<script>

//import closeIcon from 'vue-material-design-icons/Close.vue'
export default {
    props:["pageTitle"],

    data() {
        return {
            visible: true,
        }
    },

    methods: {
        close(){
            this.visible = false;
        },

        open(){
            this.visible = true;
        }
    },
}
</script>

<style>
    
</style>