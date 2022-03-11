<template>
    <Head>
        <title>Edit User</title>
    </Head>
    <h1 class="text-3xl">Edit User</h1>

    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">Name</label>
            <input v-model="form.name" class="border border-gray-400 p-2 w-full" type="text" name="name" id="name" required>
            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="username">Username</label>
            <input v-model="form.username" class="border border-gray-400 p-2 w-full" type="text" name="username" id="username" required>
            <div v-if="form.errors.username" v-text="form.errors.username" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">Email</label>
            <input v-model="form.email" class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" required>
            <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="role">Role</label>
            <select v-model="form.role" class="border border-gray-400 p-2 w-full" name="role" id="role" required>
                <option value="">Select</option>
                <option v-for="role in roles" :value="role">{{ ucwords(role) }}</option>
            </select>
            <div v-if="form.errors.role" v-text="form.errors.role" class="text-red-500 text-xs mt-1"></div>
        </div>
        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500" :disabled="form.processing">Submit</button>
        </div>
    </form>
</template>

<script setup>
import {reactive, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3"

let props = defineProps({
    user: Object,
    roles: Object
});

let ucwords = function (value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
}

let form = useForm({
    'name': props.user.name,
    'username': props.user.username,
    'email': props.user.email,
    'role': props.user.role,
});

//let processing = ref(false);

let submit = function (){
    /*Inertia.post('/inertiajs/users', form, {
        onStart: function (){
            processing.value = true;
        },
        onFinish: function (){
            processing.value = false;
        }
    });*/
    form.patch(`/inertiajs/users/${props.user.id}`);
};

</script>

<style scoped>

</style>
