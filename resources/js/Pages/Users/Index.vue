<template>
    <Head>
        <title>Users</title>
    </Head>
    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Users</h1>
            <Link href="/inertiajs/users/create" class="text-blue-500 text-md ml-3">New user</Link>
        </div>
        <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg">
    </div>
    <!--<div style="margin-top: 900px;">
        <p>The current time is {{ time}}.</p>
        <Link href="/inertiajs/users" class="text-blue-500" preserve-scroll>Refresh</Link>
    </div>-->


    <div class="overflow-x-auto w-full">
        <table class="table table-zebra w-full">
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>
                        <div class="flex items-center space-x-3">
                            <div>
                                <div class="font-bold">{{ user.name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <Link :href="`/users/${user.id}/edit`" class="btn btn-ghost btn-xs">Edit</Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <Pagination :links="users.links" class="mt-6"></Pagination>
</template>

<script setup>
import Pagination from "../Shared/Pagination";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
    //time: String,
    users: Object,
    filters: Object
})

let search = ref(props.filters.search);
watch(search, debounce(function (value){
   Inertia.get('/inertiajs/users', {search: value}, {preserveState: true, replace: true});
}, 300));
</script>

<style scoped>

</style>
